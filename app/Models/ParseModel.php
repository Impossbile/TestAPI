<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParseModel extends Model
{
    //use HasFactory;
    public $timestamps =null;
    protected $fillable = [
        'numberofWorkOrder',
        'createdate',
        'SLA'
        ];

}
