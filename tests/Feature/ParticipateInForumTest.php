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

        $this->withExceptionHandling()
             ->post('/threads/some-channel/1/replies', [])
             ->assertRedirect('/login');
             
        // $this->expectException('Illuminate\Auth\AuthenticationException');
        // $this->post('/threads/some-channel/1/replies', []);
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

    /** @test */
    public function replies_require_a_body()
    {

        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
             ->asserSessionHasErrors('body');
    }
}
