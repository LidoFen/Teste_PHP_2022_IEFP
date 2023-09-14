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
    <script src="assets/js/funcionario.js"></script>

    <link rel="stylesheet" href="assets/css/lib/bootstrap.css">
    <link rel="stylesheet" href="assets/css/lib/datatables.css">
    <link rel="stylesheet" href="assets/css/lib/select2.css">
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
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="vinhas.php">Vinhas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="funcionarios.php">Funcionários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Vindimas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="card text-bg-light mt-5">
      <div class="card-header text-center">
        Registo de Vindimas
      </div>
      <div class="card-body">
        <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
      	  <img class="img-fluid img-thumbnail" src="https://www.wineinvestment.com/assets/harvest-blog-template-header-v2__FocusFillWzE5MjAsNTc1LCJ5IiwzMTNd.jpg" style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
          <h2 class="card-title text-center" style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">Registo de Vindimas</h2>
        </div>
        <hr>
        <form class="mt-3">
          <div class="row">
            <div class="col-md-3 text-center">
              <label for="vinhaVindima" class="form-label">Vinha</label>
              <select class="form-select" id="vinhaVindima" onchange="getAnos(this.value)">

              </select> 
            </div>
            <div class="col-md-3 text-center">
              <label for="funcionarioVindima" class="form-label">Funcionário</label>
              <select class="form-select" id="funcionarioVindima">
                
              </select>
            </div>
            <div class="col-md-2 text-center">
              <label for="kgVindima" class="form-label">KG</label>
              <input type="number" class="form-control" id="kgVindima">
            </div>
            <div class="col-md-2 text-center">
              <label for="dataHoraVindima" class="form-label">Data/Hora</label>
              <input type="datetime-local" class="form-control" id="dataHoraVindima">
            </div>
            <div class="col-md-2 text-center" id="anoVindimaDiv">
              <label for="dataHoraVindima" class="form-label">Ano</label>
              <select class="form-select" id="anoVindima">
                <option selected disabled>Escolha uma vinha</option>
              </select>
            </div>
            <div class="col-md-2 text-center" id="novoAnoVindimaDiv">
              

            </div>
            <div class="row">
              <div class="col-md-12 text-center mt-3">
                <button type="button" class="btn btn-primary" onclick="registaVindima()">Registar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>


    <div class="card mt-5">
      <div class="card-header text-center">
        Listagem de Vindimas
      </div>
      <div class="card-body">
        <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
      	  <img class="img-fluid img-thumbnail" src="https://www.uniroma1.it/sites/default/files/styles/1150_300/public/uva_0.jpeg?itok=mUm9vICK&c=f49cda75af969f5b850503787139d36d" style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
          <h2 class="card-title text-center" style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">Listagem de Vindimas</h2>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="tabelaVindimas" class="table table-striped">
            <thead>
              <tr>
                <th>Foto</th>
                <th>ID</th>
                <th>Vinha</th>
                <th>Funcionário</th>
                <th>KG</th>
                <th>Data/Hora</th>
                <th>Ano</th>
              </tr>
            </thead>
            <tbody id="corpoTabelaVindimas">

            </tbody>
          </table>
        </div>  
      </div>
    </div>

    <div class="card mt-5">
      <div class="card-header text-center">
          Stock de Vinho
      </div>
      <div class="card-body text-center">
        <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
      	  <img class="img-fluid img-thumbnail" src="https://www.superiorssteakhouse.com/assets/uploads/2017/12/wine-header.jpg" style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
          <h2 class="card-title text-center" style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">Listagem de Stock</h2>
        </div>
        <hr>
        <p>Em alternativa, filtre por ano</p>
        <select class="js-example-basic-single" name="state" id="anoVindima1" onchange="filtraVinhoAno(this.value)" >
              
        </select>
        <button type="button" class="btn btn-warning ms-2" onclick="getStock()">Reset</button>
        <div class="table-responsive">
          <table id="tabelaStock" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade Total</th>
                <th>Castas</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="corpoTabelaStock">

            </tbody>
          </table>
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
                              <img class="img-fluid img-thumbnail" src="https://www.antoniomacanita.com/uploads/subcanais/dsc_0522jpg.jpg" style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
                              <h2 class="card-title text-center" style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">Lista de Castas</h2>
                            </div>
                              <table class="table table-striped" id="tabelaCastas">
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

  <style>
    .error-cell {
      text-align: center; 
      vertical-align: middle; 
    }

    .centered-text {
      display: inline-block;
    }

  </style>



    
</body>
</html>