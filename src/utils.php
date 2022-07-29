<?php 
function connect($db)
{
    try {
        $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}",$db['user'], $db['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $conn;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
// Obtención parametros update
function getParams($input)
{
    $filterParams =[];
    foreach ($input as $param => $value) {
        $filterParams[]= "$param=:$param";
    }
    return implode(", ",$filterParams);
}
// Asociación a una sentencia sql
function bindallValues($statement, $params){
    foreach ($params as $param => $value) {
        $statement->bindValue(':'.$param,$value);
    }
    return $statement;
}
?>