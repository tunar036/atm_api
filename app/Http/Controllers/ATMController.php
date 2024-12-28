<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\UseCases\WithdrawUseCase;


class ATMController extends Controller
{
    protected WithdrawUseCase $withdrawUseCase;
    public function __construct(WithdrawUseCase $withdrawUseCase)
    {
        $this->withdrawUseCase = $withdrawUseCase;
    }
    public function withdraw(Request $request)
    {

        $userId = auth()->id();
        $amount = (int) $request->input('amount');
        
        $result = $this->withdrawUseCase->execute($userId,$amount);
        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], 400);
        };
        return response()->json($result);
    }
}
