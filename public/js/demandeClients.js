let originalDemandeClients = [];
const loadInitialDemandeClients = async () => {
    try {
        await fetchAllDemandeClients();
        displayDemandeClients(originalDemandeClients);
    } catch (error) {
        displayError("Impossible de charger les clients. Veuillez rafraîchir la page.");
    }
}

const fetchAllDemandeClients = async () => {
    const req = await fetch('http://localhost/ESSEMLALI-Bank/all-demande-clients');
    if (!req.ok) {
        throw new Error(`Erreur HTTP : ${req.status}`);
    }
    originalDemandeClients = await req.json();
}


const searchDemandeClient = async () => {
    let keyword = document.querySelector('#keyword').value;
    if (!keyword) {
        displayDemandeClients(originalDemandeClients);
        return;
    }

    try {
        const req = await fetch(`http://localhost/ESSEMLALI-Bank/search-demande-clien?keyword=${encodeURIComponent(keyword)}`);

        if (!req.ok) {
            throw new Error(`Erreur HTTP : ${req.status}`);
        }

        const response = await req.json();
        displayDemandeClients(response);

    } catch (error) {
        displayError(error.message);
    }
}

const displayDemandeClients = (clients) => {
    const tableBody = document.querySelector('table tbody');

    tableBody.innerHTML = '';

    if (clients.length === 0) {
        tableBody.innerHTML = `
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="5" class="px-6 py-4 text-center">
                    Aucun client trouvé pour cette recherche.
                </td>
            </tr>
        `;
    } else {
        clients.forEach(client => {
            const row = document.createElement('tr');
            row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';

            row.innerHTML = `
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    ${client.nom || ''}
                </td>
                <td class="px-6 py-4">
                    ${client.prenom || ''}
                </td>
                <td class="px-6 py-4">
                    ${client.email || ''}
                </td>
                <td class="px-6 py-4">
                    ${formateDate(client.dateCreation)}
                </td>
               <td class="px-6 py-4">
                    ${
                client.isActive
                    ? '<span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">Actif</span>'
                    : '<span class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Inactif</span>'
            }
                </td>
                <td class="px-6 py-4">
                    <div class="flex space-x-2">
                        <a href="voir/${client.id}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <button type="button" class="px-3 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Voir
                            </button>
                        </a>                    
                        
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

document.addEventListener('DOMContentLoaded', loadInitialDemandeClients);


function formateDate(dateCreation) {
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