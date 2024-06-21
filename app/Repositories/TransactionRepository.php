<?php
namespace App\Repositories;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class TransactionRepository implements TransactionRepositoryInterface{

    public function store($data){
      return  Transaction::create([
        'transaction_id' => $data->transaction_id,
        'user_id' => $data->user_id,
        'amount' => $data->amount,
        'currency' => $data->currency,
        'status' => $data->status,
        'message' => $data->message,
    ]);
    }

}