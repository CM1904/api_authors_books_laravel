<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = Authors::all();
        return response()->json($authors);
    }

    public function show($id)
    {
        $author = Authors::find($id);
        
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json($author);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'nationality' => 'required|string|max:255',
        ]);

        $author = Authors::create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'nationality' => $request->nationality,
        ]);

        return response()->json(['message' => 'Author created successfully', 'author' => $author], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'birthdate' => 'date',
            'nationality' => 'string|max:255',
        ]);

        $author = Authors::find($id);
        
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->update($request->only(['name', 'birthdate', 'nationality']));

        return response()->json(['message' => 'Author updated successfully', 'author' => $author]);
    }

    public function destroy($id)
    {
        $author = Authors::find($id);
        
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->delete();

        return response()->json(['message' => 'Author deleted successfully']);
    }
}
