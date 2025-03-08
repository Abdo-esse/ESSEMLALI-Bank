<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESSEMLALI Bank - Votre banque en ligne</title>
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
        <section class="flex flex-col md:flex-row items-center mb-16">
            <div class="md:w-1/2 md:pr-8 mb-8 md:mb-0">
                <h1 class="text-4xl font-bold text-blue-900 mb-4">Votre avenir financier commence ici</h1>
                <p class="text-lg text-gray-600 mb-8">ESSEMLALI Bank vous offre des solutions bancaires innovantes, accessibles et sécurisées. Gérez votre argent en toute simplicité depuis n'importe où et n'importe quand.</p>
                <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-md font-semibold transition-colors">Ouvrir un compte</button>
            </div>
            
            <div class="md:w-1/2">
                <img src="https://i.pinimg.com/736x/56/d8/ec/56d8ec2ee5a0eaed9659008529b375bb.jpg" alt="Services bancaires en ligne" class="rounded-lg shadow-xl w-full">
            </div>
        </section>
        
        <!-- Features Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white rounded-lg p-8 shadow-md transition-transform hover:-translate-y-2 duration-300">
                <div class="text-4xl mb-4 text-blue-400">💳</div>
                <h3 class="text-xl font-semibold text-blue-900 mb-3">Paiements sécurisés</h3>
                <p class="text-gray-600">Effectuez vos paiements en ligne et en magasin en toute sécurité grâce à notre technologie de pointe.</p>
            </div>
            
            <div class="bg-white rounded-lg p-8 shadow-md transition-transform hover:-translate-y-2 duration-300">
                <div class="text-4xl mb-4 text-blue-400">📱</div>
                <h3 class="text-xl font-semibold text-blue-900 mb-3">Banque mobile</h3>
                <p class="text-gray-600">Accédez à vos comptes, réalisez des virements et consultez vos transactions depuis votre smartphone.</p>
            </div>
            
            <div class="bg-white rounded-lg p-8 shadow-md transition-transform hover:-translate-y-2 duration-300">
                <div class="text-4xl mb-4 text-blue-400">💰</div>
                <h3 class="text-xl font-semibold text-blue-900 mb-3">Épargne intelligente</h3>
                <p class="text-gray-600">Nos solutions d'épargne personnalisées vous aident à atteindre vos objectifs financiers plus rapidement.</p>
            </div>
        </section>
        
        <!-- Stats Section -->
        <section class="bg-blue-900 text-white rounded-lg p-8 mb-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <h4 class="text-3xl font-bold mb-2">98%</h4>
                    <p class="text-blue-100">Clients satisfaits</p>
                </div>
                
                <div>
                    <h4 class="text-3xl font-bold mb-2">500K+</h4>
                    <p class="text-blue-100">Utilisateurs actifs</p>
                </div>
                
                <div>
                    <h4 class="text-3xl font-bold mb-2">24/7</h4>
                    <p class="text-blue-100">Assistance client</p>
                </div>
                
                <div>
                    <h4 class="text-3xl font-bold mb-2">15+</h4>
                    <p class="text-blue-100">Années d'expérience</p>
                </div>
            </div>
        </section>
    </main>
    
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
</body>
</html>
