<?php 

use App\core\Router;

Router::add("GET","/","PagesController@index");
Router::add("GET","/Apropos","PagesController@apropos");
Router::add("GET","/prets","PagesController@prets");
