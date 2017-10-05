<?php

namespace Acme\Repos;

use Acme\Movie\MovieCollection;

class StringMovieRepository extends MovieCollection
{
    public function init($str){
        $this->addToCollection(collect(json_decode($str, true)));
    }
}