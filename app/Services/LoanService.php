<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanService
{
    public function createLoan(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
        ]);

        $book = Book::find($request->book_id);

        if ($book->available_copies < 1) {
            return response()->json(['error' => 'No copies available'], 409);
        }

        $book->available_copies -= 1;
        $book->save();

        $loan = Loan::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'loaned_at' => now(),
            'due_at' => $request->due_at ?? now()->addDays(14),
        ]);

        return response()->json($loan, 201);
    }

    public function returnLoan($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->returned_at) {
            return response()->json(['message' => 'Loan already returned'], 400);
        }

        $loan->returned_at = Carbon::now();
        $loan->save();

        $book = Book::find($loan->book_id);
        $book->available_copies += 1;
        $book->save();

        return response()->json(['message' => 'Book returned successfully']);
    }
}
