<!DOCTYPE html>
<html>
 <head> 
	<meta charset="utf-8">
	<link href="css/estilo.css" rel="stylesheet" >
	<title>Biblioteca</title>
 </head>
  

<body>
 <img src= "imagens/img10.jpg" width="250" height="300"  id="turmaghibli"/>

 
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
            if(isset($_SESSION['nome']))
            {
                echo "<h4><strong>&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp Olá, ".$_SESSION['nome']."</strong></h4>";
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
		$form = get_form();
				
		if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['data_de_nascimento']) && isset($_POST['senha']))
		{
			if($_POST['nome']=="" || $_POST['email']=="" || $_POST['senha']=="")
			{
				echo "<text><h3>Preencha todos os campos</h3></text>";
				echo $form;
			}
			else
			{
				$email = $_POST['email'];
				$nome = $_POST['nome'];
				$senha = $_POST['senha'];
				$data_de_nascimento = $_POST['data_de_nascimento'];
                                $adm = false;
                                
                                if(isset($_POST['adm']) && $_POST['adm'] == "on")
                                {
                                    $adm=true;
                                }
				
                                
                                require_once 'usuario_class.php';
                                $usuario = new Usuario();
                                if($usuario->cadastrar($email, $nome, $senha, $data_de_nascimento, $adm))
                                {
                                    echo "<text><h3>Cadastrado com sucesso</h3></text>";
                                }
                                else
                                {
                                    echo "<text><h3>Erro! Cadastro já existente</h3></text>";
                                }
                                
			}
		}
		else
		{
			echo $form;
		}
                
                
                function get_form()
                {
                    return '<form action="novo_cadastro.php" method="post" name="novo_cadastro" class="center">
					<field><text class="center"><h2>Cadastro<h2></text>
					<h4>Nome completo:</h4>
					<br>
					<input type= "name" name="nome" placeholder="Nome completo">
					<br>
					<h4>Seu email:</h4>
					<input type= "email" name="email" placeholder="Digite seu email">
					<br>
					<h4>Data de Nascimento:</h4>
					<input type="date" id="start" name="data_de_nascimento" value="2018-07-22" min="1950-01-01" max="2020-01-01">
					<h4>Senha:</h4>
					<input type= password id="formNome" name="senha" maxlength="15" placeholder="máximo 15 caracteres">
					<p>
                                        <input type="checkbox" id="adm" name="adm">
                                        <label for="scales">Administrador</label>
                                        <p>
					<input type="submit" value="Cadastrar">
				</form>';
                }
	
	
	?>
	
	
</div>

</body>
</html>