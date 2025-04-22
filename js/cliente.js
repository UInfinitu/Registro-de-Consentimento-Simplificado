const consentimentos = document.getElementById('seusConsentimentos');
const historico = document.getElementById('historico');
const id = document.getElementById('idUsuario').value;

window.addEventListener('load', async () => {
    consentimentos.classList.add('ativo');

    listarConsentimentos("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id);

    // Listar no modal
    const listaFinalidades = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/listar.php");
    const dadosFinalidades = await listaFinalidades.json();
    const listaConsentimentos = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id);
    const dadosConsentimentos = await listaConsentimentos.json();

    const resultados = document.getElementById('todasFinalidades');
    resultados.innerHTML = '<h5 class="col-12">Todas Finalidades</h5>';

    const finalidadesFiltradas = dadosFinalidades.filter(finalidade =>
        !dadosConsentimentos.some(consentimento =>
            consentimento.nomeFinalidade === finalidade.nomeFinalidade
        )
    );

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

        let aRevogar = document.createElement('a');
        aRevogar.href = '#';
        aRevogar.className = 'mt-auto';
        aRevogar.textContent = 'Revogar';

        cardBody.appendChild(h5);
        cardBody.appendChild(p);
        cardBody.appendChild(aRevogar);
        card.appendChild(cardBody);

        resultados.appendChild(card);
    });
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


// Sistema de filtragem
document.querySelectorAll('.filtros').forEach(button => {
    button.addEventListener('click', async () => {
        const order = button.getAttribute('data-order');
        const listarConsentimentos = document.getElementById('consentimentos');
        const itens = Array.from(listarConsentimentos.getElementsByClassName('card'));
        const listaContagem = await fetch("http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" + id);
        const dadosContagem = await listaContagem.json();

        listarConsentimentos.innerHTML = '<a href=# data-bs-toggle="modal" data-bs-target="#modalLogin" id="adicionarConsentimento" class="col-2 d-flex justify-content-center align-items-center mx-1"><p>+</p></a>';
        if (order == 'crescente') {
            itens.sort((a, b) => a.textContent.localeCompare(b.textContent));
        } else if (order == 'decrescente') {
            itens.sort((a, b) => b.textContent.localeCompare(a.textContent));
        } else if (order == 'maior_taxa') {
            const total = {};
            const consentido = {};

            dadosContagem.forEach(consentimento => {
                const nomeConsentimento = consentimento.nomeFinalidade;
                const estado = consentimento.estado;
                if (total[nomeConsentimento]) {
                    total[nomeConsentimento]++;
                } else {
                    total[nomeConsentimento] = 1;
                }

                if (estado == 1) {
                    if (consentido[nomeConsentimento]) {
                        consentido[nomeConsentimento]++;
                    } else {
                        consentido[nomeConsentimento] = 1;
                    }
                }
            });

            itens.sort((a, b) => {
                const textoB = b.querySelector('h5').textContent;
                const textoA = a.querySelector('h5').textContent;

                const taxaB = (consentido[textoB] || 0) / total[textoB];
                const taxaA = (consentido[textoA] || 0) / total[textoA];

                return taxaB - taxaA;
            });
        } else if (order == 'menor_taxa') {
            const total = {};
            const consentido = {};

            dadosContagem.forEach(consentimento => {
                const nomeConsentimento = consentimento.nomeFinalidade;
                const estado = consentimento.estado;
                if (total[nomeConsentimento]) {
                    total[nomeConsentimento]++;
                } else {
                    total[nomeConsentimento] = 1;
                }

                if (estado == 1) {
                    if (consentido[nomeConsentimento]) {
                        consentido[nomeConsentimento]++;
                    } else {
                        consentido[nomeConsentimento] = 1;
                    }
                }
            });

            itens.sort((a, b) => {
                const textoB = b.querySelector('h5').textContent;
                const textoA = a.querySelector('h5').textContent;

                const taxaB = (consentido[textoB] || 0) / total[textoB];
                const taxaA = (consentido[textoA] || 0) / total[textoA];

                return taxaA - taxaB;
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
                    aRevogar.href = '#';
                    aRevogar.className = 'mt-auto';
                    aRevogar.textContent = 'Revogar';

                    cardBody.appendChild(h5);
                    cardBody.appendChild(p);
                    cardBody.appendChild(aRevogar);
                    card.appendChild(cardBody);

                    divResultados.appendChild(card);
                });
            } else {
                divResultados.textContent = 'Nenhum resultado encontrado.';
            }
        })
        .catch(error => {
            console.error("Erro ao buscar consentimentos:", error);
            const divResultados = document.getElementById("consentimentos");
            divResultados.textContent = 'Erro ao buscar consentimentos.';
        });
}