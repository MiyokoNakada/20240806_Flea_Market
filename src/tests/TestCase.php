<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
