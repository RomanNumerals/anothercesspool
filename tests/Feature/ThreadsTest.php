<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test*/
    public function thread_browsing()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}
