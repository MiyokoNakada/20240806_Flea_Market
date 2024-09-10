<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

class PurchaseTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function order_sucess()
    {
        $item = Item::where('sold', '0')->first();
        $item_id = $item->id;
        $user = User::first();
        $this->actingAs($user);

        session([
            'postal_code' => '123-4567',
            'address' => 'Test Address',
            'building' => 'Test Building',
            'payment_method' => 'credit_card',
        ]);

        $response = $this->post(route('purchase', ['item_id' => $item->id]));

        $response->assertStatus(200);
        $response->assertViewIs('payment');
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => '123-4567',
            'address' => 'Test Address',
            'building' => 'Test Building',
        ]);
        $this->assertDatabaseHas('payments', [
            'order_id' => Order::first()->id,
            'payment_method' => 'credit_card',
        ]);
        $this->assertEquals(true, Item::find($item_id)->sold);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function order_unsucess_address_missng()
    {
        $item = Item::where('sold', '0')->first();
        $user = User::first();
        $this->actingAs($user);

        $response = $this->post(route('purchase', ['item_id' => $item->id]));

        $response->assertRedirect();
        $response->assertSessionHasErrors(['message' => '住所情報が不足しています。住所を登録してください。']);
        $this->assertDatabaseMissing('orders', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('payments', ['order_id' => Order::first()->id ?? null]);
    }
}
