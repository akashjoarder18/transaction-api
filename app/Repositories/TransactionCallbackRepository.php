<?php
namespace App\Repositories;
use App\Repositories\Interfaces\TransactionCallbackRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class TransactionCallbackRepository implements TransactionCallbackRepositoryInterface{

    public function store($data){
      $transaction =Transaction::where('transaction_id', $data->transaction_id)->first();
      $transaction->update([
            'status' => $data->status,
            'message' => $data->message,
        ]);
      return $transaction;
    }

}