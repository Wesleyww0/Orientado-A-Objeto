<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styleCadastro.css">

    <title>Turma</title>
    <link rel="icon" href="../assets/img/icone_fatecSR.ico" type="image/x-icon">

    <style>
        .navbar-nav {
            width: 100%;
            display: flex;
            
            justify-content: space-around;
        }
        
        .nav-item {
            flex-grow: 1;
            text-align: center;
        }
        
        .nav-link {
            display: block;
            color: #ffffff !important;
            font-weight: bold;
            padding: 0px;
        }
        
        .nav-link:hover {
            background-color: #495057;
        }
    </style>
</head>

<body>
    <header>
        <a href="../Funcoes/indexPagina">
            <h1 id="headerTitle">Mapeamento de Salas</h1>
        </a>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../funcoes/abreSala">Sala de Aula</a></li>
                    <li class="nav-item"><a class="nav-link" href="../funcoes/abreTurma">Docente</a></li>
                    <li class="nav-item"><a class="nav-link" href="../funcoes/abreTurma">Turma</a></li>
                    <li class="nav-item"><a class="nav-link" href="../funcoes/abrePeriodo">Período</a></li>
                    <li class="nav-item"><a class="nav-link" href="../funcoes/abreMapa">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../funcoes/abreRelatorio">Relatório</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="secao4" id="cadastroTurma">
            <div id="btnCadastroModal">
                <input type="text" id="inputPesquisa" class="form-control" placeholder="Pesquisar"
                    onkeyup="filtrarTabela()">

                <button id="botaoModal" type="button" class="btn btn-outline-primary btnAcao" data-toggle="modal"
                    data-target="#cadastroTurmaModal">
                    Cadastrar Nova Turma
                </button>
            </div>
            <div class="modal fade" id="cadastroTurmaModal" tabindex="-1" role="dialog"
                aria-labelledby="cadastroTurmaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cadastroTurmaModalLabel">Cadastrar Nova Turma</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formCadastroTurma" method="post" class="modal-content">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="descricao" class="col-form-label">Descrição</label>
                                        <input type="text" id="descricao" name="descricao" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="capacidade" class="col-form-label">Capacidade</label>
                                        <input type="number" id="capacidade" name="capacidade" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="dataInicio" class="col-form-label">Data de Inicio</label>
                                        <input type="date" id="dataInicio" name="dataInicio" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btnAcao" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btnAcao" onclick="cadastro();">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Turma</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEditTurma" method="post">
                            <div class="modal-body">
                                <input type="hidden" id="editId" name="editId">
                                <div class="form-group">
                                    <label for="editdescricao">descricao</label>
                                    <input type="text" id="editdescricao" name="editdescricao" class="form-control" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="editcapacidade" class="col-form-label">capacidade</label>
                                        <input type="number" id="editcapacidade" name="editcapacidade" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="editdataInicio" class="col-form-label">dataInicio</label>
                                        <select name="editdataInicio" id="editdataInicio" class="form-control" required>
                                            <option value="">Selecione</option>
                                            <option value="F">Funcionário</option>
                                            <option value="C">Carta Convite</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btnAcao" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btnAcao" onclick="editarTurma();">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="mostrarCadastro">
            <div class="table-responsive">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Docente</th>
                            <th>Capacidade</th>
                            <th>Data de Inicio</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="conteudo-Turma">
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        </footer>

    <script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/sweetalert2.all.min.js" type="text/javascript"></script>

    <script>
        async function cadastro() {
            event.preventDefault();
            try {
                event.preventDefault();
                const descricao = document.getElementById('descricao').value;
                const capacidade = document.getElementById('capacidade').value;
                const dataInicio = document.getElementById('dataInicio').value;


                const response = await fetch('../Turma/inserir', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        descricao: descricao,
                        capacidade: capacidade,
                        dataInicio: dataInicio
                    })
                });

                const result = await response.json();

                if (result.codigo == 1) {
                    $('#cadastroTurmaModal').modal('hide');
                    Swal.fire('Sucesso!', result.msg, 'success');

                    // Atualizar a tabela
                    carregarDados();
                } else {
                    // 1. Mapeia e junta as mensagens de erro em um bloco HTML
                    const mensagensDeErro = result.erros.map(erro => {
                        // Utilizamos a tag <p> para garantir que cada erro fique em uma linha separada no SweetAlert
                        return `<p><strong>[${erro.campo ?? erro.codigo}]</strong> ${erro.msg}</p>`;
                    }).join('');

                    // 2. Chama o Swal.fire usando a propriedade 'html'
                    Swal.fire({
                        title: 'Houve(ram) erro(s) de validação:',
                        html: mensagensDeErro, // Usamos 'html' para exibir as tags <p> e <strong>
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    });
                }
            } catch (error) {
                console.error('Erro ao cadastrar o Turma:', error);
                Swal.fire('Erro', 'Ocorreu um erro ao processar a requisição.', 'error');
            }
        }

        async function carregarDados() {
            try {

                const response = await fetch('../Turma/consultar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        codigo: '',
                        descricao: '',
                        capacidade: '',
                        dataInicio: ''
                    })
                });

                const data = await response.json();
                const conteudoAcesso = document.getElementById('conteudo-Turma');

                // Limpar a tabela antes de preencher com novos dados
                conteudoAcesso.innerHTML = '';

                // Preencher a tabela com os dados recebidos
                data.dados.forEach(item => {
                    dataInicio = item.dataInicio;
                    if (dataInicio == 'F') {
                        dataInicio = 'Funcionário'
                    } else {
                        dataInicio = 'Carta Convite'
                    }
                    codigo = item.codigo;
                    conteudoAcesso.innerHTML += `
                        <tr class="alert alert-warning">
                            <td>${item.descricao}</td>
                            <td>${item.capacidade}</td>
                            <td>${dataInicio}</td>
                            <td>
                                <div class="row">
                                    <button class="btn btn-warning btnAcao" onclick="openEditModal(${item.codigo}, this)">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btnAcao btnAcaoExcluir" onclick="deletarTurma(${item.codigo})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                });

            } catch (error) {
                console.error('Erro ao carregar os dados:', error);
            }
        }

        carregarDados();

        $('#cadastroTurmaModal').on('show.bs.modal', function() {
            $('#formCadastroTurma')[0].reset();
        });

        function openEditModal(codigo, button) {
            // A linha do botão clicado
            const row = button.closest('tr');
            // Pegar os dados da linha
            const descricao = row.cells[0].innerText;
            const capacidade = row.cells[1].innerText;
            const dataInicio = row.cells[2].innerText.charAt(0);

            // Preenche o modal com os dados do Turma
            document.getElementById('editId').value = codigo;
            document.getElementById('editdescricao').value = descricao;
            document.getElementById('editcapacidade').value = capacidade;
            document.getElementById('editdataInicio').value = dataInicio;

            // Abre o modal
            $('#editModal').modal('show');
        }

        async function editarTurma() {
            event.preventDefault();
            try {
                const codigo = document.getElementById('editId').value;
                const descricao = document.getElementById('editdescricao').value;
                const capacidade = document.getElementById('editcapacidade').value;
                const dataInicio = document.getElementById('editdataInicio').value;


                const response = await fetch('../Turma/alterar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        codigo: codigo,
                        descricao: descricao,
                        capacidade: capacidade,
                        dataInicio: dataInicio
                    })
                });

                const result = await response.json();

                if (result.codigo == 1) {
                    // Fechar o modal
                    $('#editModal').modal('hide');

                    // Mostrar uma mensagem de sucesso (opcional)
                    Swal.fire('Sucesso!', result.msg, 'success');

                    carregarDados();
                } else {
                    // 1. Mapeia e junta as mensagens de erro em um bloco HTML
                    const mensagensDeErro = result.erros.map(erro => {
                        // Utilizamos a tag <p> para garantir que cada erro fique em uma linha separada no SweetAlert
                        return `<p><strong>[${erro.campo ?? erro.codigo}]</strong> ${erro.msg}</p>`;
                    }).join('');

                    // 2. Chama o Swal.fire usando a propriedade 'html'
                    Swal.fire({
                        title: 'Houve(ram) erro(s) de validação:',
                        html: mensagensDeErro, // Usamos 'html' para exibir as tags <p> e <strong>
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    });
                }
                $('#cadastroTurmaModal').modal('hide');
                carregarDados(); // Atualiza a tabela com os novos dados
            } catch (error) {
                console.error('Erro ao cadastrar o Turma:', error);
                Swal.fire('Erro', 'Ocorreu um erro ao processar a requisição.', 'error');
            }
        }

        async function deletarTurma(codigo) {
            event.preventDefault();
            Swal.fire({
                title: 'Atenção!',
                text: 'Tem certeza que deseja remover esse Turma?',
                icon: 'question',
                showConfirmButton: true,
                showCancelButton: true,
                customClass: {
                    popup: 'my-swal-popup',
                    title: 'my-swal-title',
                    html: 'my-swal-text',
                    confirmButton: 'btn btn-danger btnAcao my-swal-button',
                    cancelButton: 'btn btn-secondary btnAcao my-swal-button',
                },
                buttonsStyling: false
            }).then(async function(res) {
                if (res.isConfirmed) {
                    const config = {
                        method: 'post',
                        body: JSON.stringify({
                            codigo: codigo
                        })
                    };

                    const request = await fetch('../Turma/desativar', config);
                    const response = await request.json();

                    Swal.fire({
                        title: 'Atenção!',
                        text: response.msg,
                        icon: response.codigo == 1 ? 'success' : 'error',
                        customClass: {
                            popup: 'my-swal-popup',
                            title: 'my-swal-title',
                            html: 'my-swal-text',
                            confirmButton: 'btn btn-primary btnAcao',
                        },
                        buttonsStyling: false
                    });
                    carregarDados();
                }
            });
        }

        function filtrarTabela() {
            const input = document.getElementById("inputPesquisa");
            const filter = input.value.toLowerCase();
            const tabela = document.getElementById("conteudo-Turma");
            const linhas = tabela.getElementsByTagName("tr");
            for (let i = 0; i < linhas.length; i++) {
                const colTurma = linhas[i].getElementsByTagName("td")[0]; // Coluna do descricao do Turma
                const colcapacidade = linhas[i].getElementsByTagName("td")[1]; // Coluna do dataInicio do capacidade
                const coldataInicio = linhas[i].getElementsByTagName("td")[2]; // Coluna do dataInicio do Turma

                if (colTurma) { // Verifica se as colunas existem
                    const TurmaTexto = colTurma.textContent || colTurma.innerText;
                    const dataInicioTexto = coldataInicio.textContent || coldataInicio.innerText;
                    const capacidadeTexto = colcapacidade.textContent || colcapacidade.innerText;
                    // Verifica se o filtro corresponde ao descricao do Turma ou ao capacidade
                    if ((TurmaTexto.toLowerCase().indexOf(filter) > -1) || (dataInicioTexto.toLowerCase().indexOf(filter) > -1)) {
                        linhas[i].style.display = ""; // Exibe a linha
                    } else {
                        linhas[i].style.display = "none"; // Oculta a linha
                    }
                }
            }
        }
    </script>
</body>
</html>