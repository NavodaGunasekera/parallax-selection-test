<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id','title','author','price','stock','book_category_id'];

    public function bookCategory()
    {
        return $this->hasOne(Book_Cate::class, 'id','book_category_id');
    }

}
