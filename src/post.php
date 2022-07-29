<?php
include 'config.php';
include 'utils.php';

$dbCon = connect($db);
// Listar todos los post
if($_SERVER['REQUEST_METHOD']=='GET' ){
    if(isset($_GET['id'])){
        $sql= $dbCon->prepare("SELECT * FROM post WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header('HTTP/1.1 200 OK');
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }else{
        $sql= $dbCon->prepare("SELECT * FROM post");
        $sql->execute(); 
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($sql->fetchAll());
        exit();
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' ){
    $input=$_POST;
    $sql="INSERT INTO post (`title`, `status`, `content`, `user_id`) VALUE (:title, :statu, :content, :userid)";
    $statement = $dbCon->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbCon->lastInsertId();
    if($postId){
        $input['id']=$postId;
        header('HTTP/1.1 200 OK');
        echo json_encode($input);
        exit();
    }
}
if($_SERVER['REQUEST_METHOD']=='DELETE'){
    $id = $_GET['id'];
    $statement = $dbCon->prepare("DELETE FROM post WHERE id=:id");
    $statement->bindValue(':id',$id);
    $statement->execute();
    exit();
}
if($_SERVER['REQUEST_METHOD']=='PUT'){
    $input = $_GET;
    $postId = $input['id'];
    $fields = getParams($input);
    $sql = "UPDATE post SET $fields WHERE id=$postId";
    $statement = $dbCon->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    header('HTTP/1.1 200 OK');
    exit();
}


?>