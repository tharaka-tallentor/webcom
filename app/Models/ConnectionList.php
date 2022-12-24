<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionList extends Model
{
    use HasFactory;
    protected $table = 'connection_list';
    public $timestamps = true;
}
