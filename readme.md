# Movie recommentations program

Light interface to search movie recommendations based on a genre and a time.
It uses SOLID design principles.

### Demo

A demo can be found here: http://movies.chautr.com

### Tech

The program uses laravel framework 5.5 and requires PHP 7.1

Useful classes answering to the problem can be found here:

```sh
app
|_ Acme
|_ __ Movie
|_ __ __ Movie
|_ __ __ MovieCollection
|_ __ Repos
|_ __ __ JsonMovieRepository
|_ __ __ MovieRepository
|_ __ __ StringMovieRepository
|_ Http
|_ __ Controllers
|_ __ __ MovieController
|_ __ Requests
|_ __ __ SearchMovieRequest
|_ tests
|_ __ Feature
|_ __ __ SearchTest
|_ __ Unit
|_ __ __ MovieTest
|_ __ __ MovieCollectionTest
```

### Installation

- Clone the reposirory
- Run composer install
- Start the server

```sh
$ cd /path/to/repository
$ composer install
$ php artisan serve
Laravel development server started: <http://127.0.0.1:8000>
```
### Using the interface

- After starting the server, access the url http://127.0.0.1:8000
- Enter a genre in the genre field (ex: animation)
- Enter a time in the showings field (ex: 12:00)

### Using the code

- The code can be imported from Acme folder.
```sh
import "github.com/remichautemps/movie-recommendations/tree/master/app/Acme"
```

### Testing

- Using phpunit embeded with Laravel, run the phpunit command from the repository folder
```sh
# cd /path/to/repository
$ vendor/bin/phpunit
```