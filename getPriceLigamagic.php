<?php
include "mysql_connect.php";
include "api_search.php";

$ed = $_POST["option"];
getPrecoBanco($ed);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>GetPrice Ligamagic</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">

    

    

<link href="./bs/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./theme.bootstrap.min.css">



    <!-- Favicons -->
<link rel="apple-touch-icon" href="" sizes="180x180">
<link rel="icon" href="" sizes="32x32" type="image/png">
<link rel="icon" href="" sizes="16x16" type="image/png">
<link rel="mask-icon" href="" color="#712cf9">
<link rel="icon" href="">
<meta name="theme-color" content="#712cf9">


    <style>
      th {
          cursor: pointer;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">GetPrice Ligamagic</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Compartilhar</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
          </div>
        </div>
      </div>

      <form class="form-inline" action="getpriceligamagic.php" method="post">
      <div class="input-group" style="width:40%">
        <select class="form-select" name="option" id="inlineFormCustomSelectPref">
            <?php
                $sql = "SELECT nome, nome_reduzido FROM `colecoes`";
                $rs = mysqli_query($conn, $sql);
                echo '<option value="">Escolher Edição...</option>';
                while($row = $rs->fetch_assoc()) {
                  $tempNomeRed = $row["nome_reduzido"];
                  $tempNome = $row["nome"];
                  echo "<option name='value' value='$tempNomeRed'>$tempNome</option>";
                }
            ?>
        </select>
        <button class="btn btn-outline-secondary" type="submit" name="btnsearch">Search</button>
        </div>
      </form>
      <br>
      <br>
      <h2 style="text-transform:capitalize">Tabela Cada Carta 
      <?php 
      $sql = "SELECT nome FROM colecoes WHERE `nome_reduzido`='$ed'";
      $rs = mysqli_query($GLOBALS["conn"], $sql);
      while($row = $rs->fetch_assoc()) {
        echo $row["nome"];
      }
      ?>
      </h2>
      <br>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered tablesorter" id="myTable">
          <thead>
            <tr>
              <th scope="col" onclick="sortTable(0)">ID</th>
              <th scope="col" onclick="sortTable(1)">Nome PT-BR</th>
              <th scope="col" onclick="sortTable(2)">Nome EN</th>
              <th scope="col" onclick="sortTable(3)">Preco Menor</th>
              <th scope="col" onclick="sortTable(4)">Preco Medio</th>
              <th scope="col" onclick="sortTable(5)">Preco Maior</th>
            </tr>
          </thead>
          <tbody>
<?php makeTable($ed); ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="./bs/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script>
      (() => {
    'use strict'
  
    feather.replace({ 'aria-hidden': 'true' })
  
    // Graphs
    const ctx = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          'Comum',
          'Incomum',
          'Raro',
          'Mítico'
        ],
        datasets: [{
          data: [
            // dados interessantes para fazer um painel (opcional)
          ],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
  })()
    </script>
  </body>
</html>