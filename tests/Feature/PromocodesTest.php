<?php

namespace Tests\Feature;

use App\PromoCode;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PromocodesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retrieves_promo_code_discount_by_promo_code()
    {
        $this->withoutExceptionHandling();
        $promoCode = factory(PromoCode::class)->create([
            'code' => 'APPLY30',
            'amount' => 30,
        ]);

        $response = $this->json('get', "promo-codes/APPLY30");

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'isValid' => true,
                'amount' => 30,
            ]
        ]);
    }

    /** @test */
    public function providing_invalid_promo_code_returns_invalid_response()
    {
        $promoCode = factory(PromoCode::class)->create([
            'code' => 'APPLY30',
            'amount' => 30,
        ]);

        $response = $this->json('get', "promo-codes/invalid");

        $response->assertStatus(404);
    }
}
