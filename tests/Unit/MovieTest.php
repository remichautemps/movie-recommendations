<?php

namespace Tests\Unit;

use Acme\Movie\Movie;
use Carbon\Carbon;
use Tests\TestCase;

class MovieTest extends TestCase
{

    protected $movie;

    public function setUp()
    {
        parent::setUp();

        $genres = [
            'Action & Adventure',
            'Animation',
        ];

        $showings = [
            '18:30:00+11:00',
            '19:30:00+11:00',
            '21:30:00+11:00',
        ];

        $this->movie = new Movie(
            [
                'name' => 'Moonlight',
                'rating' => 55,
                'genres' => $genres,
                'showings' => $showings
            ]
        );
    }

    /** @test  */
    public function testNameIsAString()
    {
        $this->assertTrue($this->movie->getName() === 'Moonlight');
    }

    /** @test  */
    public function ratingIsAnInteger()
    {
        $this->assertTrue(is_int($this->movie->getRating()));
    }

    /** @test  */
    public function genresIsArray()
    {
        $this->assertTrue(is_array($this->movie->getGenres()));
    }

    /** @test  */
    public function showingIsArray()
    {
        $this->assertTrue(is_array($this->movie->getShowings()));
    }

    /** @test  */
    public function movieShowingAfter()
    {
        $this->movie = new Movie(
            [
                'name' => 'Moonlight',
                'rating' => 95,
                'genres' => ['Comedie'],
                'showings' => [
                    '19:30:00+11:00',
                    '21:30:00+11:00'
                ]
            ]
        );
        $this->assertEquals('9:30pm', $this->movie->getNextShowing("20:00"));
    }

    /** @test  */
    public function movieIsShowingAfter()
    {
        $this->assertEquals(false,  $this->movie->isShowingAfter("21:20"));
    }

    /** @test  */
    public function movieHasGenre()
    {
        $this->assertEquals(true,  $this->movie->hasGenre("animation"));
    }

    /** @test  */
    public function timeFormatNoMinutes()
    {
        $showTime = Carbon::createFromFormat('H:i:sT', "21:00:00+11:00");
        $this->assertEquals('9pm', $this->movie->format($showTime));
    }

    /** @test  */
    public function timeFormatWithMinutes()
    {
        $showTime = Carbon::createFromFormat('H:i:sT', "21:30:00+11:00");
        $this->assertEquals('9:30pm', $this->movie->format($showTime));
    }
}
