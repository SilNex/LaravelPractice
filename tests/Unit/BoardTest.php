<?php

namespace Tests\Unit;

use App\Board;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBoard(): void
    {
        $board = factory('App\Board')->create();

        $this->assertDatabaseHas('boards', $board->toArray());
    }
}
