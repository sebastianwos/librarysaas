<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{

    protected $fillable = [
        'name', 'slug'
    ];

    protected $with = [
        'owner',
        'books'
    ];

    /**
     * Library ebooks relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    /**
     * The owner of the library
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(){
        return $this->belongsTo('App\User');
    }

}
