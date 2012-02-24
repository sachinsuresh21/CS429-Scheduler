<?php
    
    require_once 'pwsd.php';
    
    $targetID = $_POST["targetID"];
    
    if (!$targetID) {
        
        echo "ERROR";
        return;
    }
    
    # connect to db
    try {
        $dbh = new PDO("mysql:host=nchen10.projects.cs.illinois.edu;dbname=nchen10_push", $user, $password);
    }
    catch (PDOexception $e) {
        echo 'Could not connect: ' . $e->getMessage();
    }
    
    # prepare DELETE
    $delReq_query = $dbh->prepare("delete from MESSAGE where target_id=?");
    
    $delReq_query->execute(array($targetID));
    
    echo "deleted";
    
    ?>