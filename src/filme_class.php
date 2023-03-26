<?php

class Filme {

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

    public function cadastrar($titulo, $ano, $nomeImagem) {
        
        $cmd = $this->pdo->prepare("INSERT INTO filme(titulo, ano, imagem) values (:t, :a, :i)");
        $cmd->bindValue(":t", $titulo);
        $cmd->bindValue(":a", $ano);
        $cmd->bindValue(":i", $nomeImagem);
        $cmd->execute();
        
        return true;
    }

    public function buscarTodos() {
        $cmd = $this->pdo->prepare("SELECT id, titulo, ano, imagem, data_emprestimo, data_devolucao_efetiva from filme left join emprestimo on filme.id=emprestimo.id_filme and data_devolucao_efetiva is null");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    
    public function buscarTodosEmprestados() {
        $cmd = $this->pdo->prepare("SELECT id, titulo, ano, imagem, data_emprestimo, data_devolucao_prevista from filme, emprestimo where filme.id=emprestimo.id_filme and data_devolucao_efetiva is null");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    
    public function buscarEmprestadosDeUsuario($id_usuario) {
        $cmd = $this->pdo->prepare("SELECT id, titulo, ano, imagem, data_emprestimo, data_devolucao_prevista from filme, emprestimo where filme.id=emprestimo.id_filme and data_devolucao_efetiva is null and id_usuario=:u");
        $cmd->bindValue(":u", $id_usuario);
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    
    public function emprestar($id_usuario, $id_filme, $data_emprestimo, $data_devolucao) {
        
        $cmd = $this->pdo->prepare("INSERT INTO emprestimo(id_usuario, id_filme, data_emprestimo, data_devolucao_prevista) values (:u, :f, :e, :d)");
        $cmd->bindValue(":u", $id_usuario);
        $cmd->bindValue(":f", $id_filme);
        $cmd->bindValue(":e", $data_emprestimo);
        $cmd->bindValue(":d", $data_devolucao);
        $cmd->execute();
        return true;
    }
    
    public function devolver($id_filme) {
        
        $cmd = $this->pdo->prepare("update emprestimo set data_devolucao_efetiva=now() where id_filme=:f");
        $cmd->bindValue(":f", $id_filme);
        $cmd->execute();
        return true;
    }

}

?>