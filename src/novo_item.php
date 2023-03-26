<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <link href="css/estilo.css" rel="stylesheet" >
        <title>Realizar cadastro de novo item </title>
    </head>


    <body>
        <img src= "imagens/img4.jpg" width="250" height="300"  id="turmaghibli"/>


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
        </div>

        <div id="formdiv" class="center">

            <?php
            
            $form = '<form action="'.$_SERVER["PHP_SELF"].'" method="POST" 
                  enctype="multipart/form-data"  class="center">
                    <label><h3>Cadastrar novo item</h3></label>
                    </p>
                    <h4>Nome do filme:</h4>
                    <input type= "text" name="titulo" placeholder="Nome do filme a cadastrar">
                    <p>
                    <h4>Coloque uma imagem para o item </h4>
                    <input type="file" name="capa" >
                    <h4>Ano</h4>
                    <input type= "text" name="ano" placeholder="Ano de lançamento do filme">
                    <p>
                        <input type="submit" name= "enviar-capa" value="Cadastrar" >
            </form>';
            
            if (isset($_SESSION['id_user']) && $_SESSION['adm'] == 1) {
                if (isset($_POST['enviar-capa'])):
                    $formatosPermitidos = array("png", "jpg", "jpeg", "gif");
                    $extensao = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);

                    if (in_array($extensao, $formatosPermitidos)):
                        $pasta = "arquivos/";
                        $temporario = $_FILES['capa']['tmp_name'];
                        
                        require_once 'filme_class.php';
                        $filme = new Filme();
                        $titulo = $_POST['titulo'];
                        $ano = $_POST['ano'];
                        $novoNome = $titulo . ".$extensao";
                        $filme->cadastrar($titulo, $ano, $novoNome);

                        if (move_uploaded_file($temporario, $pasta . $novoNome)):
                            $mensagem = "Upload com sucesso";
                        else:
                            $mensagem = "Nao foi possível fazer o upload";

                        endif;
                    else :
                        $mensagem = "formato inválido";
                    endif;
                    echo $mensagem;
                endif;
                
                echo $form;
            }
            else
            {
                echo "<text><h3>Você precisa estar logado como administrador para cadastrar filme</h3></text>";
            }
            ?>
        </div>
    </body>
</html>