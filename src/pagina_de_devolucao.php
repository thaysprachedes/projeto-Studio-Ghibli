<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <link href="css/estilo.css" rel="stylesheet" >
        <title>Biblioteca</title>
    </head>


    <body>

        <div>
            <!--<h3>hello</h3>-->
            <table border="0">
                <tr>
                    <td colspan="2">
                        <img src= "imagens/img9.jpg" width="250" height="300" id="turmaghibli"/>
                    </td>
                </tr>
            </table>
        </div>


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

            <div>
                <table>
                    <tr>


                        <?php

                        function getDivFilme($id, $nome, $ano, $imagem, $posy, $posx) {

                            $campo = '<input type="submit" value="Devolver">';

                            $form = '<td><div style=" margin-top:' . $posy . 'px; margin-left:' . $posx . 'px;">
                            <table border="3" style="border-color: pink",   class="center">
                                <tr>
                                    <td colspan="2">
                                        <img src= "arquivos/' . $imagem . '" style="width:190px; height:300px;"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ' . $nome . '
                                    </td>
                                </tr>
                                <tr><td>' . $ano . '</td></tr>
                                <tr>
                                    <td>
                                        <form action="pagina_de_devolucao.php" method="POST">
                                            <input type="hidden" name="id_filme" value="' . $id . '">
                                            <input type="hidden" name="imagem_filme" value="' . $imagem . '">
                                            <input type="hidden" name="titulo" value="' . $nome . '">
                                            ' . $campo . '
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div></td>';

                            return $form;
                        }

                        if (isset($_SESSION['nome'])) {

                            if (isset($_POST['id_filme'])) {
                                $id_filme = $_POST['id_filme'];
                                require_once 'filme_class.php';
                                $filme = new Filme();
                                $dados = $filme->devolver($id_filme);
                                
                                echo "<td><div style='margin-left: 300px; margin-top: -270px;'><h3 style='width: 300px;'>Filme devolvido com sucesso</h3></div></td>";
                            } else {
                                $id_usuario = $_SESSION['id_user'];
                                require_once 'filme_class.php';
                                $filme = new Filme();
                                $dados = $filme->buscarEmprestadosDeUsuario($id_usuario);

                                if (count($dados) == 0) {
                                    echo "<td><div style='margin-left: 300px; margin-top: -270px;'><h3 style='width: 300px;'>Você não possui devoluções pendentes</h3></div></td>";
                                } else {
                                    $posy = -350;
                                    $posx = 300;
                                    for ($i = 0; $i < count($dados); $i++) {
                                        echo getDivFilme($dados[$i]['id'], $dados[$i]['titulo'], $dados[$i]['ano'], $dados[$i]['imagem'], $posy, $posx);
                                        $posx = -350 + 380;

                                        if (($i + 1) % 3 == 0) {
                                            echo '</tr><tr>';
                                            $posy = -350 + 370;
                                            $posx = 300;
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "<td><div style='margin-left: 300px; margin-top: -270px;'><h3 style='width: 300px;'>Você precisa estar logado para fazer devolução</h3></div></td>";
                        }
                        ?>

                    </tr>
                </table>
            </div>
        </div>

    </body>
</html>