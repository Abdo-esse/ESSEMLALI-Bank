<?php 

use App\core\Router;

Router::add("GET","/","HomeController@index");
Router::add("GET","/Apropos","HomeController@apropos");
Router::add("GET","/prets","HomeController@prets");
