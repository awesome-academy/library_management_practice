<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'like',
        'id_user',
        'id_book',
    ];

    /**
     * Enable timestamps
     */
    public $timestamps = true;

    /**
     * Relationships
     */
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function book(){
        return $this->belongsTo(Book::class, 'id_book');
    }
}