{% extends "components/baseDashbord.twig" %}

{% block title %}Page d'accueil{% endblock %}
{% block sidebar %}
{% include "layout/sidebarEmploye.twig" %}
{% endblock %}


{% block content %}

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex flex-col md:flex-row items-center justify-between p-4 bg-white dark:bg-gray-900">
        <!-- Titre et bouton d'ajout -->
        <div class="flex items-center mb-4 md:mb-0">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Gestion des clients</h2>
        </div>


        
        <!-- Recherche -->
        <div class="relative w-full md:w-auto">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher un administrateur...">
        </div>
    </div>
    
    <div class="overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    prenom
                </th>
                <th scope="col" class="px-6 py-3">
                    nom
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Date de création
                </th>
                <th scope="col" class="px-6 py-3">
                    Statut
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
        {% for client in clients %}
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ client.nom }}
                </td>
                <td class="px-6 py-4">
                    {{ client.prenom }}
                </td>
                <td class="px-6 py-4">
                    {{ client.email }}
                </td>
                <td class="px-6 py-4">
                    {{ client.dateCreation|date('Y-m-d') }}
                </td>
                <td class="px-6 py-4">
                    {% if client.isActive  %}
                    <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">Actif</span>
                        {% else %}
                            <span class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Inactif</span>
                    {% endif %}
                </td>
                <td class="px-6 py-4">
                    <div class="flex space-x-2">
                        <a href="editeEploye/{{ client.id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <button type="button" class="px-3 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Modifier
                            </button>
                        </a>
                        
                        <form method="post" action="activer/{{ client.id }}" onsubmit="return confirm('Voulez-vous vraiment activer cet employé?');">
                            <button type="submit" class="px-3 py-1.5 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                voir
                            </button>
                        </form>                        
                        
                    </div>
                </td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
</div>


    <!-- Pagination -->
<div class="flex items-center justify-between p-4 bg-white dark:bg-gray-900">
    <div class="flex items-center text-sm">
        <span class="text-gray-700 dark:text-gray-400">Affichage de 1 à 3 sur 3 entrées</span>
    </div>
    <div class="inline-flex mt-2 xs:mt-0">
        <button class="flex items-center justify-center px-4 h-10 text-sm font-medium text-white bg-gray-800 rounded-s dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
            </svg>
            Précédent
        </button>
        <button class="flex items-center justify-center px-4 h-10 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            Suivant
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </button>
    </div>
</div>
{% endblock %}