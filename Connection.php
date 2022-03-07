<?php
    define("HOST", "eanl4i1omny740jw.cbetxkdyhwsb.us-east-1.rds.amazonaws.com");
    define("USER", "z1ht98762ojytt7w");
    define("PASS", "z38v0i90wy2pskn5");
    define("DATABASE", "ayw3xm8hxht5mv7h");

    function getConnection()
    {
        try {
            $key = 'strval';
            $con = new PDO("mysql:host={$key(HOST)};dbname={$key(DATABASE)}", USER, PASS) or die("Erro ao tentar conectar no banco de dados");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $con;
        } catch (PDOException $error) {
            echo "Erro ao conectar ao banco. Erro: {$error->getMessage()}";
            exit;
        }
    }