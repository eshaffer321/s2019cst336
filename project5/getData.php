<?php

    include 'dbConn.php';
    
    $sql = "SELECT * FROM up_files";
    
    $stmt = $Conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($records);
?>