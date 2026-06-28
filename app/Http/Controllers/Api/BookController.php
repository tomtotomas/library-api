<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('genres');

        $query->when($request->filled('genre_id'), function ($q) use ($request) {
            $q->whereHas('genres', function($genresQuery) use ($request) {
                $genresQuery->where('genres.id', $request->query('genre_id'));
            });
        });

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'genres' => 'nullable|array',
            'genres.*' => 'integer|exists:genres,id',
        ]);

        $book = Book::create(collect($validatedData)->except('genres')->toArray());

        if (!empty($validatedData['genres'])) {
            $book->genres()->attach($validatedData['genres']);
        }

        return response()->json([
            'message' => 'Book created successfully', 
            'book' => $book->load('genres')
        ], 201);
    }

    public function show(Book $book)
    {
        return response()->json($book->load('genres'));
    }

    public function update(Request $request, Book $book)
    {
        $isPatch = $request->isMethod('patch');

        $validatedData = $request->validate([
            'name' => ($isPatch ? 'sometimes|' : '') . 'required|string|max:255',
            'description' => ($isPatch ? 'sometimes|' : '') . 'nullable|string',
            'image' => ($isPatch ? 'sometimes|' : '') . 'nullable|string',
            'genres' => ($isPatch ? 'sometimes|' : '') . 'nullable|array',
            'genres.*' => ($isPatch ? 'sometimes|' : '') . 'integer|exists:genres,id',
        ]);

        $book->update(collect($validatedData)->except('genres')->toArray());

        if (array_key_exists('genres', $validatedData)) {
            $book->genres()->sync($validatedData['genres'] ?? []);
        }

        $book->unsetRelations();

        return response()->json([
            'message' => 'Book updated successfully', 
            'book' => $book->load('genres')
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}