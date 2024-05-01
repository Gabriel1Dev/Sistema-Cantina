<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Boas vindas ao painel!</title>
    <style>
        .saudacoes
        {
            position: absolute; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color:#DFCFBE;
            font-family:verdana;
        }
    </style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
span{
    color:white;
}
td,tr,h1{
  color:white;
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="Vendas.php">Comprar</a>
  <a href="historico.php">Histórico de vendas</a>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
<body class="bg-dark">
    <div class="Vendas">
  <h1>Produtos disponiveis para compra:</h1>
  <?php
    $sql = "select * from produtos order by codigo";

    $conexao = new mysqli("localhost","root","","2info");

    $resultado = $conexao->query($sql);

    echo "<table class='table table-hover'>";
    echo "<tr>
        <td>Código</td>
        <td>Produto</td>
        <td>Valor</td>
        <td>Ainda em estoque</td>";

    while($linha = $resultado->fetch_object())
    {
        echo "<tr>
        <td>$linha->codigo</td>
        <td>$linha->nome</td>
        <td>$linha->valor</td>
        <td>$linha->quantidade</td>
        </tr>";
    }
    echo "</table>";
    
  ?>
    </div>   
</body>
</html> 