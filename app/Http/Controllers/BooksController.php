<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookFormRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class BooksController extends Controller
{

    /**
     * @param Book $book
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show(Book $book)
    {
        if(auth()->user()->can('show', $book))
        {
            return response()->download(storage_path('app/' . $book->path), null, [], null);
        }
        flash('You are not allowed to see this book', 'danger');

        return redirect('home');

    }

    /**
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Book $book)
    {
        if(auth()->user()->can('modify', $book->library))
        {
            return view('books.edit', compact('book'));
        }
    }

    /**
     * @param BookFormRequest $request
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BookFormRequest $request, Book $book)
    {
        if(auth()->user()->can('modify', $book->library))
        {
            $book->name = $request->name;
            $book->author = $request->author;
            $book->period = $request->period;
            $book->save();
            flash('Book updated successfully', 'success');

            return redirect(route('libraries.edit', ['library' => $book->library->id]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        if(auth()->user()->can('modify', $book->library))
        {
            $book->delete();
            flash('Book deleted successfully', 'success');

            return redirect(route('libraries.edit', ['library' => $book->library->id]));
        }
    }

}
