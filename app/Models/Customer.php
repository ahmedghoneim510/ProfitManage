<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public mixed $start_month;
    protected $fillable = ['name', 'money', 'present','notes','start_month'];

    public function customerDetails()
    {
        return $this->hasMany(CustomerDetails::class)->orderBy('month');
    }

}
