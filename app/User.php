<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Libraries where user is registered
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot('return_at')->withTimestamps();
    }

    /**
     * Books that should be returned
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function booksToReturn(){
        return $this->belongsToMany('App\Book')->wherePivot('return_at', '<', Carbon::now());
    }

    /**
     * Libraries owned by the user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libraries()
    {
        return $this->hasMany('App\Library', 'owner_id');
    }

    /**
     * Borrow a book by the user
     * @param Book $book
     * @param $return_at
     */
    public function borrow(Book $book, $return_at)
    {
        $this->books()->attach($book, ['return_at' => $return_at]);
    }

    /**
     * Return the book
     * @param $book
     */
    public function returnBook($book)
    {
        $this->books()->detach($book);
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

}
