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
Router::add("POST","/addAdmin","AdminController@create");
Router::add("GET","/employes","EmployeController@employes");
Router::add("POST","/AddEmploye","EmployeController@create");
Router::add("GET","/editeEploye/{id}","EmployeController@edite");
Router::add("POST","/updateEmploye/{id}","EmployeController@update");
