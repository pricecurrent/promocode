<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;

class PromoCodesController extends Controller
{
    public function show($code)
    {
        $promoCode = PromoCode::whereCode($code)->firstOrFail();

        return response()->json([
            'data' => [
                'isValid' => true,
                'amount' => $promoCode->amount,
            ]
        ]);
    }
}
