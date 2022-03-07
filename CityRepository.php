<?php

    require_once './Connection.php';

    function create($cidade)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("INSERT INTO cidade(nome_cidade, sigla_uf) VALUES (:nome, :uf)");

            $stmt->bindParam(":nome", $cidade->nome);
            $stmt->bindParam(":uf", $cidade->uf);

            if($stmt->execute())
                echo "Cidade cadastrada com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao cadastrar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

        /*
        bindValue -> aceita valores literais
        bindParam -> Só aceita valores passados por referência (variáveis)
        */

    ## Teste do create
    /*$cidade = new stdClass();
    $cidade->nome = "Rio de Janeiro";
    $cidade->uf = "RJ";
    create($cidade);
    echo "<br><br>---<br><br>";*/

    function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT nome_cidade, sigla_uf FROM cidade");
                    
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome_cidade . "<br>";
                echo $row->sigla_uf . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar as cidades. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
                unset($rs);
        }
    }

    ## Teste do get
    //get();
   
    function find($nome)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT nome_cidade, sigla_uf FROM cidade WHERE nome_cidade LIKE :nome");
            $stmt->bindValue(":nome", "%{$nome}%");

            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome_cidade . "<br>";
                        echo $row->sigla_uf . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    ## Teste do find
    //find("");

    function update($cidade)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE cidade SET nome_cidade = :nome, sigla_uf = :uf WHERE cod_cidade = :codigo");
            
            $stmt->bindParam(":codigo", $cidade->codigo);
            $stmt->bindParam(":nome", $cidade->nome);
            $stmt->bindParam(":uf", $cidade->uf);

            if($stmt->execute())
                echo "Cidade atualizada com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    /*get();
    echo "<br><br>---<br><br>";

    ## Teste do update
    $cidade = new stdClass();
    $cidade->nome = "Macae";
    $cidade->uf = "RJ";
    $cidade->codigo = 2;
    update($cidade);

    echo "<br><br>---<br><br>";

    get();*/
    
    function delete($codigo)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM cidade WHERE cod_cidade = ?");
            
            $stmt->bindValue(1, $codigo);

            if($stmt->execute())
                echo "Cidade deletada com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    /*get();
    echo "<br><br>---<br><br>";

    ## Teste do delete
    delete(3);

    echo "<br><br>---<br><br>";
    get();*/
