function toggleNovaInstituicao(value) {
    const novaInstituicaoInput = document.getElementById('nova_instituicao');
    if (value === 'nova') {
        novaInstituicaoInput.style.display = 'block';
        novaInstituicaoInput.required = true; // Torna o campo obrigatório
    } else {
        novaInstituicaoInput.style.display = 'none';
        novaInstituicaoInput.value = ''; // Limpa o campo
        novaInstituicaoInput.required = false; // Remove a obrigatoriedade
    }
}

function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
}

function validateAge() {
    const dataNascimento = document.getElementById('data_nascimento').value;
    const nascimento = new Date(dataNascimento);
    const hoje = new Date();
    const idade = hoje.getFullYear() - nascimento.getFullYear();
    const mes = hoje.getMonth() - nascimento.getMonth();
    
    if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
        idade--;
    }
    
    if (idade < 18) {
        alert("Você deve ter mais de 18 anos para se cadastrar.");
        return false; // Impede o envio do formulário
    }
    return true; // Permite o envio do formulário
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocalização não é suportada por este navegador.");
    }
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const long = position.coords.longitude;

    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${long}&format=json`)
        .then(response => response.json())
        .then(data => {
            const cidadeInput = document.getElementById('cidade');
            if (data && data.address && data.address.city) {
                cidadeInput.value = data.address.city; // Preenche o campo com o nome da cidade
            } else {
                alert("Cidade não encontrada.");
            }
        })
        .catch(() => {
            alert("Erro ao obter a localização.");
        });
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Usuário rejeitou a solicitação de Geolocalização.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Posição não disponível.");
            break;
        case error.TIMEOUT:
            alert("A requisição para obter a localização expirou.");
            break;
        case error.UNKNOWN_ERROR:
            alert("Um erro desconhecido ocorreu.");
            break;
    }
}

function showTerms() {
    const modal = document.getElementById('termosModal');
    modal.style.display = 'block';
    gsap.fromTo(modal, { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.5 });
}

function closeTerms() {
    const modal = document.getElementById('termosModal');
    gsap.to(modal, { scale: 0, opacity: 0, duration: 0.5, onComplete: () => {
        modal.style.display = 'none';
    }});
}

// Animação de entrada ao carregar a página
gsap.to('.container', { 
    opacity: 1, 
    y: 0, 
    duration: 1, 
    ease: 'power2.out' 
});

// Animações em botões ao passar o mouse
const button = document.querySelector('button');
button.addEventListener('mouseenter', () => {
    gsap.to(button, { 
        scale: 1.1, 
        duration: 0.2 
    });
});

button.addEventListener('mouseleave', () => {
    gsap.to(button, { 
        scale: 1, 
        duration: 0.2 
    });
});
