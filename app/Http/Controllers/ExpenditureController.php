<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\ExpenditureDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    public function index()
    {
        $expenditures = Expenditure::all();
        return view('expenditures.index', compact('expenditures'));
    }
    public function create()
    {

    }
    public function show($id)
    {

        $request=request();
        if($request->year != null)
            $year=$request->year;
        else
            $year=Carbon::now()->year;
        $expenditure=Expenditure::where('id',$id)->first();
        $expenditure_details=ExpenditureDetail::where('expenditure_id',$id)->where('year',$year)->get();
        $sum=$expenditure_details->sum('money');
        return view('expenditures.show',compact('expenditure','expenditure_details','sum'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        Expenditure::create($request->all());
        return redirect()->route('expenditures.index');
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $expenditure=Expenditure::where('id', $request->id)->first();
        $expenditure->update($request->all());
        return to_route('expenditures.index');

    }
    public function destroy(Request $request)
    {
        $expenditure=Expenditure::where('id', $request->id)->first();
        $count=$expenditure->expenditureDetails()->count();
        if($count>0)
        {
            return back()->with('error','لا يمكنك حذف هذا العنصر لانه مربوط بمبالغ مالية اخرى');
        }
        $expenditure->delete();
        return to_route('expenditures.index');
    }
}
