<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'account_id' => 1,
            'amount' => 100.00,
            'type' => 'withdraw',
        ]);
        Transaction::create([
            'account_id' => 1,
            'amount' => 200.00,
            'type' => 'deposit',
        ]);
    }
}
