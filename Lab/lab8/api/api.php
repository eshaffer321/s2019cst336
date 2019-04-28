<?php

    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("lab8");
    
    $sql = "";
    
    if($_GET["action"] == "getFavorites"){
        $sql = "SELECT * FROM liked";
    }
    else if($_GET["action"] == "like"){
        $sql = "INSERT INTO liked (link) VALUES ('" . $_GET["url"] . "')";
    }
    else if($_GET["action"] == "unlike"){
        $sql = "DELETE FROM liked WHERE link='" . $_GET["url"] . "'";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($records);
?>