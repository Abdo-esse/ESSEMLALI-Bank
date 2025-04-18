{% extends "components/baseDashbord.twig" %}

{% block title %}Page d'accueil{% endblock %}
{% block sidebar %}
{% include "layout/sidebarClient.twig" %}
{% endblock %}


{% block content %}

<head>

</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">      
        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800"> Transactions</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir tout</a>
            </div>
            
            <div class="divide-y divide-gray-200">
                <div class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">Virement reçu - Ahmed Bennani</p>
                        <p class="text-sm text-gray-500">15 avril 2025</p>
                    </div>
                    <span class="font-semibold text-green-600">+1 500,00 MAD</span>
                </div>
                
                <div class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">Paiement Marjane</p>
                        <p class="text-sm text-gray-500">13 avril 2025</p>
                    </div>
                    <span class="font-semibold text-red-600">-320,50 MAD</span>
                </div>
                
                <div class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">Retrait GAB</p>
                        <p class="text-sm text-gray-500">10 avril 2025</p>
                    </div>
                    <span class="font-semibold text-red-600">-1 000,00 MAD</span>
                </div>
                
                <div class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">Salaire</p>
                        <p class="text-sm text-gray-500">01 avril 2025</p>
                    </div>
                    <span class="font-semibold text-green-600">+12 500,00 MAD</span>
                </div>
            </div>
        </div>
    </div>
</body>
{% endblock %}