<?php

namespace App\Policies;

use App\Book;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can show the book.
     *
     * @param User $user
     * @param Book $book
     * @return mixed
     */
    public function show(User $user, Book $book)
    {
        return ($user->books->contains($book) || $user->id == $book->library->owner->id);
    }

}
