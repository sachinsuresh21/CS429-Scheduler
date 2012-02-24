<?php
    
    require_once 'pwsd.php';
    
    #$name = htmlEntities(stripslashes($_POST["username"]), ENT_QUOTES);
    #$content = htmlEntities(stripslashes($_POST["comment"]), ENT_QUOTES);;
    
    $macAddr = $_POST["MAC"];
    $targetID = $_POST["targetID"];
    
    if (!$targetID || !$macAddr) {
        
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
    
    # prepare SELECT: lookup target_id with push_id
    $getID_query = $dbh->prepare("select target_id from ID where push_id=?");
    
    #
    
    # prepare INSERT: register device with push_id
    $regID_insert = $dbh->prepare("insert into MESSAGE (time, MAC, target_id) values (NULL, ?, ?)");
    $regID_insert->execute(array($macAddr, $targetID));
    
    echo "InterWake Request Sent";
    
?>