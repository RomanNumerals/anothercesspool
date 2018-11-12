<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test*/
    public function a_user_can_browse_all_threads()
    {
        # creates random threads for the purpose of testing
        $thread = factory('App\Thread')->create();

        # when a user visits threads, return all threads
        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    /** @test*/
    public function a_user_can_browse_a_specific_thread()
    {
         # creates random threads for the purpose of testing
        $thread = factory('App\Thread')->create();


        # when a user visits a specific thread, return that thread based on the id
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
