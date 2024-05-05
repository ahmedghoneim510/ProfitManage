<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\ExpenditureDetail;
use App\Models\Profit;
use App\Models\TotalMonth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenditureDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request=request();
        //dd($request['year']);
        if($request['year'] != null)
        {
            //dd($request['year']);
            $year=$request['year'];
           //dd($year);
        }
        else
        {
            $year=Carbon::now()->year;
        }
        $monthlySums=$this->getData($year);
        $totalOfEachMonth=$this->getTotal($monthlySums,$year);
        return view('expenditures.details', compact('totalOfEachMonth','monthlySums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $request=request();
        $id=$request->id;
        if(!isset($request->id) || $request->id == null)
        {
            $id=0;
        }
        $expendituresDetails = ExpenditureDetail::all();
        $expenditures=Expenditure::all();
        return view('expenditures.create',compact('expendituresDetails','expenditures','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'expenditure_id' => 'required',
            'year' => 'required|numeric',
            'month' => 'required|numeric',
            'money' => 'required|numeric',
            'date_of_expenditure'=>'required'
        ]);
        if(ExpenditureDetail::where('expenditure_id',$request->expenditure_id)->where('year',$request->year)->where('month',$request->month)->exists())
        {
            return back()->with('error','هذا الحقل موجود');
        }
        ExpenditureDetail::create($request->all());
        return to_route('expenditure-details.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenditureDetail $expenditureDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
       // dd('edit');
        return view('expenditures.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpenditureDetail $expenditureDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenditureDetail $expenditureDetail)
    {
        //
    }

    public function getData($year)
    {
        $expenditures = Expenditure::all();
        $monthlySums = [];

        foreach ($expenditures as $expenditure) {
            $months = array_fill(1, 12, 0); // Initialize array with 12 months, all set to 0
            foreach ($expenditure->expenditureDetails as $expenditureDetail) {
                //dd($expenditureDetail->year,$year);
                if ($expenditureDetail->year == $year) {
                    //dd($year,$expenditureDetail->year,$expenditureDetail->month,$expenditureDetail->money);
                    $months[$expenditureDetail->month] += intval($expenditureDetail->money);
                }
            }
            $monthlySums[$expenditure->id] = [$expenditure->name,$months];
        }

        return $monthlySums;
    }
    public function getTotal($monthlySums,$year)
    {

        $totalOfEachMonth=[];
        for ($i=1; $i<=12; $i++){

            $total=0;
            foreach ($monthlySums as $monthlySum){

                $total+=$monthlySum[1][$i];
            }
            $totalOfEachMonth[$i]=$total;
            if(TotalMonth::where('year',$year)->where('month',$i)->exists())
            {
                $updated=TotalMonth::where('year',$year)->where('month',$i)->first();
                $updated->total=$total;
                $updated->save();
                $this->editProfits($updated);
            }
            else
            {
                $updated=TotalMonth::create([
                    'year'=>$year,
                    'month'=>$i,
                    'total'=>$total
                ]);
                $this->editProfits($updated);
            }

           //$this->editProfits($updated);
        }
        return $totalOfEachMonth;
    }
    public function editProfits($updated)
    {
        $profit=Profit::where('year',$updated->year)->where('month',$updated->month)->first();
        if($profit != null)
        {
            $profit->money_after_discount=$profit->money-$updated->total;
            $profit->save();
        }

    }
}
