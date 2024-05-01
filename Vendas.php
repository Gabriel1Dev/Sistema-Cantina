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
.Vendas{
  margin-right: 450px;
  margin-left:450px;
  text-align: center;
  border: 1px solid honeydew;
  border-radius:5px;
  padding-bottom: 10px;
}

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
td,tr,h1,label{
  color:white;
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="Estoque.php">Estoque</a>
  <a href="historico.php">Historico de vendas</a>
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
<form action="Vendas.php" method="post">
    <div class="Vendas">
   
    <?php
            $conexao = new mysqli("localhost","root","","2info");
        ?>
      <h1>Comprar itens:</h1>
      <label for="qtd">Quantidade de produto:</label> 
      <input type="text" name="qtd"><br>
      <label for="nome">Nome do produto:</label>
      <select name="nome">
        <?php
        $sql = "select * from produtos order by nome";
        $resultado = $conexao->query($sql);
        while($linha = $resultado->fetch_object())
        {
            echo "<option value='".$linha->nome."'>".$linha->nome."</option>";
        }
      ?>
      </select><br>
      <label for="cpf" required>CPF do cliente:</label>
      <select name="cpf">
        <?php
            $sql = "select * from cliente order by cpf";
            $resultado = $conexao->query($sql);
            while($linha = $resultado->fetch_object())
            {
                echo "<option value='".$linha->cpf."'>".$linha->cpf."</option>";
            }
        ?>
        </select>
      <br>
      <input type="submit" name="pesquisar" value="Comprar">
      </div>
    </form>
<?php
include("conexao.php");

if (isset($_POST['nome']) && isset($_POST['qtd']) && isset($_POST['cpf'])) {
    $nome = $_POST['nome'];
    $qtd = $_POST['qtd'];
    $cpf = $_POST['cpf'];

    $query1 = "SELECT valor FROM produtos WHERE nome = '$nome'";
    $query2 = "SELECT codigo FROM produtos WHERE nome = '$nome'";

    // Executar as consultas SQL
    $resultado1 = $conexao->query($query1);
    $resultado2 = $conexao->query($query2);

    if ($resultado1 && $resultado2) {
        if ($resultado1->num_rows > 0 && $resultado2->num_rows > 0) {
            $linha1 = $resultado1->fetch_assoc();
            $linha2 = $resultado2->fetch_assoc();

            $valor_unitario = $linha1['valor'];
            $codigo_produto = $linha2['codigo'];

            $total = $valor_unitario * $qtd;

            $query_atualiza = "UPDATE produtos SET quantidade = quantidade - $qtd WHERE nome = '$nome'";
            $conexao->query($query_atualiza);

            $query_venda = "INSERT INTO vendas (codigo_produto, cliente, valor_venda, data_venda) VALUES ('$codigo_produto','$cpf','$total', NOW())";
            $conexao->query($query_venda);

            echo "<script>alert('Você realizou uma compra no valor de R$ $total !');</script>";
        }
    $conexao->close();
}}
?>

</body>
</html>