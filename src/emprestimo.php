<!DOCTYPE html>
<html>
    <head> 

        <title>Area de login</title>
        <meta charset="utf-8">
    </head>

    <body>
        <link rel="stylesheet" href="css/estilo.css">
        <img src= "imagens/img5.jpg" width="250" height="300"  id="turmaghibli"/>


        <div id="div1" class="center">

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
                echo "<h4><strong>&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp Olá," . $_SESSION['nome'] . "</strong></h4>";
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
                <li><a href= "Biblioteca.php"target="_selfk">Biblioteca de filmes</li></a>
                <p>
                <li><a href= "novo_item.php" target="_self">Cadastros</li></a>
                <p>
                <li><a href= "pagina_de_devolucao.php" target="_self">Devoluções</li></a>
                <p>		
                <li><a href="mailto:thaysprachedes@gmail.com">Fale com a gente</li></a>
                <p>
                <li><a href= "editar_usuario.php"target="_self">Editar meus dados</li></a>
                <p>
                <li><a href= "logout.php" target="_self">Sair</li></a>
            </ul>
            <br>
        </div>



        <div id="formdiv" class="center">

<?php
if (isset($_SESSION['nome'])) {
    if(isset($_POST['data_emprestimo']))
    {
        $data_emprestimo = $_POST['data_emprestimo'];
        $data_devolucao = $_POST['data_devolucao'];
        $id_filme = $_POST['id_filme'];
        $id_usuario = $_SESSION['id_user'];
        
        require_once 'filme_class.php';
        $filme = new Filme();
        $filme->emprestar($id_usuario, $id_filme, $data_emprestimo, $data_devolucao);
        
        
        echo "<text><h3>Empréstimo realizado com sucesso!</h3></text>";
        
    }
    else
    {
        echo getFormConfirmacao();
    }   
} else {
    echo "<text><h3>Você precisa estar logado para poder emprestar filme</h3></text>";
}

function getFormConfirmacao() {
    $id_filme = $_GET['id_filme'];
    $imagem = $_GET['imagem_filme'];
    $titulo = $_GET['titulo'];
    

    $form = '<form action="emprestimo.php" method="post" name="formulario" class="center" style=" margin-top: -55px">
					<text class="center"><h2>' . $titulo . '<h2></text>
					<img src= "arquivos/' . $imagem . '" style="width:190px; height:300px;"/>
					<br>
					<h4>Data do Empréstimo:</h4>
					<input type="datetime-local" id="start" name="data_emprestimo" value="2020-11-29T19:30" min="2020-01-01" max="2022-01-01">
                                        <h4>Data da devolução:</h4>
					<input type="date" id="start" name="data_devolucao" value="2020-11-30" min="2020-01-01" max="2022-01-01">
                                        <input type="hidden" name="id_filme" value="' . $id_filme . '">
                                        <br><br>
					<input type="submit" value="Confirmar">
				   </form>';
    
    return $form;
}
?>

        </div>
    </body>
</html>