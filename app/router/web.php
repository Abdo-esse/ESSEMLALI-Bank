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
Router::add("GET","/Employe","EmployeController@index");
Router::add("POST","/AddEmploye","EmployeController@create");
Router::add("GET","/editeEploye/{id}","EmployeController@edite");
Router::add("POST","/updateEmploye/{id}","EmployeController@update");
Router::add("POST","/desactiver/{id}","EmployeController@desactiver");
Router::add("POST","/activer/{id}","EmployeController@activer");
Router::add("POST","/delete/{id}","EmployeController@delete");
Router::add("GET","/signIn","ClientController@create");
Router::add("POST","/store","ClientController@store");
Router::add("GET","/clients","ClientController@clients");
