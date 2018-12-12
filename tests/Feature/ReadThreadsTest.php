<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

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

    /** @test*/
    public function a_user_can_filter_threads_by_channel()
    {

        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads' . $channel->slug)
             ->assertSee($threadInChannel->title)
             ->assertDontSee($threadNotInChannel->title);
    }

    public function a_user_can_filter_thread_by_thread_creator()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('thread?by=JohnDoe')
             ->assertSee($threadByJohn->title)
             ->assertDontSee($threadNotByJohn->title);
    }
}
