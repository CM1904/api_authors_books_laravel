<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Books::find($id);
        
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'published_date' => 'required|date',
            'author_id' => 'required|integer|exists:authors,id',
        ]);

        $book = Books::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'published_date' => $request->published_date,
            'author_id' => $request->author_id,
        ]);

        return response()->json(['message' => 'Book created successfully', 'book' => $book], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'isbn' => 'string|max:255',
            'published_date' => 'date',
            'author_id' => 'integer|exists:authors,id',
        ]);

        $book = Books::find($id);
        
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->only(['title', 'isbn', 'published_date', 'author_id']));

        return response()->json(['message' => 'Book updated successfully', 'book' => $book]);
    }

    public function destroy($id)
    {
        $book = Books::find($id);
        
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
