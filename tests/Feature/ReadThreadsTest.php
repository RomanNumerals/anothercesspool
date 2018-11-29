<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        # creates random threads for the purpose of testing
        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
    }

    /** @test*/
    public function a_user_can_browse_all_threads()
    {

        # when a user visits threads, return all threads
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    /** @test*/
    public function a_user_can_browse_a_specific_thread()
    {

        # when a user visits a specific thread, return that thread based on the id
        $response = $this->get('/threads/' . $thread->id);

        $response->assertSee($thread->title);
    }

    /** @test*/
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        # when user visits thread page show user responses
        $response = $this->get($this->thread->path());
        
        $response->assertSee($reply->body);
    }
}
