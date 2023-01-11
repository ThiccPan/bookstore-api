<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate(10);
        return response()->json([
            "status" => "success",
            "data" => $authors
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
        $this->isAuthorValid($request);
        $validatedReq = $request->all();
        $newAuthor = Author::create($validatedReq);
        return response()->json([
            "status" => "success",
            "data" => $newAuthor
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return response()->json([
            "data" => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $this->isAuthorValid($request);
        $author->name = $request->name;
        $author->save();
        return response()->json([
            "status" => "success",
            "data" => $author
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json([
            "status" => "success",
            "message" => "author deleted successfully"
        ]);
    }

    private function isAuthorValid(Request $request)
    {
        $request->validate([
            "name" => "required|max:255"
        ]);
    }
}
