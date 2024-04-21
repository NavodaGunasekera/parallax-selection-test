<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_Cate extends Model
{
    use HasFactory;

    protected $table='book_cate';

    protected $fillable = ['id','name'];
}
