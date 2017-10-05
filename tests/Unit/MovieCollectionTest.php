<?php

namespace Tests\Unit;

use Acme\Movie\Movie;
use Acme\Repos\StringMovieRepository;
use Tests\TestCase;

class MovieCollectionTest extends TestCase
{

    protected $movieCollection;

    public function setUp()
    {
        parent::setUp();
        $data = '
        [
            {
                "name": "The Martian",
                "rating": 20,
                "genres": [
                    "Science Fiction & Fantasy"
                ],
                "showings": [
                    "17:30:00+11:00",
                    "19:30:00+11:00"
                ]
            },
            {
                "name": "Shaun The Sheep",
                "rating": 80,
                "genres": [
                    "Animation",
                    "Comedy"
                ],
                "showings": [
                    "19:00:00+11:00"
                ]
            }
        ]';

        $this->movieCollection = new StringMovieRepository();
        $this->movieCollection->init($data);

    }

    /** @test  */
    public function testSortingByRating()
    {
        $movie = new Movie($this->movieCollection->sortRatings()->first());
        $this->assertTrue($movie->getRating() == 80);
    }

    /** @test  */
    public function testGenreFilter()
    {
        $movie = new Movie($this->movieCollection->genre('Comedy')->first());
        $this->assertTrue($movie->getName() == 'Shaun The Sheep');
    }

    /** @test  */
    public function testShowingNext()
    {
        $timeLimit = '18:00';
        $showing = $this->movieCollection->showingNext('18:00')->all();
        $this->assertTrue(count($showing) == 2);
    }

    /** @test  */
    public function testDisplay()
    {
        $timeLimit = '18:00';
        $display = new StringMovieRepository(collect(["The Martian, showing at 7:30pm", "Shaun The Sheep, showing at 7pm"]));
        $showing = $this->movieCollection->display($timeLimit);
        $this->assertTrue($display->first() == $showing->first() && $display->get(2) == $showing->get(2));
    }
}
