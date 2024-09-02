<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class FavouriteTest extends TestCase
{
    //お気に入り登録
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_add_favorites()
    {
        Storage::fake('local');

        $item = Item::with('categories', 'condition', 'comments')->first();
        $user = User::first();

        $this->actingAs($user)->post('/favourite/' . $item->id);
        $this->assertDatabaseHas('favourites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    //お気に入り削除
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_remove_favorites()
    {
        Storage::fake('local');

        $item = Item::with('categories', 'condition', 'comments')->first();
        $user = User::first();

        $this->actingAs($user)->delete('/unfavourite/' . $item->id);
        $this->assertDatabaseMissing('favourites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

}
