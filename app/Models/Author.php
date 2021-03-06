<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Follow;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_author',
    ];

    /**
     * Enable timestamps
     */
    public $timestamps = true;

    /**
     * Relationships
     */
    public function books(){
        return $this->hasMany(Book::class, 'id_author');
    }

    public function follows(){
        return $this->hasMany(Follow::class, 'id_author');
    }
}
