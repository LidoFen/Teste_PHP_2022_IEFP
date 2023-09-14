<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teste Preparação 5417</title>
  <script src="assets/js/lib/jquery.js"></script>
  <script src="assets/js/lib/bootstrap.js"></script>
  <script src="assets/js/lib/datatables.js"></script>
  <script src="assets/js/lib/select2.js"></script>
  <script src="assets/js/lib/sweetalert.js"></script>
  <script src="assets/js/vinha.js"></script>

  <link rel="stylesheet" href="assets/css/lib/bootstrap.css">
  <link rel="stylesheet" href="assets/css/lib/datatables.css">
  <link rel="stylesheet" href="assets/css/lib/select2.css">
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body style="background-color: #444444;">

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Teste Preparação 5417</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Vinhas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="funcionarios.php">Funcionários</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vindimas.php">Vindimas</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="card text-bg-light mt-5">
      <div class="card-header text-center">
        Registo de Vinhas
      </div>
      <div class="card-body">
        <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
          <img class="img-fluid img-thumbnail" src="https://www.vineyardpro.com/images/headers/header-sunrise-2.jpg"
            style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
          <h2 class="card-title text-center"
            style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">
            Registo de Vinhas</h2>
        </div>
        <hr>
        <form class="mt-3">
          <div class="row">
            <div class="col-md-6 text-center">
              <label for="descricaoVinha" class="form-label">Descricao</label>
              <input type="text" class="form-control" id="descricaoVinha">
            </div>
            <div class="col-md-2 text-center">
              <label for="hectaresVinha" class="form-label">Hectares</label>
              <input type="number" class="form-control" id="hectaresVinha">
            </div>
            <div class="col-md-2 text-center">
              <label for="dataPlantacaoVinha" class="form-label">Data Plantação</label>
              <input type="date" class="form-control" id="dataPlantacaoVinha">
            </div>
            <div class="col-md-2 text-center">
              <label for="anoPrimeiraColheitaVinha" class="form-label">Ano Primeira Colheita</label>
              <input type="number" class="form-control" id="anoPrimeiraColheitaVinha">
            </div>
            <div class="col-md-4 text-center mt-3">
              <label for="fotoVinha" class="form-label">Fotografia</label>
              <input type="file" class="form-control" id="fotoVinha">
            </div>
            <div class="col-md-8 mt-5" id="listaCheckboxes">

            </div>
            <div class="row">
              <div class="col-md-12 text-center mt-3">
                <button type="button" class="btn btn-primary" onclick="registaVinha()">Registar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>



    <div class="card text-bg-light mt-5">
      <div class="card-header text-center">
        Listagem de Vinhas
      </div>
      <div class="card-body">
        <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
          <img class="img-fluid img-thumbnail"
            src="https://img.freepik.com/premium-photo/vineyards-saint-emilion-bordeaux-france-web-banner-template-header_100800-5725.jpg?w=2000"
            style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
          <h2 class="card-title text-center"
            style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">
            Lista de Vinhas</h2>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="tabelaVinhas" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Foto</th>
                <th>ID</th>
                <th>Descrição</th>
                <th>Hectares</th>
                <th>Data Plantação</th>
                <th>Ano Primeira Colheita</th>
                <th>Castas</th>
                <th>Editar</th>
                <th>Remover</th>
              </tr>
            </thead>
            <tbody id="corpoTabelaVinhas">

            </tbody>
          </table>
        </div>
      </div>
    </div>




  </div>

  <div class="modal fade" id="modalVinha" tabindex="-1" aria-labelledby="modalVinhaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalVinhaLabel">Edição de Vinha</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="card">
              <div class="card-body">
                <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
                  <img class="img-fluid img-thumbnail"
                    src="https://images.squarespace-cdn.com/content/v1/590ce534579fb370d4a6295b/1528395052969-EORY64TVBA7OYU2RZTH4/header-vineyards.jpg"
                    style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
                  <h2 class="card-title text-center"
                    style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">
                    Edição de Vinha</h2>
                </div>
                <hr>
                <form class="mt-3">
                  <div class="row">
                    <div class="col-md-2 text-center">
                      <label for="idVinhaEdit" class="form-label">ID</label>
                      <input type="number" class="form-control" id="idVinhaEdit" disabled>
                    </div>
                    <div class="col-md-4 text-center">
                      <label for="descricaoVinhaEdit" class="form-label">Descricao</label>
                      <input type="text" class="form-control" id="descricaoVinhaEdit">
                    </div>
                    <div class="col-md-2 text-center">
                      <label for="hectaresVinhaEdit" class="form-label">Hectares</label>
                      <input type="number" class="form-control" id="hectaresVinhaEdit">
                    </div>
                    <div class="col-md-2 text-center">
                      <label for="dataPlantacaoVinhaEdit" class="form-label">Data Plantação</label>
                      <input type="date" class="form-control" id="dataPlantacaoVinhaEdit">
                    </div>
                    <div class="col-md-2 text-center">
                      <label for="anoPrimeiraColheitaVinhaEdit" class="form-label">Ano 1ª Colheita</label>
                      <input type="number" class="form-control" id="anoPrimeiraColheitaVinhaEdit">
                    </div>
                    <div class="col-md-4 text-center mt-3">
                      <label for="fotoVinhaAtualEdit" class="form-label">Foto Atual</label><br>
                      <img id="fotoVinhaAtualEdit" class="img-thumbnail">

                    </div>
                    <div class="col-md-4 text-center mt-3">
                      <label for="fotoVinhaEdit" class="form-label">Foto Nova</label>
                      <input type="file" class="form-control" id="fotoVinhaEdit">
                    </div>
                    <div class="col-md-3 mt-5 ml-3" id="listaCheckboxesEdit">

                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-success" id="btnGuardar">Guardar Alterações</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="modalCastas" tabindex="-1" aria-labelledby="modalCastasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalCastasLabel">Visualização de Castas</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="card">
              <div class="card-body">
                <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
                  <img class="img-fluid img-thumbnail"
                    src="https://www.antoniomacanita.com/uploads/subcanais/dsc_0522jpg.jpg"
                    style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
                  <h2 class="card-title text-center"
                    style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">
                    Lista de Castas</h2>
                </div>
                <hr>
                <table class="table table-striped table-hover" id="tabelaCastas">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                    </tr>
                  </thead>
                  <tbody id="corpoTabelaCastas">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>