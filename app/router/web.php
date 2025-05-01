<?php

use App\core\Router;


//public route
Router::add("GET", "/", "PagesController@index");
Router::add("GET", "/apropos", "PagesController@apropos");
Router::add("GET", "/prets", "PagesController@prets");
Router::add("GET", "/login", "LoginController@index");
Router::add("POST", "/login", "LoginController@login");
Router::add("GET", "/sign-in", "ClientViewController@create");
Router::add("POST", "/store", "ClientController@store");
Router::add("POST", "/logout", "LoginController@logout",["middleware"=>"Auth"]);


//Admin route 
Router::add("GET", "/accueil-admin", "AdminController@index",["middleware"=>"Admin"]);
Router::add("GET", "/admins", "AdminController@admin",["middleware"=>"Admin"]);
Router::add("POST", "/addAdmin", "AdminController@create",["middleware"=>"Admin"]);
Router::add("GET", "/employes", "EmployeViewController@employes",["middleware"=>"Admin"]);
Router::add("POST", "/AddEmploye", "EmployeController@create",["middleware"=>"Admin"]);
Router::add("GET", "/edite-eploye/{id}", "EmployeViewController@edite",["middleware"=>"Admin"]);
Router::add("POST", "/updateEmploye/{id}", "EmployeController@update",["middleware"=>"Admin"]);
Router::add("POST", "/desactiver/{id}", "EmployeController@desactiver",["middleware"=>"Admin"]);
Router::add("POST", "/activer/{id}", "EmployeController@activer",["middleware"=>"Admin"]);
Router::add("POST", "/delete/{id}", "EmployeController@delete",["middleware"=>"Admin"]);
Router::add("GET", "/all-employes", "EmployeController@allEmployes",["middleware"=>"Admin"]);
Router::add("GET", "/search-employe", "EmployeController@searchEmployes",["middleware"=>"Admin"]);


//Employe route

Router::add("GET", "/accueil-employe", "EmployeViewController@index",["middleware"=>"Employe"]);
Router::add("POST", "approuver/{id}", "CompteController@approuver",["middleware"=>"Employe"]);
Router::add("POST", "/refuser/{id}", "CompteController@refuser",["middleware"=>"Employe"]);
Router::add("GET", "/demande-compte", "EmployeViewController@demandeComptes",["middleware"=>"Employe"]);
Router::add("GET", "/voir/{id}", "EmployeViewController@demandeCompte",["middleware"=>"Employe"]);
Router::add("POST", "/addClient", "ClientController@add",["middleware"=>"Employe"]);
Router::add("GET", "/clients", "EmployeViewController@clients",["middleware"=>"Employe"]);
Router::add("POST", "/client/{id}", "EmployeViewController@client",["middleware"=>"Employe"]);
Router::add("POST", "client/delete/{id}", "ClientController@delete",["middleware"=>"Employe"]);
Router::add("GET", "/versement", "TransactionViewControllers@versement",["middleware"=>"Employe"]);
Router::add("POST", "/deposit", "TransactionController@deposit",["middleware"=>"Employe"]);
Router::add("GET", "/retrait", "TransactionViewControllers@retrait",["middleware"=>"Employe"]);
Router::add("POST", "/retrait", "TransactionController@retrait",["middleware"=>"Employe"]);
Router::add("GET", "/virement", "TransactionViewControllers@virement",["middleware"=>"Employe"]);
Router::add("POST", "/virement", "TransactionController@virementEmploye",["middleware"=>"Employe"]);
Router::add("GET", "/recu/virement", "ReçuController@recuVirement",["middleware"=>"Employe"]);
Router::add("POST", "/recu/virement/telecharger", "TelechargerPeçuController@telechargerRecuVirement",["middleware"=>"Employe"]);
Router::add("GET", "/recu/versement", "ReçuController@recuVersement",["middleware"=>"Employe"]);
Router::add("POST", "/recu/versement/telecharger", "TelechargerPeçuController@telechargerRecuVersement",["middleware"=>"Employe"]);
Router::add("GET", "/recu/retrait", "ReçuController@recuRetrait",["middleware"=>"Employe"]);
Router::add("POST", "/recu/retrait/telecharger", "TelechargerPeçuController@telechargerRecuRetrait",["middleware"=>"Employe"]);
Router::add("GET", "/search-clien", "ClientController@searchClient",["middleware"=>"Employe"]);
Router::add("GET", "/all-clients", "ClientController@allClients",["middleware"=>"Employe"]);
Router::add("GET", "/all-demande-clients", "ClientController@allDemandeClients",["middleware"=>"Employe"]);
Router::add("GET", "/search-demande-clien", "ClientController@searchDemandeClient",["middleware"=>"Employe"]);


//client routes
Router::add("GET", "/client", "ClientViewController@index",["middleware"=>"Client"]);
Router::add("GET", "update-info", "ClientViewController@edite",["middleware"=>"Client"]);
Router::add("POST", "/update-info", "ClientController@update");
Router::add("GET", "/historique", "HistoriqueController@historique",["middleware"=>"Client"]);
Router::add("GET", "/releve", "ClientViewController@releve",["middleware"=>"Client"]);
Router::add("POST", "/telecharger/rib", "ClientController@telechargeRib",["middleware"=>"Client"]);
Router::add("GET", "/virement-client", "TransactionViewControllers@virementClient",["middleware"=>"Client"]);
Router::add("POST", "/virement-client", "TransactionController@virementClient",["middleware"=>"Client"]);
Router::add("GET", "recu/virement-client", "ReçuController@recuVirementClient",["middleware"=>"Client"]);
Router::add("POST", "/recu/virement-client/telecharger", "TelechargerPeçuController@telechargerVirementClient",["middleware"=>"Client"]);








