<?php

namespace Acme\Movie;

use Acme\Repos\MovieRepository;
use Illuminate\Database\Eloquent\Collection;

abstract class MovieCollection extends Collection implements MovieRepository
{
    public function init($str){
        $data = collect(json_decode($str, true));
        foreach ($data as $item){
            $this->prepend($item);
        }
    }

    //Sort the collection by rating
    public function sortRatings()
    {
        return $this->sortByDesc('rating');
    }

    //Reduce the collection by returning only the films having the genre passed as a parameter
    public function genre($genre)
    {
        return $this->filter(function ($movie, $key) use ($genre) {
            $oMovie = new Movie($movie);
            return $oMovie->hasGenre($genre);
        });
    }

    //Reduce the collection by returning only movies starting after 30 minutes from the time parameter
    public function showingNext($time)
    {
        return $this->filter(function ($movie, $key) use ($time) {
            $oMovie = new Movie($movie);
            return $oMovie->isShowingAfter($time);
        });
    }

    //Return a displayable collection of string
    public function display($time)
    {
        if($this->count() > 0)
        {
            return $this->map(function ($movie, $key) use ($time) {
                $oMovie = new Movie($movie);
                return $oMovie->getName(). ', showing at '. $oMovie->getNextShowing($time);
            });
        }
    }

    public function addToCollection($collection)
    {
        foreach ($collection as $item)
        {
            $this->push($item);
        }
    }

}
