<?php

namespace Tests\Feature\Livewire\Admin\Ticket;

use App\Livewire\Admin\Ticket\Detail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DetailTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Detail::class)
            ->assertStatus(200);
    }
}
