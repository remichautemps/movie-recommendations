<?php

namespace Acme\Repos;

use Acme\Movie\MovieCollection;

class JsonMovieRepository extends MovieCollection implements MovieRepository
{
    public function init($str){
        $this->addToCollection(collect(json_decode(file_get_contents($str), true)));
    }
}