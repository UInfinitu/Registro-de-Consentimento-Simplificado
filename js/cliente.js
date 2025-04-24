const consentimentos = document.getElementById('seusConsentimentos');
const historico = document.getElementById('historico');
const id = document.getElementById('idUsuario').value;

let listaAdicionarConsentimentos = [];

// Execuções quando o site terminar de carregar
window.addEventListener('load', async () => {
    consentimentos.classList.add('ativo');

    listarConsentimentos("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=f.nomeFinalidade");

    // Listar no modal
    listarFinalidades();
});


// Mudar a barra de navegação quando clica nos links
historico.addEventListener('click', () => {
    consentimentos.classList.remove('ativo');
    historico.classList.add('ativo');
    document.getElementsByClassName('gradiente')[0].classList.add('mudar-gradiente');

    document.getElementById('conteudo').innerHTML = `
        <div class="table-responsive">
            <table class="table w-100 mb-0 table-striped">
                <thead>
                    <tr>
                        <th class="w-50">Finalidade</th>
                        <th class="w-50">Data da concessão</th>
                    </tr>
                </thead>
                <tbody id="corpoHistorico">
                    <!-- Seu conteúdo aqui -->
                </tbody>
            </table>
        </div>
    `;
    preencherHistorico();
});

async function preencherHistorico() {
    const corpoHistorico = document.getElementById('corpoHistorico');
    const historicoConsentimentos = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=c.dataConcessao");
    const historicoJSON = await historicoConsentimentos.json();

    historicoJSON.forEach((dado) => {
        let tr = document.createElement('tr');

        let consentimento = document.createElement('td');
        consentimento.innerHTML = dado.nomeFinalidade;

        let data = document.createElement('td');
        data.innerHTML = dado.dataConcessao;

        tr.appendChild(consentimento);
        tr.appendChild(data);

        corpoHistorico.appendChild(tr);
    });
}

consentimentos.addEventListener('click', () => {
    consentimentos.classList.add('ativo');
    historico.classList.remove('ativo');
    document.getElementsByClassName('gradiente')[0].classList.remove('mudar-gradiente');

    document.getElementById('conteudo').innerHTML = `
    <div class="row justify-content-between align-items-center mb-3">
        <div class="col-7">
            <h4>Ordenar por</h4>
            <button class="filtros btn btn-primary" data-order="crescente">A-Z</button>
            <button class="filtros btn btn-primary" data-order="decrescente">Z-A</button>
            <button class="filtros btn btn-primary" data-order="maior_taxa">Maior taxa de Consentimento</button>
            <button class="filtros btn btn-primary" data-order="menor_taxa">Menor taxa de Consentimento</button>
         </div>
    </div>

    <div id="consentimentos" class="row gy-3 justify-content-center">
        <!-- Onde o JS vai gerar os consentimentos -->
    </div>`;
    listarConsentimentos("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=f.nomeFinalidade");
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


// Sistema de filtragem
document.querySelectorAll('.filtros').forEach(button => {
    button.addEventListener('click', async () => {
        const order = button.getAttribute('data-order');
        const listarConsentimentos = document.getElementById('consentimentos');
        const itens = Array.from(listarConsentimentos.getElementsByClassName('card'));
        const listaContagem = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=f.nomeFinalidade");
        const dadosContagem = await listaContagem.json();

        listarConsentimentos.innerHTML = '<a href=# data-bs-toggle="modal" data-bs-target="#modalAdcConsentimento" id="adicionarConsentimento" class="col-2 d-flex justify-content-center align-items-center mx-1"><p>+</p></a>';
        if (order == 'crescente') {
            itens.sort((a, b) => a.textContent.localeCompare(b.textContent));
        } else if (order == 'decrescente') {
            itens.sort((a, b) => b.textContent.localeCompare(a.textContent));
        } else if (order == 'maior_taxa') {
            const total = {};
            const consentido = {};

            dadosContagem.forEach(consentimento => {
                const nomeConsentimento = consentimento.nomeFinalidade;
                if (total[nomeConsentimento]) {
                    total[nomeConsentimento]++;
                } else {
                    total[nomeConsentimento] = 1;
                }
            });

            itens.sort((a, b) => {
                const textoB = b.querySelector('h5').textContent;
                const textoA = a.querySelector('h5').textContent;

                return total[textoB] - total[textoA];
            });
        } else if (order == 'menor_taxa') {
            const total = {};

            dadosContagem.forEach(consentimento => {
                const nomeConsentimento = consentimento.nomeFinalidade;
                if (total[nomeConsentimento]) {
                    total[nomeConsentimento]++;
                } else {
                    total[nomeConsentimento] = 1;
                }
            });

            itens.sort((a, b) => {
                const textoB = b.querySelector('h5').textContent;
                const textoA = a.querySelector('h5').textContent;

                return total[textoA] - total[textoB];
            });
        }

        itens.forEach(item => {
            listarConsentimentos.appendChild(item);
        });
    });
});

// Função de listagem dos consentimentos
function listarConsentimentos(api) {
    const divResultados = document.getElementById("consentimentos");
    divResultados.innerHTML = '<a href=# data-bs-toggle="modal" data-bs-target="#modalAdcConsentimento" id="adicionarConsentimento" class="col-2 d-flex justify-content-center align-items-center mx-1"><p>+</p></a>';

    fetch(api)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição: ' + response.statusText);
            }
            return response.json();
        })
        .then(dados => {
            if (Array.isArray(dados) && dados.length > 0) {
                dados.forEach(consentimento => {
                    let card = document.createElement('div');
                    card.className = 'card col-3 mx-1 d-flex flex-column';

                    let cardBody = document.createElement('div');
                    cardBody.className = 'card-body d-flex flex-column justify-content-between';

                    let h5 = document.createElement('h5');
                    h5.className = 'card-title mb-2';
                    h5.textContent = consentimento.nomeFinalidade;

                    let p = document.createElement('p');
                    p.className = 'card-text flex-grow-1 d-flex justify-content-center mt-auto';
                    p.textContent = consentimento.descFinalidade;

                    let aRevogar = document.createElement('a');
                    aRevogar.className = 'btn btn-primary';
                    aRevogar.textContent = 'Revogar';

                    cardBody.appendChild(h5);
                    cardBody.appendChild(p);
                    cardBody.appendChild(aRevogar);
                    card.appendChild(cardBody);

                    divResultados.appendChild(card);

                    aRevogar.addEventListener('click', async () => {
                        const id = document.getElementById('idUsuario').value;
                        await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/revogar.php?usuario=" + id + '&finalidade=' + consentimento.idFinalidade);

                        listarConsentimentos("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=f.nomeFinalidade");
                        listarFinalidades();
                    });
                });
            } else {
                divResultados.innerHTML = '<a href=# data-bs-toggle="modal" data-bs-target="#modalAdcConsentimento" id="adicionarConsentimento" class="col-2 d-flex justify-content-center align-items-center mx-1"><p>+</p></a>';
            }
        })
        .catch(error => {
            console.error("Erro ao buscar consentimentos:", error);
            const divResultados = document.getElementById("consentimentos");
            divResultados.textContent = 'Erro ao buscar consentimentos.';
        });
}

async function listarFinalidades() {
    const listaFinalidades = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/listar.php");
    const dadosFinalidades = await listaFinalidades.json();
    const listaConsentimentos = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=f.nomeFinalidade");
    const dadosConsentimentos = await listaConsentimentos.json();

    document.getElementsByClassName('modal-body')[0].innerHTML = '';
    const resultados = document.createElement('div');
    resultados.id = 'todasFinalidades';
    resultados.className = 'row text-center p-3';
    resultados.innerHTML = '<h5 class="col-12">Todas Finalidades</h5>';

    document.getElementsByClassName('modal-body')[0].appendChild(resultados);

    const finalidadesFiltradas = dadosFinalidades.filter(finalidade =>
        !dadosConsentimentos.some(consentimento =>
            consentimento.nomeFinalidade === finalidade.nomeFinalidade
        )
    );

    if (finalidadesFiltradas.length > 0) {
        finalidadesFiltradas.forEach((dado) => {
            let card = document.createElement('div');
            card.className = 'card col-3 mx-1 d-flex flex-column';

            let cardBody = document.createElement('div');
            cardBody.className = 'card-body d-flex flex-column justify-content-between';

            let h5 = document.createElement('h5');
            h5.className = 'card-title mb-2';
            h5.textContent = dado.nomeFinalidade;

            let p = document.createElement('p');
            p.className = 'card-text flex-grow-1 d-flex justify-content-center mt-auto';
            p.textContent = dado.descFinalidade;

            let adicionar = document.createElement('button');
            adicionar.id = 'btnConsentir';
            adicionar.className = 'btn btn-primary mt-auto';
            adicionar.textContent = 'Consentir';

            cardBody.appendChild(h5);
            cardBody.appendChild(p);
            cardBody.appendChild(adicionar);
            card.appendChild(cardBody);

            resultados.appendChild(card);

            const id = document.getElementById('idUsuario').value;
            adicionar.addEventListener('click', () => {
                listaAdicionarConsentimentos.push({ "finalidade": dado.idFinalidade, "usuario": id })
                adicionar.classList.add('disabled');
                adicionar.disabled = true;
            });
        });

        let concluir = document.createElement('button');
        concluir.textContent = 'Enviar';
        concluir.className = 'btn btn-primary float-end col-2 mt-3';
        document.getElementsByClassName('modal-body')[0].appendChild(concluir);
        concluir.addEventListener('click', adicionarConsentimento);
    } else {
        let vazio = document.createElement('p');
        vazio.textContent = 'Todas finalidades foram consentidas.';
        vazio.className = 'col-12 fs-3 fw-medium p-3';

        resultados.appendChild(vazio);
    }
}

async function adicionarConsentimento() {
    try {
        const id = document.getElementById('idUsuario').value;

        await Promise.all(
            listaAdicionarConsentimentos.map(novoConsentimento =>
                fetch(`http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/registrar.php?finalidade=${novoConsentimento.finalidade}&usuario=${novoConsentimento.usuario}`)
            )
        );

        const modal = bootstrap.Modal.getInstance(document.querySelector('.modal'));
        modal.hide();

        listaAdicionarConsentimentos = [];

        listarFinalidades();
        listarConsentimentos("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id + "&ordem=f.nomeFinalidade");
    } catch (error) {
        console.error('Erro no processo:', error);
        alert('Ocorreu um erro ao processar os consentimentos');
    }
}