<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryFormRequest;
use App\Library;
use Illuminate\Http\Request;

use App\Http\Requests;

class LibrariesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libraries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LibraryFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryFormRequest $request)
    {
        $request->user()->libraries()->create($request->all() + ['slug' => str_slug($request->name)]);
        flash('Library added successfully', 'success');
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $library = Library::where('slug', $slug)->firstOrFail();
        return view('libraries.show', compact('library'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Library $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        if(auth()->user()->can('modify', $library)){
            return view('libraries.edit', compact('library'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LibraryFormRequest|Request $request
     * @param Library $library
     * @return \Illuminate\Http\Response
     */
    public function update(LibraryFormRequest $request, Library $library)
    {
        if(auth()->user()->can('modify', $library))
        {
            $library->name = $request->name;
            $library->slug = str_slug($request->name);
            $library->save();
            flash('Library updated successfully', 'success');

            return redirect('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Library $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        if(auth()->user()->can('modify', $library))
        {
            $library->delete();
            flash('Library deleted successfully', 'success');

            return redirect('home');
        }
    }

    /**
     * Uploads libraries files
     * @param Request $request
     * @param Library $library
     * @return false|string
     */
    public function upload(Request $request, Library $library){

        $this->validate($request, [
            'file' => 'mimes:pdf'
        ]);

        $path = $request->file('file')->store('libraries/'.$request->user()->id . '/' . $library->id);
        $book = $library->books()->create([
            'path' => $path,
            'author' => '',
            'name' => $request->file('file')->getClientOriginalName()
        ]);

        return [
            'token' => csrf_token(),
            'name' => $request->file('file')->getClientOriginalName(),
            'show' => route('books.show', ['book' => $book->id]),
            'edit' => route('books.edit', ['book' => $book->id]),
            'delete' => route('books.destroy', ['book' => $book->id])
        ];
    }
}
