<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\ReviewFormRequest;
use App\Review;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReviewController extends Controller
{

    public function show(Book $book)
    {
        return view('books.reviews', compact('book'));
    }
    
    public function create(Book $book)
    {
        return view('books.reviewform', compact('book'));
    }

    public function store(ReviewFormRequest $request, Book $book)
    {
        Review::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'comment' => $request->input('comment'),
            'rating' => $request->input('rating'),
        ]);

        flash('Your review is successfully added', 'success');
        return redirect('home');
    }
}
