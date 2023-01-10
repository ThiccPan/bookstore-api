<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::paginate(10);
        return response()->json([
            "status" => "success",
            "data" => $genres 
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateGenreReq($request);
        $data = $request->all();
        $newGenre = Genre::create($data);
        return response()->json([
            "status" => "success",
            "data" => $newGenre,
            "nama" => $newGenre["genre"]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return response()->json([
            "data" => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $this->validateGenreReq($request);
        $genre->genre = $request->genre;
        $genre->save();
        return response()->json([
            "status" => "success",
            "data" => $genre
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json([
            "status" => "success",
            "message" => "successfully deleted"
        ]);
    }

    /**
     * validation rule for genre request
     */
    private function validateGenreReq(Request $request)
    {
        $request->validate([
            "genre" => "required|string|unique:genres|max:255"
        ]);
    }
}
