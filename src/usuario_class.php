<?php

class Usuario {

    public function __construct() {
        
        $arquivo = fopen("configuracoes.txt", "r");
        $configuracoes = fgets($arquivo);
        fclose($arquivo);
        $dados = explode(",", $configuracoes);
        
        $usuario=$dados[0];
        $senha=$dados[1];
        $host=$dados[2];
        $dbname=$dados[3];
        
        
        
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $usuario, $senha);
        } catch (PDOException $e) {
            echo "Erro com BD: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function cadastrar($email, $nome, $senha, $data_de_nascimento, $adm) {
        $cmd = $this->pdo->prepare("SELECT id from usuario WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            //cadastrar
            $cmd = $this->pdo->prepare("INSERT INTO usuario(adm, nome, email, senha, data_nasc) values (:a, :n, :e, :s, :d)");
            $cmd->bindValue(":a", $adm);
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", ($email));
            $cmd->bindValue(":s", $senha);
            $cmd->bindValue(":d", $data_de_nascimento);
            $cmd->execute();
            return true;
        }
    }
    
    public function atualizar($id_usuario, $email, $nome, $senha, $data_de_nascimento) {
        $cmd = $this->pdo->prepare("update usuario set email=:e, nome=:n, senha=:s, data_nasc=:d where id=:u");
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":s", $senha);
        $cmd->bindValue(":d", $data_de_nascimento);
        $cmd->bindValue(":u", $id_usuario);
        $cmd->execute();
        return true;
    }

    public function login($email, $senha) {
        $cmd = $this->pdo->prepare("SELECT id, nome, adm, data_nasc from usuario WHERE email = :e and senha = :s");
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":s", $senha);
        $cmd->execute();

        if ($cmd->rowCount() === 0) {
            return false;
        } else {
            $dados = $cmd->fetch();
            return $dados;
        }
    }

}

?>