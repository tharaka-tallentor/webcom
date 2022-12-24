<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveList extends Model
{
    use HasFactory;
    protected $table = 'approve_list';
    public $timestamps = true;
}
