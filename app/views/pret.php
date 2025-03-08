<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prêts - ESSEMLALI Bank</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme {
        --color-clifford: #da373d;
      }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
   <!-- Header -->
   <header class="bg-white text-blue-900 shadow-md">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="text-xl font-bold mb-4 md:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 150" class="w-30 h-auto" >
  <!-- Fond du logo -->
  <rect width="300" height="150" rx="20" fill="#ffffff"/>
  
  <!-- Symbole bancaire stylisé -->
  <g transform="translate(65, 30)">
    <!-- Piliers bancaires stylisés -->
    <rect x="0" y="30" width="20" height="60" rx="2" fill="#1d4ed8"/>
    <rect x="30" y="20" width="20" height="70" rx="2" fill="#1d4ed8"/>
    <rect x="60" y="10" width="20" height="80" rx="2" fill="#1d4ed8"/>
    <rect x="90" y="0" width="20" height="90" rx="2" fill="#1d4ed8"/>
    
    <!-- Toit bancaire arrondi -->
    <path d="M0,30 Q55,-10 110,0 L110,10 L0,10 Z" fill="#1d4ed8"/>
    
    <!-- Pièce/Monnaie symbolisant la finance -->
    <circle cx="140" cy="35" r="30" fill="#f59e0b"/>
    <circle cx="140" cy="35" r="25" fill="#fbbf24"/>
    <text x="140" y="42" font-family="Arial" font-size="24" font-weight="bold" text-anchor="middle" fill="#ffffff">€</text>
  </g>
  
  <!-- Nom de la banque -->
  <text x="150" y="140" font-family="Arial" font-size="22" font-weight="bold" text-anchor="middle" fill="#1d4ed8">EssemlaliBank</text>
</svg>

            </div>
            
            <nav class="flex flex-col md:flex-row items-center mb-4 md:mb-0">
                <a href="#" class="mb-2 md:mb-0 md:mr-6 hover:text-blue-300 transition-colors">Accueil</a>
                <a href="#" class="mb-2 md:mb-0 md:mr-6 hover:text-blue-300 transition-colors">Comptes</a>
                <a href="#" class="mb-2 md:mb-0 md:mr-6 hover:text-blue-300 transition-colors">Épargne</a>
                <a href="#" class="mb-2 md:mb-0 md:mr-6 hover:text-blue-300 transition-colors">Prêts</a>
                <a href="#" class="mb-2 md:mb-0 md:mr-6 hover:text-blue-300 transition-colors">Assurances</a>
                <a href="#" class="mb-2 md:mb-0 md:mr-6 hover:text-blue-300 transition-colors">À propos</a>
            </nav>
            
            <button class="bg-blue-400 hover:bg-blue-600 px-6 py-2 rounded-md font-semibold transition-colors">Se connecter</button>
        </div>
    </header>
    
    <main class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="mb-16">
            <div class="bg-blue-900 rounded-lg overflow-hidden shadow-xl">
                <div class="relative">
                    <img src="https://i.pinimg.com/736x/6a/19/5d/6a195d4d77131174bf91e5f77c48bf85.jpg" alt="Solutions de prêt" class="w-full opacity-50">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h1 class="text-4xl md:text-5xl font-bold text-white text-center px-4">Solutions de prêt adaptées à vos projets</h1>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Loan Types Section -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center">Nos offres de prêts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Prêt immobilier -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2 duration-300">
                    <div class="h-48 bg-blue-700 relative">
                        <img src="https://i.pinimg.com/736x/c5/77/08/c57708f57d6489ca763b16515a77ce1a.jpg" alt="Prêt immobilier" class="w-full h-full object-cover opacity-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-2xl font-bold text-white">Prêt immobilier</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Financez l'achat de votre résidence principale ou locative avec nos solutions adaptées à votre situation.</p>
                        <ul class="text-gray-700 mb-6">
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Taux à partir de 2,95%
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Durée jusqu'à 30 ans
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Financement jusqu'à 100%
                            </li>
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-900 font-semibold">À partir de 2,95% TAEG</span>
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">En savoir plus</a>
                        </div>
                    </div>
                </div>
                
                <!-- Prêt automobile -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2 duration-300">
                    <div class="h-48 bg-blue-700 relative">
                        <img src="https://i.pinimg.com/736x/55/8a/ba/558ababf6073f0e53a59a024003542ef.jpg" alt="Prêt automobile" class="w-full h-full object-cover opacity-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-2xl font-bold text-white">Prêt automobile</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Réalisez votre projet d'achat de véhicule neuf ou d'occasion avec nos offres avantageuses.</p>
                        <ul class="text-gray-700 mb-6">
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Taux à partir de 3,50%
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Durée de 12 à 84 mois
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Réponse sous 24h
                            </li>
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-900 font-semibold">À partir de 3,50% TAEG</span>
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">En savoir plus</a>
                        </div>
                    </div>
                </div>
                
                <!-- Prêt personnel -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2 duration-300">
                    <div class="h-48 bg-blue-700 relative">
                        <img src="https://i.pinimg.com/474x/e3/a5/8b/e3a58ba816641f6fd64b3af59db1fd9c.jpg" alt="Prêt personnel" class="w-full h-full object-cover opacity-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-2xl font-bold text-white">Prêt personnel</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Financez vos projets personnels : travaux, voyage, mariage ou tout autre besoin.</p>
                        <ul class="text-gray-700 mb-6">
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Taux à partir de 4,20%
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Montant de 1 000€ à 50 000€
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Sans frais de dossier
                            </li>
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-900 font-semibold">À partir de 4,20% TAEG</span>
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">En savoir plus</a>
                        </div>
                    </div>
                </div>
                
                <!-- Prêt étudiant -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2 duration-300">
                    <div class="h-48 bg-blue-700 relative">
                        <img src="https://i.pinimg.com/736x/77/92/6d/77926d0e9748f673c5e045dc426e2192.jpg" alt="Prêt étudiant" class="w-full h-full object-cover opacity-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-2xl font-bold text-white">Prêt étudiant</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Financez vos études supérieures avec des conditions adaptées à votre situation d'étudiant.</p>
                        <ul class="text-gray-700 mb-6">
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Taux préférentiel à 1,90%
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Différé de remboursement
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Jusqu'à 50 000€
                            </li>
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-900 font-semibold">À partir de 1,90% TAEG</span>
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">En savoir plus</a>
                        </div>
                    </div>
                </div>
                
                <!-- Prêt travaux -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2 duration-300">
                    <div class="h-48 bg-blue-700 relative">
                        <img src="https://i.pinimg.com/474x/23/e0/7d/23e07d3ed060eac4d260651c1be4e56d.jpg" alt="Prêt travaux" class="w-full h-full object-cover opacity-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-2xl font-bold text-white">Prêt travaux</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Financez vos projets de rénovation, d'amélioration ou d'agrandissement de votre habitation.</p>
                        <ul class="text-gray-700 mb-6">
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Taux à partir de 3,25%
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Durée jusqu'à 15 ans
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Options éco-responsables
                            </li>
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-900 font-semibold">À partir de 3,25% TAEG</span>
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">En savoir plus</a>
                        </div>
                    </div>
                </div>
                
                <!-- Prêt professionnel -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2 duration-300">
                    <div class="h-48 bg-blue-700 relative">
                        <img src="https://i.pinimg.com/736x/ba/3e/ce/ba3ece929ab9a97089c09d95a8e0e8e9.jpg" alt="Prêt professionnel" class="w-full h-full object-cover opacity-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-2xl font-bold text-white">Prêt professionnel</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Développez votre activité professionnelle ou lancez votre entreprise avec nos solutions dédiées.</p>
                        <ul class="text-gray-700 mb-6">
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Taux négociables
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Solutions personnalisées
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Accompagnement dédié
                            </li>
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-900 font-semibold">Taux sur mesure</span>
                            <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Process Section -->
               <!-- Process Section -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-16">
            <h2 class="text-2xl font-bold text-blue-900 mb-8">Notre processus simplifié</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">1. Demande en ligne</h3>
                    <p class="text-gray-600">Formulaire simplifié en 5 minutes</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">2. Étude de dossier</h3>
                    <p class="text-gray-600">Réponse de principe sous 48h</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">3. Signature électronique</h3>
                    <p class="text-gray-600">Contractualisation sécurisée</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">4. Délivrance des fonds</h3>
                    <p class="text-gray-600">Virement immédiat après accord</p>
                </div>
            </div>
        </section>

          <!-- Footer -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">ESSEMLALI Bank</h4>
                    <p class="text-blue-100">Votre partenaire financier de confiance depuis 2009. Nous offrons des services bancaires innovants et personnalisés pour répondre à tous vos besoins financiers.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">Tarifs</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">Sécurité</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">Carrières</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul>
                        <li class="mb-2 text-blue-100">+33 1 23 45 67 89</li>
                        <li class="mb-2 text-blue-100">contact@essemlalibank.com</li>
                        <li class="mb-2 text-blue-100">123 Avenue des Finances, Paris</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Suivez-nous</h4>
                    <ul>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">Facebook</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">Twitter</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">LinkedIn</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-100 hover:text-white transition-colors">Instagram</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-800 pt-6 text-center text-blue-200 text-sm">
                <p>&copy; 2025 ESSEMLALI Bank. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    </main>
</body>
</html>