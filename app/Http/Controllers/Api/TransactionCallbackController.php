<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Requests\TransactionCallbackRequest;
use App\Repositories\Interfaces\TransactionCallbackRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class TransactionCallbackController extends Controller
{
    private $transactionCallbackRepository;
    public function __construct(TransactionCallbackRepositoryInterface $transactionCallbackRepository){
        $this->transactionCallbackRepository = $transactionCallbackRepository;
    }
    public function update(TransactionCallbackRequest $request)
    {
        $transaction = $this->transactionCallbackRepository->store($request);
        return response()->json(['success' => 'Transaction updated successfully', 'transaction' => $transaction], 200);
    }
}
