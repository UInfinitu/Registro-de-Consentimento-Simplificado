const consentimentos = document.getElementById('seusConsentimentos');
const historico = document.getElementById('historico');

window.addEventListener('load', () => {
    consentimentos.classList.add('ativo');
});

historico.addEventListener('click', () => {
    consentimentos.classList.remove('ativo');
    historico.classList.add('ativo');
    document.getElementsByClassName('gradiente')[0].classList.add('mudar-gradiente');
});

consentimentos.addEventListener('click', () => {
    consentimentos.classList.add('ativo');
    historico.classList.remove('ativo');
    document.getElementsByClassName('gradiente')[0].classList.remove('mudar-gradiente');
});


// Alterar visualização de senha
document.getElementById('visualizarSenha').addEventListener('click', (event) => {
    event.preventDefault();

    const senha = document.getElementById('inputSenhaAlteracao');
    const tipoAtual = senha.getAttribute('type');
    senha.setAttribute('type', tipoAtual === 'password' ? 'text' : 'password');
    document.getElementById('imgVisualizarSenha').setAttribute('src', tipoAtual === 'password' ? '../assets/senha-visivel.webp' : '../assets/senha-oculta.webp');
});


// Permitir alteração dos dados
const alteracao = document.getElementsByClassName('editarUsuario');
for (let i = 0; i < alteracao.length; i++) {
    alteracao[i].addEventListener('click', () => {
        let campo = document.getElementsByClassName('form-control')[i];
        campo.classList.toggle('alteracaoBloqueada');
        if (!campo.classList.contains('alteracaoBloqueada')) {
            campo.removeAttribute('readonly');
        } else {
            campo.setAttribute('readonly', 'true');
        }
    });
}

document.querySelectorAll('.filtros').forEach(button => {
    button.addEventListener('click', () => {
        const order = button.getAttribute('data-order');

        window.location.href = 'filtragemConsentimentos.php?order=' + order;
    });
});