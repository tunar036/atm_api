<?php

namespace App\Services;

class ATMService
{
    public function calculateNotes($amount)
    {
        $notes =  [
            200 => 0,
            100 => 0,
            50  => 0,
            20  => 0,
            10  => 0,
            5   => 0,
        ];

        foreach ($notes as $note => $count) {
            if ($amount >= $note) {
                $notes[$note] = intdiv($amount, $note);
                $amount  = $amount % $note;
            }
        }
        return $notes;
    }
}
