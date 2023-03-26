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
            
            if(isset($_SESSION['nome']))
            {
                echo "<h4><strong>&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp Olá,".$_SESSION['nome']."</strong></h4>";
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
			$form = '<form action="login.php" method="post" name="formulario" class="center">
					<text class="center"><h2>Login<h2></text>
					<input type= "email" name="email" placeholder="Digite seu email">
					<br>
					<h4>Senha:</h4>
					<input type= password id="formNome" name="senha" maxlength="15" placeholder="máximo 15 caracteres"/>
					<br>
					<p>
					<input type="submit" value="Entrar">
					</p>
					<h3> Não tenho cadastro:</h3>
					<p>
					<a href= "novo_cadastro.php"target="_self">Cadastre aqui </a>
					
				   </form>';
				   
			echo '';
			if(isset($_POST['email'])){
                            
				$user=$_POST['email'];
				$senha=$_POST ['senha'];
				
				require_once 'usuario_class.php';
                                $usuario = new Usuario();
                                
                                $dados = $usuario->login($user, $senha);
                                
				
				if ($dados == false)
				{
					echo "<text><h3>Usuário/Senha incorretos</h3></text>";
					echo $form;
				}
				else
				{
					echo "<text><h3>Login realizado com sucesso!</h3></text >";
                                        echo "<text><h3> Bem vindo(a), $dados[1]</h3></text >";
                                        
                                        if ($dados[2]>0)
                                        {
                                            echo "<text><h3> Administrador: Sim</h3></text >";
                                        }
                                        else
                                        {
                                            echo "<text><h3> Administrador: Não</h3></text >";
                                        }
                                        
                                        
                                        $_SESSION['id_user'] = $dados[0];
                                        $_SESSION['nome'] = $dados[1];
                                        $_SESSION['adm'] = $dados[2];
                                        $_SESSION['data_nasc'] = $dados[3];
                                        $_SESSION['email'] = $user;
                                        $_SESSION['senha'] = $senha;
                                        
                                        if(isset($_COOKIE[$_SESSION['id_user']]))
                                        {
                                            $_SESSION['ultimo_acesso'] = $_COOKIE[$_SESSION['id_user']];
                                        }
                                        
                                        $agora = date('d/m/Y H:i:s');
                                        setcookie($_SESSION['id_user'], $agora, time()+60*60*60);
                                        
                                        
				}
				
			}
			else
			{
				echo "<text><h3>Faça seu login </h3></text>";
				echo $form;
			}
			
			
		?>
		
</div>
</body>
</html>