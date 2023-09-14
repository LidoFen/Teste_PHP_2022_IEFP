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

    <link rel="stylesheet" href="assets/css/lib/bootstrap.css">
    <link rel="stylesheet" href="assets/css/lib/datatables.css">
    <link rel="stylesheet" href="assets/css/lib/select2.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="vinhas.php">Vinhas</a>
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

<div id="carouselExampleAutoplaying" class="carousel slide mt-1" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="carousel-image-container">
        <img src="https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          Vinha de São Pedro
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="carousel-image-container">
        <img src="https://images.unsplash.com/photo-1596142332133-327e2a0ff006?ixlib=rb-4.0.3&ixid=M3xMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          Vinha Sebastião da Gama
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="carousel-image-container">
        <img src="https://images.unsplash.com/photo-1543418219-44e30b057fea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          Vinha Monte da Serra
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>





<style>
  .carousel-image-container {
    max-width: 100%;
    
    overflow: hidden;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
  }

  .carousel-image-container img {
    width: 100%;
    height: 800px;
  }

  .carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 15px 20px;
    border-radius: 5px;
    display: none;
  }

  .carousel-item:hover .carousel-caption {
    display: block;
  }

  .carousel-inner {
    transition: transform 0.5s ease;
  }

  .carousel-item:hover {
    transform: scale(1.03); /* Adjust the scaling factor as needed */
  }

  .carousel-control-prev:hover,
  .carousel-control-next:hover {
    color: #fff;
  }

  
</style>

    
</body>
</html>