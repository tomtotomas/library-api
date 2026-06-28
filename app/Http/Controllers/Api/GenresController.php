<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Genres;

class GenresController extends Controller
{
    public function index()
    {
        $genres = Genres::all();
        return response()->json($genres);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre = Genres::create($validatedData);

        return response()->json(['message' => 'Genre created successfully', 'genre' => $genre], 201);
    }

    public function show($id)
    {
        $genre = Genres::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        return response()->json($genre);
    }

    public function update(Request $request, $id)
    {
        $genre = Genres::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre->update($validatedData);

        return response()->json(['message' => 'Genre updated successfully', 'genre' => $genre]);
    }

    public function destroy($id)
    {
        $genre = Genres::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        $genre->delete();

        return response()->json(['message' => 'Genre deleted successfully']);
    }

}
