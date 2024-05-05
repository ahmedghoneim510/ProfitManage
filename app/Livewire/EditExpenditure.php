<?php

namespace App\Livewire;

use App\Models\Expenditure;
use App\Models\ExpenditureDetail;
use Carbon\Carbon;
use Livewire\Component;

class EditExpenditure extends Component
{
    public $expenditureId;
    public $year;
    public $month;
    public $money = 0;
    public $date_of_expenditure;
    public function change()
    {
        if(isset($this->expenditureId) && isset($this->year) && isset($this->month) && isset($this->money))
        {
            $expenditure = ExpenditureDetail::where('expenditure_id',$this->expenditureId)->where('year',$this->year)->where('month',$this->month)->first();
           if($expenditure==null || $expenditure->money==null){
               $this->money=0;
           }
           else{
           $this->money=$expenditure->money;
           }
        }
    }
    public function save(){
        if(isset($this->expenditureId) && isset($this->year) && isset($this->month) && isset($this->money))
        {
            $currentDate = \Carbon\Carbon::now()->format('d-m-Y');
            $expenditure = ExpenditureDetail::where('expenditure_id',$this->expenditureId)->where('year',$this->year)->where('month',$this->month)->first();
            if($expenditure==null){
                $expenditure = new ExpenditureDetail();
                $expenditure->expenditure_id = $this->expenditureId;
                $expenditure->year = $this->year;
                $expenditure->month = $this->month;
                $expenditure->date_of_expenditure = $this->date_of_expenditure??$currentDate;
            }
            $expenditure->money = $this->money;
            $expenditure->save();
            if($this->money==0)
            {
                $expenditure->delete();

            }
            return to_route('expenditure-details.index');
        }

    }

    public function render()
    {
        $expenditures = Expenditure::all();
        return view('livewire.edit-expenditure',compact('expenditures'));
    }

}
