<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    $this->actingAs(factory('App\User')->create());

    $thread = factory('App\Thread')->make();
    $this->post('/threads', $thread->toArray());

    $this->get($thread->path())
		 ->assertSee($thread->title)
    	 ->assertSee($thread->body);
   }

   /** @test */
   public function guests_cannot_create_threads()
   {

   	$this->expectException('Illuminate\Auth\AuthenticationException');

   	$thread = factory('App\Thread')->make();
    $this->post('/threads', $thread->toArray());
   } 
}
