<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BorrowFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class BorrowController extends Controller
{
    public function create(Book $book)
    {
        $maxReturnDate = Carbon::now()->addWeeks($book->period);
        return view('books.borrowform', compact('book', 'maxReturnDate'));
    }

    public function store(BorrowFormRequest $request, Book $book)
    {
        if($request->user()->id == $book->library->owner->id){
            flash('This book is yours - you can\'t borrow your own book', 'info');
            return redirect()->back();
        }

        if($request->user()->books->contains($book)){
            flash('You have borrowed this book already', 'info');
            return redirect()->back();
        }

        $request->user()->borrow($book, $request->input('return_at'));

        flash('Book successfully borrowed', 'success');
        return redirect('home');
    }

    public function destroy(Book $book)
    {
        if(auth()->user()->can('show', $book))
        {
            auth()->user()->returnBook($book);
            flash('Book has been returned successfully', 'success');

            return redirect('home');
        }
    }

}
