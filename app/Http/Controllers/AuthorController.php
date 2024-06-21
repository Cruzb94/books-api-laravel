<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Author;
use App\Models\Book;

class AuthorController extends Controller
{
    public function index()
    {
        $authors= Author::all();

         return response()->json([
            'status'  => 'success',
            'authors'  => $authors, 
        ], 200);
       
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'date_birth' => 'required|date',
                'literary_genre' => 'required|string|max:255',
            ]);

        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
       

        $author = new Author;
		$author->name = $request->input('name');
        $author->date_birth = $request->input('date_birth');
        $author->literary_genre = $request->input('literary_genre');
		$author->quantity = 0;
        $author->save();

        return response()->json([
            'status'  => 'success',
            'message' => "Successfully created author!"
        , 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
    
        return response()->json([
            'status'  => 'success',
            'author'  => $author
        , 200]);
    }


    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'date_birth' => 'required|date',
                'literary_genre' => 'required|string|max:255',
            ]);

        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }
       

        $author = Author::findOrFail($id);
		$author->name = $request->input('name');
        $author->date_birth = $request->input('date_birth');
        $author->literary_genre = $request->input('literary_genre');
        $author->save();

        return response()->json([
            'status'  => 'success',
            'message' => "Successfully updated author!"
        , 200]);
    }


    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json([
            'status'  => 'success',
            'message' => "Successfully deleted author!"
        , 200]);
    }

  
}
