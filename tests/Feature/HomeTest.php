<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');

        $response->assertSeeText('Melody G. Casinillo Laravel');
    }
    public function testLaravelPageIsWorkingCorrectly()
    {
        $response = $this->get('/home');

        $response->assertSeeText('Welcome to Laravel!');
    }
}
