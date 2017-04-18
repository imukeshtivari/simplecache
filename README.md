# SimpleCache

## a php library for caching json/html data on local disk for faster retrieval

_SimpleCache_ is a php library with very simple apis to use, primery purpose of this library is to cache the get request data on your local disk for faster retrieval.

For example

    require dirname(__FILE__) . "/src/SimpleCache.php";

    $sCache = new SimpleCache(dirname(__FILE__) . "/cache");
    
    $sCache->data = [
      // pass data here
      // "_ts" => time() // for getting fresh data, you can add a timestamp here.
    ];

    $username = "usnername";
    $password = "password";

    $sCache->headers = [
      // pass header here
      // "Authorization: Basic " . base64_encode("{$username}:{$password}") // ypu can pass api_key and any other header from this array
    ];

    $response = $sCache->get("http://www.omdbapi.com/?t=2012");
    
And this returns:
    
    {"Title":"2012","Year":"2009","Rated":"PG-13","Released":"13 Nov 2009","Runtime":"158 min","Genre":"Action, Adventure, Sci-Fi","Director":"Roland Emmerich","Writer":"Roland Emmerich, Harald Kloser","Actors":"John Cusack, Amanda Peet, Chiwetel Ejiofor, Thandie Newton","Plot":"A frustrated writer struggles to keep his family alive when a series of global catastrophes threatens to annihilate mankind.","Language":"English, French, Tibetan, Mandarin, Russian, Hindi, Portuguese, Latin, Italian","Country":"USA","Awards":"5 wins & 20 nominations.","Poster":"https://images-na.ssl-images-amazon.com/images/M/MV5BMTY0MjEyODQzMF5BMl5BanBnXkFtZTcwMTczMjQ4Mg@@._V1_SX300.jpg","Ratings":[{"Source":"Internet Movie Database","Value":"5.8/10"},{"Source":"Rotten Tomatoes","Value":"39%"},{"Source":"Metacritic","Value":"49/100"}],"Metascore":"49","imdbRating":"5.8","imdbVotes":"295,844","imdbID":"tt1190080","Type":"movie","DVD":"02 Mar 2010","BoxOffice":"$166,112,167.00","Production":"Sony Pictures/Columbia","Website":"http://www.whowillsurvive2012.com/","Response":"True"}

## Installation

    require dirname(__FILE__) . "/src/SimpleCache.php";
    $sCache = new SimpleCache(dirname(__FILE__) . "/cache", ".ch");

## Usage

    see the example above.

## Contribution Guidelines
Tell me how I can help out including wanted features and code standards

## License
MIT
