document.getElementById('visualizarSenha').addEventListener('click', (event) => {
    event.preventDefault();

    const senha = document.getElementById('inputSenhaLogin');
    const tipoAtual = senha.getAttribute('type');
    senha.setAttribute('type', tipoAtual === 'password' ? 'text' : 'password');
    document.getElementById('imgVisualizarSenha').setAttribute('src', tipoAtual === 'password' ? '../assets/senha-visivel.webp' : '../assets/senha-oculta.webp');
});