<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    private $transactionRepository;
    public function __construct(TransactionRepositoryInterface $transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }
    public function index(Request $request)
    {
        $mockStatus = $request->header('X-Mock-Status', 'success');

        if ($mockStatus === 'accepted') {
            return response()->json([
                'status' => 'accepted',
                'transaction_id' => uniqid('txn_'),
                'amount' => $request->input('amount'),
                'currency' => $request->input('currency', 'BDT'),
                'message' => 'Mock payment processed successfully'
            ]);
        } elseif ($mockStatus === 'failed') {
            return response()->json([
                'status' => 'failed',
                'transaction_id' => uniqid('txn_'),
                'amount' => $request->input('amount'),
                'currency' => $request->input('currency', 'BDT'),
                'message' => 'Mock payment failed'
            ], 400);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid X-Mock-Status value'
            ], 400);
        }
    }
    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionRepository->store($request);

        return response()->json(['success' => 'Transaction stored successfully', 'transaction' => $transaction], 201);
    }
}
