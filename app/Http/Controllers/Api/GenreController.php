<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre; 

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre = Genre::create($validatedData);

        return response()->json([
            'message' => 'Genre created successfully', 
            'genre' => $genre
        ], 201);
    }

    public function show(Genre $genre)
    {
        return response()->json($genre);
    }

    public function update(Request $request, Genre $genre)
    {
        $validatedData = $request->validate([
            'name' => ($request->isMethod('patch') ? 'sometimes|' : '') . 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre->update($validatedData);

        return response()->json([
            'message' => 'Genre updated successfully', 
            'genre' => $genre
        ]);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json(['message' => 'Genre deleted successfully']);
    }
}