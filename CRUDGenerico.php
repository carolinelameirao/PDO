<?php

require_once './Connection.php';

$con = getConnection();

$table = "cidade";

$search = "";

$key = "";

$filter = (!empty($key) ? "WHERE {$key} = :param" : "");

$query = "SELECT * FROM {$table} {$filter}";

$result = $con->prepare($query);

if(!empty($key)) {
$result->bindParam(":param", $search, PDO::PARAM_STR);
}

$result->execute();

foreach($result as $row)
{
    echo '<p>';
    echo $row[0] . " - " . $row[1] . " - " . $row[2];
    echo '<p>';
}

echo "<br><hr>Quantidade de cidades encontradas: {$result->rowCount()}";

$con = null;