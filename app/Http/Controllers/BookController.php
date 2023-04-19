<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the book.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BookCollection(Book::all());
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50|unique:books',
            'author' => 'required|max:50',
            'publication_date' => 'required|date|before:now',
            'description' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        $book = Book::create($validator->validated());
        return response()->json(['success' => true, 'data' => new BookResource($book)]);
    }

    /**
     * Display the specified book.
     *
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $book = Book::find($id);
        if (!$book)
            return response()->json(['success' => false, 'message' => 'Book does not exist'], 404);
        return response()->json(['success' => true, 'data' => new BookResource($book)]);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $book = Book::find($id);
        if (!$book)
            return response(['success' => false, 'message' => 'Book does not exist'], 404);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50|unique:books',
            'author' => 'required|max:50',
            'publication_date' => 'required|date|before:now',
            'description' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['success' => false, 'message' => $validator->errors()], 400);
        $book->update($validator->validated());
        return response()->json(['success' => true, 'data' => new BookResource($book)]);
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $book = Book::find($id);
        if ($book)
            return response(['success' => $book->delete()]);
        return response(['success' => false, 'message' => 'Book does not exist'], 404);
    }
}
