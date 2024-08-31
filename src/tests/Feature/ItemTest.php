<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\ConditionsTableSeeder;
use Database\Seeders\ItemsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Support\Facades\Storage;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_retrieve_item_list()
    {
        Storage::fake('local');

        $this->seed(ConditionsTableSeeder::class);
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(UsersTableSeeder::class);
        $this->seed(ItemsTableSeeder::class);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(Item::first()->name);
    }


}
