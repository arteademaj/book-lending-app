<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BookRepository;
use App\Repositories\LoanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanService
{
    protected $bookRepository;
    protected $loanRepository;

    public function __construct(BookRepository $bookRepository, LoanRepository $loanRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->loanRepository = $loanRepository;
    }

    public function createLoan(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
        ]);

        $book = $this->bookRepository->findById($request->book_id);

        if ($book->available_copies < 1) {
            return response()->json(['error' => 'No copies available'], 409);
        }

        $book->available_copies -= 1;
        $this->bookRepository->update($book);

        $loan = $this->loanRepository->create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'loaned_at' => now(),
            'due_at' => $request->due_at ?? now()->addDays(14),
        ]);

        return response()->json($loan, 201);
    }

    public function returnLoan($id): \Illuminate\Http\JsonResponse
    {
        $loan = $this->loanRepository->findById($id);

        if ($loan->returned_at) {
            return response()->json(['message' => 'Loan already returned'], 400);
        }

        $loan->returned_at = Carbon::now();
        $this->loanRepository->update($loan);

        $book = $this->bookRepository->findById($loan->book_id);
        $book->available_copies += 1;
        $this->bookRepository->update($book);

        return response()->json(['message' => 'Book returned successfully']);
    }
}
