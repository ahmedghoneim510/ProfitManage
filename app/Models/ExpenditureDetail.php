<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureDetail extends Model
{
    use HasFactory;
    protected $fillable = ['expenditure_id', 'money', 'month', 'year', 'notes','date_of_expenditure'];
    public function expenditure()
    {
        return $this->belongsTo(Expenditure::class);
    }
}
