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
          <a class="nav-link active" aria-current="page" href="#">Funcionários</a>
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
        Registo de Funcionários
      </div>
      <div class="card-body">
      <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
      	<img class="img-fluid img-thumbnail" src="https://www.domaine-du-grand-mayne.com/wp-content/uploads/2015/08/header_wines.jpg" style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
        <h2 class="card-title text-center" style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">Registo de Funcionários</h2>
      </div>
      <hr>
        <form class="mt-3">
          <div class="row">
            <div class="col-md-2 text-center">
              <label for="biFuncionario" class="form-label">BI</label>
              <input type="number" class="form-control" id="biFuncionario">
            </div>
            <div class="col-md-4 text-center">
              <label for="nomeFuncionario" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nomeFuncionario">
            </div>
            <div class="col-md-6 text-center">
              <label for="moradaFuncionario" class="form-label">Morada</label>
              <input type="text" class="form-control" id="moradaFuncionario">
            </div>
            <div class="col-md-2 text-center mt-3">
              <label for="telefoneFuncionario" class="form-label">Telefone</label>
              <input type="number" class="form-control" id="telefoneFuncionario">
            </div>
            <div class="col-md-2 text-center mt-3">
              <label for="emailFuncionario" class="form-label">Email</label>
              <input type="email" class="form-control" id="emailFuncionario">
            </div>
            <div class="col-md-2 text-center mt-3">
              <label for="salarioFuncionario" class="form-label">Salario</label>
              <input type="number" class="form-control" id="salarioFuncionario">
            </div>
            <div class="col-md-2 text-center mt-3">
              <label for="estadoFuncionario" class="form-label">Estado</label>
              <select class="form-select" id="estadoFuncionario">

              </select>
            </div>
          <div class="row">
            <div class="col-md-12 text-center mt-3">
              <button type="button" class="btn btn-primary" onclick="registaFuncionario()">Registar</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>



    <div class="card text-bg-light mt-5">
      <div class="card-header text-center">
        Listagem de Funcionários Inativos
      </div>
      <div class="card-body text-center">
        <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
      	  <img class="img-fluid img-thumbnail" src="https://alumni.berkeley.edu/wp-content/uploads/2018/03/sanford-1-header.png" style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
          <h2 class="card-title text-center" style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.0); padding: 10px; text-shadow: -0.5px -0.5px 0 black, 0.5px -0.5px 0 black, -0.5px 0.5px 0 black, 0.5px 0.5px 0 black;">Lista de Funcionários Inativos</h2>
        </div>
        <hr>
        <p class="">Em alternativa, escolha um funcionário, e altere o seu estado</p>
        <select class="js-example-basic-single" name="state" id="selectFuncionariosStock" onchange="apresentaBotao(this.value)">

        </select>
        <span id="divBotoes">

        </div>
        <div class="table-responsive">  
          <table id="tabelaFuncionarios" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>BI</th>
                <th>Nome</th>
                <th>Morada</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Salario</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody id="corpoTabelaFuncionarios">

            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
    
</body>
</html>