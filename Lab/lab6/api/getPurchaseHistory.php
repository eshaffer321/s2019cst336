<?php
    
    include '../dbConnection.php'; //Default
    $conn = getDatabaseConnection("ottermart"); //Default
    
    /*
    Since we know that we will be sending the productId from our history link to the API,
    we can make a SQL statement like so :
    */
    
    $productId = $_GET['productId'];
    $sql = "SELECT *
            FROM om_product
            NATURAL JOIN om_purchase
            WHERE productId = :pId";
    $np = array();// Named Parameters
    $np[':pId'] = $productId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>