<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookBorrowalData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id','user_id','book_id','borrowal_date','return_date','created_at','updated_at'];

    public function books()
    {
        return $this->belongsTo(Book::class , 'book_id')->withTrashed();
    }

    public function libUsers()
    {
        return $this->belongsTo(LibraryUser::class , 'user_id')->withTrashed();
    }
}
