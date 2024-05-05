<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Profit;
use App\Models\TotalMonth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProfits=Profit::sum('money');
        $totalExpenditures=TotalMonth::sum('total');
        $totalProfitsAfterExpenditures=$totalProfits-$totalExpenditures;
        $total_customers_money=Customer::sum('money');
        return view('dashboard',compact('totalProfits','totalExpenditures',
            'totalProfitsAfterExpenditures','total_customers_money'));
    }



}
