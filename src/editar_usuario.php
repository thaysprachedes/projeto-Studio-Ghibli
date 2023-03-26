<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <link href="css/estilo.css" rel="stylesheet" >
        <title>Biblioteca</title>
    </head>


    <body>
        <img src= "imagens/img3.jpg" width="250" height="300"  id="turmaghibli"/>


        <div id="div1" class="center" class="fonte">

            <table border="0" >
                <tr>
                    <td colspan="2">
                        <img src= "imagens/totoro2.png" style="width:1000px; height:100px;"/>
                    </td>
                </tr>
            </table>
        </div>
        <div id="div2" class="fonte"><br>
            <?php
            session_start();
            if (isset($_SESSION['nome'])) {
                echo "<h4><strong>&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp Olá, " . $_SESSION['nome'] . "</strong></h4>";
            }
            if(isset($_SESSION['ultimo_acesso']))
            {
                echo "<h6><strong>&nbsp&nbsp&nbsp Último acesso: " . $_SESSION['ultimo_acesso'] . "</strong></h6>";
            }
            ?>
            <h4><strong>&nbsp&nbsp&nbspMENU</strong></h4>
            <ul>
                <li><a href= "index.php">Home</li></a>
                <p>
                <li><a href= "login.php"target="_self">Login</li></a>
                <p>
                <li><a href= "Biblioteca.php"target="_self">Biblioteca de filmes</li></a>
                <p>
                <li><a href= "novo_item.php"target="_self">Cadastros</li></a>
                <p>
                <li><a href= "pagina_de_devolucao.php"target="_self">Devoluções</li></a>
                <p>
                <li><a href="mailto:thaysprachedes@gmail.com">Fale com a gente</li></a>
                <p>
                <li><a href= "editar_usuario.php"target="_self">Editar meus dados</li></a>
                <p>
                <li><a href= "logout.php" target="_self">Sair</li></a>
            </ul>
            <br>
            <div id="formdiv" class="center" style='margin-top: -200px;'>
<?php


if (isset($_SESSION['id_user'])) {
    $form = get_form();
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['data_de_nascimento']) && isset($_POST['senha'])) {
       
        if ($_POST['nome'] == "" || $_POST['email'] == "" || $_POST['senha'] == "") {
            echo "<text><h3>Preencha todos os campos</h3></text>";
            echo $form;
        } else {
            $email = $_POST['email'];
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $data_de_nascimento = $_POST['data_de_nascimento'];


            require_once 'usuario_class.php';
            $usuario = new Usuario();
            if ($usuario->atualizar($_SESSION['id_user'], $email, $nome, $senha, $data_de_nascimento)) {
                echo "<text><h3>Atualizado com sucesso</h3></text>";
                $_SESSION['nome'] = $nome;
                $_SESSION['data_nasc'] = $data_de_nascimento;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
            }
        }
    } else {
        echo $form;
    }
}
else
{
    echo "<text><h3>Você precisa estar logado(a) para ver seus dados</h3></text>";
}

function get_form() {
    
    $id_user = $_SESSION['id_user'];
    $nome = $_SESSION['nome'];
    $adm = $_SESSION['adm'];
    $data_nasc = $_SESSION['data_nasc'];
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];
    
    return '<form action="editar_usuario.php" method="post" name="novo_cadastro" class="center">
					<h4>Nome:</h4>
					<br>
					<input type= "name" name="nome" placeholder="Nome completo" value="'.$nome.'" >
					<br>
					<h4>Email:</h4>
					<input type= "email" name="email" placeholder="Digite seu email" value="'.$email.'">
					<br>
					<h4>Data de Nascimento:</h4>
					<input type="date" id="start" name="data_de_nascimento" value="'.$data_nasc.'" min="1950-01-01" max="2020-01-01">
					<h4>Senha:</h4>
					<input type= password id="formNome" name="senha" maxlength="15" placeholder="máximo 15 caracteres" value="'.$senha.'">
					<p>
					<input type="submit" value="Atualizar">
				</form>';
}
?>


            </div>

    </body>
</html>