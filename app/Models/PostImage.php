<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $table = 'post_image';
    protected $primaryKey = 'post_image_id';
    public $timestamps = true;
}
