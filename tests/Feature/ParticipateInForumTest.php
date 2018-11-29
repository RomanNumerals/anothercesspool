<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForum extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function unathenticated_users_cannot_reply()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);
        // $thread = factory('App\Thread')->create();

        // $reply = factory('App\Reply')->create();
        // $this->post($thread->path().'/replies', $reply->toArray());
    }

    /** @test */
    public function an_auth_user_may_participate_in_threads()
    {

    	# For an authenticated user
        // $user = factory('App\User')->create();
        $this->be($user = factory('App\User'));

        # On an existing thread
        $thread = factory('App\Thread')->create();

        # when the user posts a reply on a specific thread
        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies', $reply->toArray());

        # after reply is posted ensure that it is visible
        $this->get($thread->path());
        $response->assertSee($reply->body); 
    }
}
