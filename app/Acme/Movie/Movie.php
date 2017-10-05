<?php

namespace Acme\Movie;

use Carbon\Carbon;

class Movie
{
    protected  $name;
    protected  $rating;
    protected  $genres;
    protected  $showings;

    /**
     * Constructor declaration of a Movie
     *
     * @return mixed
     */
    public function __construct($movie)
    {
        $this->name = $movie['name'];
        $this->rating = $movie['rating'];
        $this->genres = $movie['genres'];
        $this->showings = $movie['showings'];
    }

    /**
     * Return the name of the movie
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the rating of a movie
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Return the genres of a movie
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }
    /**
     * Return the showings availability of a movie
     * @return mixed
     */
    public function getShowings()
    {
        return $this->showings;
    }

    /**
     * Return the next available showing of the movie based on a time marker
     * @param string $time the time marker H:i format
     * @param int offset the time offset to add to the time marker
     * @return mixed
     */
    public function getNextShowing($time, $offset = 30)
    {
        $limit = Carbon::createFromFormat('H:i:sT', $time.":00+11:00")->addMinutes($offset);
        foreach ($this->showings as $showing)
        {
            $showTime = Carbon::createFromFormat('H:i:sT', $showing);
            if(strtotime($limit) <= strtotime($showTime)){
                return $this->format($showTime);
            }
        }
        return "";
    }

    /**
     * Method isShowingAfter return a true if a movie is scheduled after the time plus offset passed in parameter, false otherwise
     * @param $time
     * @param int $offset
     * @return bool
     */
    public function isShowingAfter($time, $offset = 30)
    {
        $limit = Carbon::createFromFormat('H:i:sT', $time.":00+11:00")->addMinutes($offset);
        foreach ($this->showings as $showing)
        {
            $showTime = Carbon::createFromFormat('H:i:sT', $showing);
            if(strtotime($limit) <= strtotime($showTime)){
                return true;
            }
        }
        return false;
    }

    /**
     * Method hasGenre return true if the movie has the genre given as a paramater
     * @param $filterGenre
     * @return bool
     */
    public function hasGenre($filterGenre)
    {
        foreach ($this->genres as $genre)
        {
            if(strtolower($genre) == strtolower($filterGenre) ){
                return true;
            }
        }
        return false;
    }

    public function format(Carbon $time){
         return $time->minute == 0 ? $time->format('ga') : $time->format('g:ia');
    }
}
