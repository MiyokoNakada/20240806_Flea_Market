<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\ConditionsTableSeeder;
use Database\Seeders\ItemsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\CategoryItemTableSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;


abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

     protected function setUp(): void
    {
        parent::setUp();

        Schema::disableForeignKeyConstraints();
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Schema::enableForeignKeyConstraints();

        $this->startSession();
    }
}
