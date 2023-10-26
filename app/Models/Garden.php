<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'name', 'description', 'shape', 'width', 'length', 'area', 'image', 'location'];

}
