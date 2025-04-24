const cabecalhos = document.getElementById('cabecalhos');
const corpoDados = document.getElementById('corpoDados');
const adicionar = document.getElementById('adicionar');

// Quando a página carregar
window.addEventListener('load', () => {
    document.getElementsByClassName('nav-item')[0].click()
});


// Quando clicar em "Clientes"
document.getElementsByClassName('nav-item')[0].addEventListener('click', async (event) => {
    event.preventDefault();
    //Limpando conteúdos anteriores
    cabecalhos.innerHTML = '';
    corpoDados.innerHTML = '';
    adicionar.innerHTML = '';

    // Mudando estilo do link
    const linkAtivo = document.getElementsByClassName('active')[0];
    linkAtivo.classList.remove('active');

    const novoLinkAtivo = document.getElementById('clientes');
    novoLinkAtivo.classList.add('active');

    // Barra para adicionar novo cliente
    adicionar.innerHTML = `
        <form method="POST" action="adicionarUsuario.php" id="adicionarUsuario" class="row col-8 mx-auto justify-content-evenly align-items-center mb-5 p-2 d-flex">

            <img id="iconeUsuario" class="col-auto" src="../assets/user.png" alt="Icone de usuário"
                style="max-width: 50px;">

            <div class="input-group col">
                <input type="text" class="form-control fs-5" name="nome" id="inputNome" placeholder="Nome" required>
            </div>

            <div class="input-group col">
                <input type="email" class="form-control fs-5" name="email" id="inputEmail" placeholder="Email" required>
            </div>

            <div class="input-group col">
                <input type="password" class="form-control fs-5" name="senha" id="inputSenha" placeholder="Senha" required>
                <a href="#" id="visualizarSenha" class="input-group-text">
                    <img id="imgVisualizarSenha" src="../assets/senha-oculta.webp"
                        alt="Simbolo para mostrar que a senha está oculta">
                </a>
            </div>

            <button id="btnAdicionarUsuario" class="col-2 btn btn-primary">Adicionar</button>

        </form>`;

    document.getElementById('visualizarSenha').addEventListener('click', (event) => {
        event.preventDefault();

        const senha = document.getElementById('inputSenha');
        const tipoAtual = senha.getAttribute('type');
        senha.setAttribute('type', tipoAtual === 'password' ? 'text' : 'password');
        document.getElementById('imgVisualizarSenha').setAttribute('src', tipoAtual === 'password' ? '../assets/senha-visivel.webp' : '../assets/senha-oculta.webp');
    });

    // Listagem de fato
    const clientes = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/clientes/listar.php");
    const listaClientes = await clientes.json();

    let idCabecalho = document.createElement('th');
    idCabecalho.className = 'w-20';
    idCabecalho.innerHTML = 'ID';

    let nomeCabecalho = document.createElement('th');
    nomeCabecalho.className = 'w-20';
    nomeCabecalho.innerHTML = 'Nome';

    let emailCabecalho = document.createElement('th');
    emailCabecalho.className = 'w-20';
    emailCabecalho.innerHTML = 'Email';

    let senhaCabecalho = document.createElement('th');
    senhaCabecalho.className = 'w-20';
    senhaCabecalho.innerHTML = 'Senha';

    let consentimentosCabecalho = document.createElement('th');
    consentimentosCabecalho.className = 'w-20';
    consentimentosCabecalho.innerHTML = 'Quantidade de Consentimentos';

    cabecalhos.appendChild(idCabecalho);
    cabecalhos.appendChild(nomeCabecalho);
    cabecalhos.appendChild(emailCabecalho);
    cabecalhos.appendChild(senhaCabecalho);
    cabecalhos.appendChild(consentimentosCabecalho);

    listaClientes.forEach((dado) => {
        let tr = document.createElement('tr');

        let id = document.createElement('td');
        id.innerHTML = dado.idUsuario;

        let nome = document.createElement('td');
        nome.innerHTML = dado.nomeUsuario;

        let email = document.createElement('td');
        email.innerHTML = dado.emailUsuario;

        let senha = document.createElement('td');
        let senhaSpan = document.createElement('span');
        senhaSpan.textContent = '•'.repeat(8); // Oculta a senha (padrão 8 characteres por segurança pra não pegar o tamanho real da senha)
        senha.appendChild(senhaSpan);

        let visualizaSenha = document.createElement('a');
        visualizaSenha.style.marginLeft = '5px';
        visualizaSenha.style.cursor = 'pointer';

        let senhaVisivel = document.createElement('img');
        senhaVisivel.style.width = '1.5em';
        senhaVisivel.src = '../assets/senha-visivel.webp';

        let senhaOculta = document.createElement('img');
        senhaOculta.style.width = '1.5em';
        senhaOculta.src = '../assets/senha-oculta.webp';

        visualizaSenha.appendChild(senhaOculta);

        visualizaSenha.addEventListener('click', () => {
            if (senhaSpan.textContent === '•'.repeat(8)) {
                senhaSpan.textContent = dado.senhaUsuario;
                visualizaSenha.removeChild(senhaOculta);
                visualizaSenha.appendChild(senhaVisivel);
            } else {
                senhaSpan.textContent = '•'.repeat(8);
                visualizaSenha.removeChild(senhaVisivel);
                visualizaSenha.appendChild(senhaOculta);
            }
        });

        senha.appendChild(visualizaSenha);

        let qtdConsentimentos = document.createElement('td');
        qtdConsentimentos.innerHTML = dado.qtdConsentimentos;

        tr.appendChild(id);
        tr.appendChild(nome);
        tr.appendChild(email);
        tr.appendChild(senha);
        tr.appendChild(qtdConsentimentos);

        corpoDados.appendChild(tr);
    });
});


// Quando clicar em "Finalidades"
document.getElementsByClassName('nav-item')[1].addEventListener('click', async (event) => {
    event.preventDefault();
    //Limpando conteúdos anteriores
    cabecalhos.innerHTML = '';
    corpoDados.innerHTML = '';
    adicionar.innerHTML = '';

    // Mudando estilo do link
    const linkAtivo = document.getElementsByClassName('active')[0];
    linkAtivo.classList.remove('active');

    const novoLinkAtivo = document.getElementById('finalidades');
    novoLinkAtivo.classList.add('active');

    // Barra para adicionar nova finalidade
    adicionar.innerHTML = `
        <form method="POST" action="adicionarFinalidade.php" id="adicionarFinalidade" class="row col-8 mx-auto justify-content-evenly align-items-center mb-5 p-2 d-flex">
            <div class="input-group w-25">
                <input type="text" class="form-control fs-5" name="nome" id="inputNome" placeholder="Nome" required>
            </div>

            <div class="input-group w-50"> 
                <textarea class="form-control fs-5" name="desc" id="inputDesc" placeholder="Descrição" 
                          style="resize: none; overflow-y: hidden; white-space: nowrap;" 
                          rows="1" required></textarea>
            </div>

            <button id="btnAdicionarUsuario" class="col-2 btn btn-primary">Adicionar</button>
        </form>`;

    // Listagem de fato
    const finalidades = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/listar.php");
    const listaFinalidades = await finalidades.json();

    let idCabecalho = document.createElement('th');
    idCabecalho.className = 'w-25';
    idCabecalho.innerHTML = 'ID';

    let nomeCabecalho = document.createElement('th');
    nomeCabecalho.className = 'w-25';
    nomeCabecalho.innerHTML = 'Nome';

    let descCabecalho = document.createElement('th');
    descCabecalho.className = 'w-25';
    descCabecalho.innerHTML = 'Descrição';

    let consentimentosCabecalho = document.createElement('th');
    consentimentosCabecalho.className = 'w-25';
    consentimentosCabecalho.innerHTML = 'Quantidade de Consentimentos';

    cabecalhos.appendChild(idCabecalho);
    cabecalhos.appendChild(nomeCabecalho);
    cabecalhos.appendChild(descCabecalho);
    cabecalhos.appendChild(consentimentosCabecalho);

    listaFinalidades.forEach((dado) => {
        let tr = document.createElement('tr');

        let id = document.createElement('td');
        id.innerHTML = dado.idFinalidade;

        let nome = document.createElement('td');
        nome.innerHTML = dado.nomeFinalidade;

        let descricao = document.createElement('td');
        descricao.innerHTML = dado.descFinalidade;

        let qtdConsentimentos = document.createElement('td');
        qtdConsentimentos.innerHTML = dado.qtdConsentimentos;

        tr.appendChild(id);
        tr.appendChild(nome);
        tr.appendChild(descricao);
        tr.appendChild(qtdConsentimentos);

        corpoDados.appendChild(tr);
    })
});


// Quando clicar em Consentimentos
document.getElementsByClassName('nav-item')[2].addEventListener('click', async (event) => {
    event.preventDefault();
    //Limpando conteúdos anteriores
    cabecalhos.innerHTML = '';
    corpoDados.innerHTML = '';
    adicionar.innerHTML = '';

    // Mudando estilo do link
    const linkAtivo = document.getElementsByClassName('active')[0];
    linkAtivo.classList.remove('active');

    const novoLinkAtivo = document.getElementById('consentimentos');
    novoLinkAtivo.classList.add('active');

    // Listagem de fato
    const consentimentos = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?ordem=c.dataConcessao");
    const listaConsentimentos = await consentimentos.json();

    let usuarioCabecalho = document.createElement('th');
    usuarioCabecalho.className = 'w-25';
    usuarioCabecalho.innerHTML = 'Usuário';

    let finalidadeCabecalho = document.createElement('th');
    finalidadeCabecalho.className = 'w-25';
    finalidadeCabecalho.innerHTML = 'Finalidade';

    let descCabecalho = document.createElement('th');
    descCabecalho.className = 'w-25';
    descCabecalho.innerHTML = 'Descrição Finalidade';

    let dataCabecalho = document.createElement('th');
    dataCabecalho.className = 'w-25';
    dataCabecalho.innerHTML = 'Data de Concessão';

    cabecalhos.appendChild(usuarioCabecalho);
    cabecalhos.appendChild(finalidadeCabecalho);
    cabecalhos.appendChild(descCabecalho);
    cabecalhos.appendChild(dataCabecalho);

    listaConsentimentos.forEach((dado) => {
        let tr = document.createElement('tr');

        let usuario = document.createElement('td');
        usuario.innerHTML = dado.nomeUsuario;

        let finalidade = document.createElement('td');
        finalidade.innerHTML = dado.nomeFinalidade;

        let descricao = document.createElement('td');
        descricao.innerHTML = dado.descFinalidade;

        let data = document.createElement('td');
        data.innerHTML = dado.dataConcessao;

        tr.appendChild(usuario);
        tr.appendChild(finalidade);
        tr.appendChild(descricao);
        tr.appendChild(data);

        corpoDados.appendChild(tr);
    })
});