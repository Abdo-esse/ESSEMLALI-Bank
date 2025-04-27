let originalClients = [];
const loadInitialClients = async () => {
    try {
        await fetchAllClients();
        displayClients(originalClients);
    } catch (error) {
        displayError("Impossible de charger les clients. Veuillez rafraîchir la page.");
    }
}

const fetchAllClients = async () => {
    const req = await fetch('http://localhost/ESSEMLALI-Bank/all-clients');
    if (!req.ok) {
        throw new Error(`Erreur HTTP : ${req.status}`);
    }
    originalClients = await req.json();
}


const searchClient = async () => {
    let keyword = document.querySelector('#keyword').value;
    if (!keyword) {
        displayClients(originalClients);
        return;
    }

    try {
        const req = await fetch(`http://localhost/ESSEMLALI-Bank/search-clien?keyword=${encodeURIComponent(keyword)}`);

        if (!req.ok) {
            throw new Error(`Erreur HTTP : ${req.status}`);
        }

        const response = await req.json();
        console.log(response);
        displayClients(response);

    } catch (error) {
        console.log("Une erreur s'est produite lors de la recherche :", error.message);
        displayError(error.message);
    }
}

const displayClients = (clients) => {
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
                    <div class="flex space-x-2">
                        <form method="post" action="client/${client.id}" >
                            <button type="submit" class="px-3 py-1.5 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                voir
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

document.addEventListener('DOMContentLoaded', loadInitialClients);


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