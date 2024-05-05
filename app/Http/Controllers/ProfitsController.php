<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDetails;
use App\Models\Profit;
use App\Models\TotalMonth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfitsController extends Controller
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
        $totalprofits=Profit::where('year',$year)->sum('money_after_discount');
        $profits=Profit::orderBy('month')->where('year',$year)->get();
        $months_total=TotalMonth::where('year',$year)->get();
        $sum=Profit::where('year',$year)->sum('money');
        return view('profits.index',compact('profits','totalprofits','months_total','sum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'month'=>'required',
            'year'=>'required',
            'money'=>'required',
        ]);
        $total=TotalMonth::where('month',$request->month)->where('year',$request->year)->first();
        if($total){

            $request['money_after_discount']=($request->money-$total->total);
        }
        else
        {
            $request['money_after_discount']=$request->money;
        }
        $pro=Profit::where('month',$request->month)->where('year',$request->year)->first();
        if($pro){
            return back()->with('error','This month is already exist');
        }
        $profit=Profit::create($request->all());

        $customers=customer::all();

        foreach ($customers as $customer) {
           $customer_details=CustomerDetails::where('customer_id',$customer->id)->where('month',$profit->month)->where('year',$profit->year)->first();
            if($customer_details != null){
                $customer_details->update([
                    'money' => ($profit->money_after_discount * floatval($customer->present)) / 100,
                ]);
            }
            else{
                CustomerDetails::create([
                    'customer_id' => $customer->id,
                    'month' => $profit->month,
                    'year' => $profit->year,
                    'money' => ($profit->money_after_discount * floatval($customer->present)) / 100,
                ]);
            }

        }



        return to_route('profits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profit=Profit::find($id);
        return view('profits.edit',compact('profit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'month'=>'required',
            'year'=>'required',
            'money'=>'required',
        ]);
        $profit=Profit::find($id);
        $profit->update([
            'money'=>$request->money,
        ]);
        $total=TotalMonth::where('month',$request->month)->where('year',$request->year)->first();
        if($total){

            $request['money_after_discount']=($request->money-$total->total);
        }
        else
        {
            $request['money_after_discount']=$request->money;
        }
        $profit->money_after_discount=$request->money_after_discount;
        $profit->save();
        $customers=customer::all();
        foreach ($customers as $customer) {
            $customer_details=CustomerDetails::where('customer_id',$customer->id)->where('month',$profit->month)->where('year',$profit->year)->first();
            if($customer_details != null){
                $customer_details->update([
                    'money' => ($profit->money_after_discount * floatval($customer->present)) / 100,
                ]);
            }
            else{
                CustomerDetails::create([
                    'customer_id' => $customer->id,
                    'month' => $profit->month,
                    'year' => $profit->year,
                    'money' => ($profit->money_after_discount * floatval($customer->present)) / 100,
                ]);
            }

        }
        return to_route('profits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //dd($request);
        $id=request('id');
        $profit=Profit::find($id);
        if($profit == null){
            return redirect()->route('profits.index');
        }
        $customers=customer::all();
        foreach($customers as $customer){
            $check=CustomerDetails::where('customer_id',$customer->id)->where('month',$profit->month)->where('year',$profit->year)->first();
            if($check){
                $check->delete();
            }
        }
        $profit->delete();
        return redirect()->route('profits.index');
    }
}
