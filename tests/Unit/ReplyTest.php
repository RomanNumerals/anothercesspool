<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{
	use DatabaseMigrations;

    /** @test*/
    public function it_has_an_owner()
    {
       $reply = factory('App\User')->create();

       $this->asserInstanceOf('App\User', $reply->owner);
    }
}
