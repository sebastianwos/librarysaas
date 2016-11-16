<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{

    protected $dates = ['return_at'];
    protected $fillable = ['path', 'name', 'author'];
    /** Book's Library
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('return_at');
    }

    public function library()
    {
        return $this->belongsTo('App\Library');
    }

    public function getReturnAtAttribute()
    {
        return new Carbon($this->pivot->return_at);
    }

    public function delete()
    {
        Storage::delete($this->path);
        parent::delete();
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

}
