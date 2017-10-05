<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchTest extends TestCase
{
    /** @test  */
    public function testRootPathTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test  */
    public function testSearchPathTest()
    {
        $response = $this->get('/search');

        $response->assertStatus(302);
    }

    /** @test  */
    public function searchMovie()
    {
        $response = $this->get('/search?genre=animation&showing=12%3A00');
        $response->assertSee("Zootopia, showing at 7pm");
    }
}
