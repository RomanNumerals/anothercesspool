<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
   
	use DatabaseMigrations;

   /** @test */
   public function auth_user_can_create_new_threads()
   {
   	/**
   	* Given we have an auth user and they reach the create thread endpoint
   	* Upon creation, when visiting thread page, new thread should be seen
    */

    $this->signIn();

    $thread = create('App\Thread');

    $this->post('/threads', $thread->toArray());

    $this->get($response->headers->get('Location'))
		 ->assertSee($thread->title)
    	 ->assertSee($thread->body);
   }

   /** @test */
   public function guests_cannot_create_threads()
   {

    $this->withExceptionHandling();

    $this->get('/threads/create')
         ->assertRedirect('/login');

    $this->post('/threads')
         ->asserRedirect('/login');
   }

   /** @test */
   public function a_thread_requires_a_title()
   {

    $this->publishThread(['title' => null])
         ->assertSessionHasErrors('title');
   }

   /** @test */
   public function a_thread_requires_a_body()
   {

    $this->publishThread(['body' => null])
         ->assertSessionHasErrors('body');
   }

    /** @test */
   public function a_thread_requires_a_valid_channel()
   {

    factory('App\Channel', 2)->create();

    $this->publishThread(['channel_id' => null])
         ->assertSessionHasErrors('channel_id');

    $this->publishThread(['channel_id' => 999])
         ->assertSessionHasErrors('channel_id');
   }

   /** @test */
   public function publishThread($overrides = [])
   {
    $this->withExceptionHandling()->signIn();

    $thread = make('App\Thread', $overrides);

    $this->post('/threads', $thread->toArray());
   }
}
