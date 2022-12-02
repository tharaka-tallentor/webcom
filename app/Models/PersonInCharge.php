<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonInCharge extends Model
{
    use HasFactory;

    protected $table = 'person_in_charge';
    public $timestamps = true;

    protected $fillable = [
        'pic_uuid',
        'email',
        'password',
        'authorize_by',
        'designation',
        'mobile',
        'password',
        'status',
        'position'
    ];
}
