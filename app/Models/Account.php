<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'acc_no',
        'first_name',
        'last_name',
        'dob',
        'address',
        'balance',
        'status'
    ];
}
