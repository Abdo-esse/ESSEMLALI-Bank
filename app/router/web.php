<?php 

use App\core\Router;

Router::add("GET","/","PagesController@index");
Router::add("GET","/Apropos","PagesController@apropos");
Router::add("GET","/prets","PagesController@prets");
Router::add("GET","/login","LoginController@index");
Router::add("GET","/demandeCopmte","CompteController@demandeCompte");
Router::add("POST","/login","LoginController@login");
Router::add("GET","/Admin","AdminController@index");
Router::add("GET","/admins","AdminController@admin");
Router::add("POST","/addAdmin","AdminController@addAdmin");
Router::add("GET","/employes","EmployeController@employes");
