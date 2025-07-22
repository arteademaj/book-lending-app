<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Loan;

class LoanRepository
{
    public function create(array $data)
    {
        return Loan::create($data);
    }

    public function findById($id)
    {
        return Loan::findOrFail($id);
    }

    public function update(Loan $loan)
    {
        return $loan->save();
    }
}
