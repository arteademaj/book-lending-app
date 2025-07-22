<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookService
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks()
    {
        return $this->bookRepository->all();
    }

    public function createBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn',
            'available_copies' => 'required|integer|min:0',
        ]);

        return $this->bookRepository->create($data);
    }
}
