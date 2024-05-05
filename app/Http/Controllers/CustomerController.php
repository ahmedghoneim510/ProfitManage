<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\CustomerDetails;
use App\Models\Profit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $total_money=Customer::sum('money');
        return view('customers.index', compact('customers','total_money'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $total=Customer::sum('money');

        if($total=='0'){
            $data=$request->all();
            $data['present']=100;
            Customer::create($data);
            return to_route('customers.index');
        }

        $present=$request->money*100/$total;
        $present = number_format($present, 2);
        $data=$request->all();
        $data['present']=$present;
        Customer::create($data);
        // update customers
        $this->updatePresent();
        return to_route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $id=$customer->id;
        $request=request();
        if($request->year != null)
            $year=$request->year;
        else
            $year=Carbon::now()->year;

        $customerDetails = CustomerDetails::where('customer_id',$id)->where('year',$year)->get();

        if( isset($customerDetails[0]->month)){
        $customer->start_month = $customerDetails[0]->month;
        }
        else{
            $customer->start_month = 1;
        }
        $total_money=$customerDetails->sum('money');
       // dd($total_money);
        return view('customers.customerDetails', compact('customer','customerDetails','total_money'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        $this->updatePresent();
        return to_route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Customer::destroy($request->invoice_id);

        $this->updatePresent();
        return to_route('customers.index');
    }

    public function updatePresent(){
        $customers=Customer::all();
        $total=Customer::sum('money');
        foreach ($customers as $customer) {
            $present=number_format($customer->money*100/$total, 2);
            $customer->present = $present;
            $customer->save();
        }
    }


}
