<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function getAllBooks()
    {
        return Book::all();
    }

    public function createBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn',
            'available_copies' => 'required|integer|min:0',
        ]);

        return Book::create($data);
    }
}
