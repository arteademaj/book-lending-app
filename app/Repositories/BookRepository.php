<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all()
    {
        return Book::all();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function findById(int $id): ?Book
    {
        return Book::find($id);
    }

    public function update(Book $book): bool
    {
        return $book->save();
    }
}
