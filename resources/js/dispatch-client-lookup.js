function initDispatchClientLookup() {
    const docInput = document.getElementById('client_document_lookup');
    const validateBtn = document.getElementById('btn_validate_client');
    const nameInput = document.getElementById('client_name_display');
    const clientIdHidden = document.getElementById('client_id_hidden');
    const okBox = document.getElementById('client_lookup_ok');
    const errorBox = document.getElementById('client_lookup_error');

    if (!docInput || !validateBtn || !nameInput || !clientIdHidden || !okBox || !errorBox) {
        return;
    }

    const lookupUrl = docInput.dataset.lookupUrl;

    if (!lookupUrl) {
        console.error('No se encontró data-lookup-url en client_document_lookup');
        return;
    }

    const resetClient = () => {
        nameInput.value = '';
        clientIdHidden.value = '';
        okBox.textContent = '';
        okBox.classList.add('hidden');
        errorBox.classList.add('hidden');
    };

    const showError = () => {
        nameInput.value = '';
        clientIdHidden.value = '';
        okBox.textContent = '';
        okBox.classList.add('hidden');
        errorBox.classList.remove('hidden');
    };

    const showSuccess = (client) => {
        nameInput.value = client.name;
        clientIdHidden.value = client.id;
        okBox.textContent = `Cliente encontrado: ${client.name} (${client.document})`;
        okBox.classList.remove('hidden');
        errorBox.classList.add('hidden');
    };

    const searchClient = async () => {
        const value = (docInput.value || '').trim();

        if (!value) {
            resetClient();
            return;
        }

        validateBtn.disabled = true;
        validateBtn.textContent = 'Validando...';

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
                showError();
                return;
            }

            const data = await response.json();

            if (data.found && data.client) {
                showSuccess(data.client);
            } else {
                showError();
            }
        } catch (error) {
            console.error('Error buscando cliente por documento:', error);
            showError();
        } finally {
            validateBtn.disabled = false;
            validateBtn.textContent = 'Validar';
        }
    };

    validateBtn.addEventListener('click', searchClient);

    docInput.addEventListener('input', () => {
        nameInput.value = '';
        clientIdHidden.value = '';
        okBox.textContent = '';
        okBox.classList.add('hidden');
        errorBox.classList.add('hidden');
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDispatchClientLookup);
} else {
    initDispatchClientLookup();
}
