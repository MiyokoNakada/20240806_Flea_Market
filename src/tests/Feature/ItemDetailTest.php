<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ItemDetailTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_view_item_details()
    {
        Storage::fake('local');

        $item = Item::with('categories', 'condition', 'comments')
            ->withCount(['favourites', 'comments'])
            ->first();
        $user = User::first();

        $this->actingAs($user);

        $response = $this->get(route('detail', $item->id));
       
        $response->assertStatus(200)
            ->assertViewIs('detail')
            ->assertViewHasAll([
                'item' => $item,
                'categories' => Category::all(),
                'conditions' => Condition::all(),
                'sellerId' => $item->user_id,
                'isFavourited' => Favourite::where('user_id', $user->id)->where('item_id', $item->id)->exists(),
            ]);

        $response->assertSee($item->name)
            ->assertSee($item->description)
            ->assertSee($item->price)
            ->assertSee($item->condition->name)
            ->assertSee($item->categories->pluck('name')->join(', '))
            ->assertSee($item->comments->pluck('content')->join(', '));
    }
}
