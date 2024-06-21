<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index()
    {
        $books= Book::all();

         return response()->json([
            'status'  => 'success',
            'books'  => $books, 
        ], 201);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'edition' => 'required|string|max:255', 
                'edition_date' => 'required|date',
                'description' => 'required|string|max:255',
                'author_id' => 'required|integer',
            ]);

        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }

        $book = new Book;
		$book->name = $request->input('name');
        $book->edition = $request->input('edition');
        $book->edition_date = $request->input('edition_date');
		$book->description = $request->input('description');
		$book->author_id = $request->input('author_id');
        $book->save();

        return response()->json([
            'status'  => 'success',
            'message' => "Successfully created book!"
        , 201]);
    }


    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        return response()->json([
            'status'  => 'success',
            'book'  => $book
        , 201]);
    }


    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'edition' => 'required|string|max:255', 
                'edition_date' => 'required|date',
                'description' => 'required|string|max:255',
                'author_id' => 'required|integer',
            ]);

        } catch (\Illuminate\Validation\ValidationException $th) {
            return $th->validator->errors();
        }

        $book = Book::findOrFail($id);
		$book->name = $request->input('name');
        $book->edition = $request->input('edition');
        $book->edition_date = $request->input('edition_date');
		$book->description = $request->input('description');
		$book->author_id = $request->input('author_id');
        $book->save();

        return response()->json([
            'status'  => 'success',
            'message' => "Successfully updated book!"
        , 201]);
    }


    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'status'  => 'success',
            'message' => "Successfully deleted book!"
        , 201]);
    }

    public function export() 
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

}
