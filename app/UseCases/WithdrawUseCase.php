<?php

namespace App\UseCases;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\ATMService;
use Illuminate\Support\Facades\DB;

class WithdrawUseCase
{
    protected ATMService $atmService;
    public function __construct(ATMService $atmService)
    {
        $this->atmService = $atmService;
    }

    public function execute(int $userId, int $amount)
    {
        return DB::transaction(function () use ($userId, $amount) {
            $account = Account::where('user_id', $userId)->lockFOrUpdate()->first();
            if (!$account || $account->balance < $amount) {
                return ['error' => "Balans kifayət deyil"];
            }

            $notes = $this->atmService->calculateNotes($amount);
            if (isset($notes['error'])) {
                return ['error' => $notes['error']];
            }

            $account->balance -= $amount;
            $account->save();

            Transaction::create([
                'account_id' => $account->id,
                'amount' => -$amount,
                'type' => 'withdraw'
            ]);
            return [
                'message' => 'Pul ugurla chixarildi',
                'notes' => $notes,
                'new_balance' => $account->balance,
            ];
        }, 5);
    }
}
