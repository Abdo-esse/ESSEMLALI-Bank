let originalEmployes = [];
const loadInitialEmployes = async () => {
    try {
        await fetchAllEmployes();
        displayEmployes(originalEmployes);
    } catch (error) {
        displayError("Impossible de charger les employes. Veuillez rafraîchir la page.");
    }
}

const fetchAllEmployes = async () => {
    const req = await fetch('http://localhost/ESSEMLALI-Bank/all-employes');
    if (!req.ok) {
        throw new Error(`Erreur HTTP : ${req.status}`);
    }
    originalEmployes = await req.json();
}


const searchEmployes = async () => {
    let keyword = document.querySelector('#keyword').value;
    if (!keyword) {
        displayEmployes(originalEmployes);
        return;
    }
    
    try {
        const req = await fetch(`http://localhost/ESSEMLALI-Bank/search-clien?keyword=${encodeURIComponent(keyword)}`);
        
        if (!req.ok) {
            throw new Error(`Erreur HTTP : ${req.status}`);
        }
        
        const response = await req.json();
        console.log(response);
        displayEmployes(response);
        
    } catch (error) {
        console.log("Une erreur s'est produite lors de la recherche :", error.message);
        displayError(error.message);
    }
}

const displayEmployes = (employes) => {
    const tableBody = document.querySelector('table tbody');
    
    tableBody.innerHTML = '';
    
    if (employes.length === 0) {
        tableBody.innerHTML = `
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="5" class="px-6 py-4 text-center">
                    Aucun client trouvé pour cette recherche.
                </td>
            </tr>
        `;
    } else {
        employes.forEach(employe => {            
            const row = document.createElement('tr');
            row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
            
            row.innerHTML = `
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                ${employe.nom || ''}
            </td>
            <td class="px-6 py-4">
                ${employe.prenom || ''}
            </td>
            <td class="px-6 py-4">
                ${employe.email || ''}
            </td>
            <td class="px-6 py-4">
                ${formateDate(employe.dateCreation)}
            </td>
            <td class="px-6 py-4">
                ${employe.isActive
                    ? '<span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">Actif</span>'
                    : '<span class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Inactif</span>'
                }
            </td>
            <td class="px-6 py-4">
                <div class="flex space-x-2">
                    <a href="editeEploye/${employe.id}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <button type="button" class="px-3 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Modifier
                        </button>
                    </a>
                    
                    <form method="post" action="${employe.isActive ? 'desactiver' : 'activer'}/${employe.id}" onsubmit="return confirm('Voulez-vous vraiment ${employe.isActive ? 'désactiver' : 'activer'} cet employé?');">
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-center text-white rounded-lg ${employe.isActive ? 'bg-red-600 hover:bg-red-700 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800' : 'bg-green-600 hover:bg-green-700 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'}">
                            ${employe.isActive ? 'Désactiver' : 'Activer'}
                        </button>
                    </form>
        
                    <form method="post" action="delete/${employe.id}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet employé?');">
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-center text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Supprimer
                        </button>
                    </form>
                </div>
            </td>
        `;
        
            
            tableBody.appendChild(row);
        });
    }
}

const displayError = (errorMessage) => {
    const tableBody = document.querySelector('table tbody');
    tableBody.innerHTML = `
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td colspan="5" class="px-6 py-4 text-center text-red-500">
                Une erreur s'est produite lors de la recherche : ${errorMessage}
            </td>
        </tr>
    `;
}

document.addEventListener('DOMContentLoaded', loadInitialEmployes);


function formateDate(dateCreation){
    const rawDate = dateCreation;
let formattedDate = 'N/A';

if (rawDate) {
    const date = new Date(rawDate);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    formattedDate = `${year}-${month}-${day} à ${hours}:${minutes}`;
}
return formattedDate
}