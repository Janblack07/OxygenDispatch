function initDispatchClientLookup() {
    const docInput = document.getElementById('client_document_lookup');
    const nameInput = document.getElementById('client_name_display');
    const clientIdHidden = document.getElementById('client_id_hidden');
    const errorBox = document.getElementById('client_lookup_error');

    if (!docInput || !nameInput || !clientIdHidden || !errorBox) {
        return;
    }

    const lookupUrl = docInput.dataset.lookupUrl;

    if (!lookupUrl) {
        console.error('No se encontró data-lookup-url en client_document_lookup');
        return;
    }

    let timeout = null;

    const resetClient = () => {
        nameInput.value = '';
        clientIdHidden.value = '';
        errorBox.classList.add('hidden');
    };

    const searchClient = async (documentValue) => {
        const value = (documentValue || '').trim();

        if (!value) {
            resetClient();
            return;
        }

        try {
            const response = await fetch(`${lookupUrl}?document=${encodeURIComponent(value)}`, {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                resetClient();
                errorBox.classList.remove('hidden');
                return;
            }

            const data = await response.json();

            if (data.found && data.client) {
                nameInput.value = data.client.name;
                clientIdHidden.value = data.client.id;
                errorBox.classList.add('hidden');
            } else {
                resetClient();
                errorBox.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error buscando cliente por documento:', error);
            resetClient();
            errorBox.classList.remove('hidden');
        }
    };

    docInput.addEventListener('input', () => {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            searchClient(docInput.value);
        }, 400);
    });

    docInput.addEventListener('blur', () => {
        searchClient(docInput.value);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDispatchClientLookup);
} else {
    initDispatchClientLookup();
}
