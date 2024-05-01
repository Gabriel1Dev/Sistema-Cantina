<?php
    include("conexao.php");
        if(isset($_POST['usuario']) || isset($_POST['senha']))
        {
            if(strlen($_POST['usuario']) == 0){
                echo '<script>alert("Preencha o campo com seu email");</script>';
            }
            else if(strlen($_POST['contato']) == 0){
                echo '<script>alert("Preencha o campo com sua senha");</script>';
            }
            else if(strlen($_POST['cpf']) == 0){
                echo '<script>alert("Preencha o campo com seu cpf");</script>';
            }
            else
            {
                $contato =$_POST['contato'];
                $email =$_POST['usuario'];
                $cpf =$_POST['cpf'];

                $sql = "SELECT * FROM cliente WHERE nome = '$email' AND contato = '$contato' AND cpf = '$cpf'";
                $resultado = $mysqli->query($sql);


                if(mysqli_num_rows($resultado) < 1)
                {
                    echo '<script>alert(" O E-mail ou senha estão incorretos");</script>';
                }
                else
                {
                    header("location: Vendas.php");
                }
            }
        }
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça login no sistema!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #formulario{
            border:1px solid black; 
            background-color:white;
            color:#eaeeaeae;
            box-shadow:6px 5px 12px;
            padding:40px;   
            position: absolute; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius:12px;
        }
        label{
            color:black;
        }
        a
        {
            color:green;
            text-decoration:none;
        }
    </style>
</head>
<body class="bg-dark">
    <form action="CadastroPrincipal.php" method="post">
        <div id="formulario">
            <label for="usuario">Digite seu login:</label>
            <input type="text" name="usuario" id="usuario" placeholder="usuario">
            <br>
            <label for="contato">Digite seu contato:</label>
            <input type="password" name="contato" id="contato" placeholder="Contato">
            <br>
            <label for="cpf">Digite seu CPF:</label>
            <input type="password" name="cpf" id="cpf" placeholder="CPF">
            <br>
            <input type="submit" class="btn-success" value="Confirmar">
            <a href="Cadastrar.php">Cadastre-se agora!</a>
            </div>
    </form>
</body>
</html>