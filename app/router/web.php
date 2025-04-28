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

Router::add("GET", "/accueil-employe", "EmployeViewController@index");
Router::add("POST", "approuver/{id}", "CompteController@approuver");
Router::add("POST", "/refuser/{id}", "CompteController@refuser");
Router::add("GET", "/demande-compte", "EmployeViewController@demandeComptes");
Router::add("GET", "/voir/{id}", "EmployeViewController@demandeCompte");
Router::add("POST", "/addClient", "ClientController@add");
Router::add("GET", "/clients", "EmployeViewController@clients");
Router::add("POST", "/client/{id}", "EmployeViewController@client");
Router::add("POST", "client/delete/{id}", "ClientController@delete");
Router::add("GET", "/versement", "TransactionViewControllers@versement");
Router::add("POST", "/deposit", "TransactionController@deposit");
Router::add("GET", "/retrait", "TransactionViewControllers@retrait");
Router::add("POST", "/retrait", "TransactionController@retrait");
Router::add("GET", "/virement", "TransactionViewControllers@virement");
Router::add("POST", "/virement", "TransactionController@virementEmploye");
Router::add("GET", "/recu/virement", "ReçuController@recuVirement");
Router::add("POST", "/recu/virement/telecharger", "TelechargerPeçuController@telechargerRecuVirement");
Router::add("GET", "/recu/versement", "ReçuController@recuVersement");
Router::add("POST", "/recu/versement/telecharger", "TelechargerPeçuController@telechargerRecuVersement");
Router::add("GET", "/recu/retrait", "ReçuController@recuRetrait");
Router::add("POST", "/recu/retrait/telecharger", "TelechargerPeçuController@telechargerRecuRetrait");
Router::add("GET", "/search-clien", "ClientController@searchClient");
Router::add("GET", "/all-clients", "ClientController@allClients");
Router::add("GET", "/all-demande-clients", "ClientController@allDemandeClients");
Router::add("GET", "/search-demande-clien", "ClientController@searchDemandeClient");


//client routes
Router::add("GET", "/client", "ClientViewController@index");
Router::add("GET", "update-info", "ClientViewController@edite");
Router::add("POST", "/client/update/{id}", "ClientController@update");
Router::add("GET", "/historique", "HistoriqueController@historique");
Router::add("GET", "/releve", "ClientViewController@releve");
Router::add("POST", "/telecharger/rib", "ClientController@telechargeRib");
Router::add("GET", "/virement-client", "TransactionViewControllers@virementClient");
Router::add("POST", "/virement-client", "TransactionController@virementClient");
Router::add("GET", "recu/virement-client", "ReçuController@recuVirementClient");
Router::add("POST", "/recu/virement-client/telecharger", "TelechargerPeçuController@telechargerVirementClient");








