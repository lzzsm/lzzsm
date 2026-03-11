// JavaScript para formulários de autenticação

document.addEventListener('DOMContentLoaded', function () {
    // Validação de confirmação de senha
    const passwordField = document.getElementById('password');
    const passwordConfirmField = document.getElementById('password_confirmation');

    // Verifica se o campo de confirmação de senha existe
    if (passwordConfirmField) {
        // Adiciona validação quando o campo perde o foco
        passwordConfirmField.addEventListener('blur', function () {
            if (passwordField && this.value !== passwordField.value) {
                showFieldError(this, 'Senhas não coincidem');
            } else {
                clearFieldError(this);
            }
        });
    }

    // Função para mostrar erro em um campo
    function showFieldError(field, message) {
        // Limpa erros anteriores do campo
        clearFieldError(field);

        // Cria elemento de erro
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error text-red-500 text-sm mt-1';
        errorDiv.textContent = message;

        // Adiciona o erro abaixo do campo
        field.parentNode.appendChild(errorDiv);
        field.classList.add('border-red-500');
    }

    // Função para limpar erro de um campo
    function clearFieldError(field) {
        // Remove elemento de erro existente
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
        // Remove classe de borda vermelha
        field.classList.remove('border-red-500');
    }

    // Validação de formulário no envio
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            // Valida campos obrigatórios
            const requiredFields = this.querySelectorAll('input[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    showFieldError(field, 'Este campo é obrigatório');
                    isValid = false;
                }
            });

            // Validação de termos e condições
            const termsCheckbox = this.querySelector('input[name="terms"]');
            if (termsCheckbox && !termsCheckbox.checked) {
                alert('Você deve aceitar os termos e condições');
                isValid = false;
            }

            // Validação final de CPF no submit
            if (cpfField && !validarCPF(cpfField.value)) {
                showFieldError(cpfField, 'CPF inválido');
                isValid = false;
            }

            // Impede envio se houver erros
            if (!isValid) {
                e.preventDefault();
            }
        });
    });

    // Lógica do dropdown de tipos
    const dropdown = document.getElementById('tipo-dropdown');
    if (!dropdown) return;

    const dropdownButton = dropdown.querySelector('button');
    const dropdownLabel = document.getElementById('tipo-dropdown-label');
    const dropdownOptions = document.getElementById('tipo-dropdown-options');
    const hiddenInput = document.getElementById('tipo-hidden-input');

    // Função para abrir o dropdown com animação
    const openDropdown = () => {
        dropdownOptions.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
        dropdownButton.setAttribute('aria-expanded', 'true');
    };

    // Função para fechar o dropdown com animação
    const closeDropdown = () => {
        dropdownOptions.classList.add('opacity-0', 'scale-95');
        // Atraso para remover eventos de ponteiro após animação
        setTimeout(() => {
            dropdownOptions.classList.add('pointer-events-none');
        }, 200); // Mesmo tempo da duration-200
        dropdownButton.setAttribute('aria-expanded', 'false');
    };

    // Abrir/fechar dropdown ao clicar no botão
    dropdownButton.addEventListener('click', (event) => {
        event.stopPropagation(); // Impede fechamento imediato
        const isExpanded = dropdownButton.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', function () {
        if (dropdownButton.getAttribute('aria-expanded') === 'true') {
            closeDropdown();
        }
    });

    // Lógica para selecionar opção do dropdown
    dropdownOptions.querySelectorAll('li').forEach(option => {
        option.addEventListener('click', function () {
            // Obtém valor selecionado
            const selectedValue = this.getAttribute('data-value');
            dropdownLabel.textContent = selectedValue;
            hiddenInput.value = selectedValue;

            // Remove indicadores de seleção anteriores
            dropdownOptions.querySelectorAll('li span.text-lime-400').forEach(check => {
                check.classList.add('hidden');
            });
            // Adiciona indicador de seleção na opção atual
            this.querySelector('span.text-lime-400').classList.remove('hidden');

            // Fecha dropdown após seleção
            closeDropdown();
        });
    });

    // Pré-seleciona valor antigo se existir
    const oldValue = hiddenInput.value;
    if (oldValue) {
        const selectedOption = dropdownOptions.querySelector(`li[data-value="${oldValue}"]`);
        if (selectedOption) {
            dropdownLabel.textContent = oldValue;
            selectedOption.querySelector('span.text-lime-400').classList.remove('hidden');
        }
    }
});