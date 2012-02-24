<?php
    
    require_once 'pwsd.php';
    
    #$name = htmlEntities(stripslashes($_POST["username"]), ENT_QUOTES);
    #$content = htmlEntities(stripslashes($_POST["comment"]), ENT_QUOTES);;
    
    #$macAddr = $_POST["MAC"];
    $targetID = "";
    $pushID = "pushID";
    
    #echo $pushID;
    
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
    
    function getID() {
        
        $getID_query = $GLOBALS["getID_query"];
        $pushID = $GLOBALS["pushID"];
        
        # sql_query
        $getID_query->execute(array($pushID));
        
        if ($row = $getID_query->fetch()) { // only [need] one row
            return $row['target_id'];
            
        }
        else {
            return null;
        }
    }
    
    if ($rtn = getID()) {   // found targetID. Should continue pulling data
        $targetID = $rtn;
        
        
    }
    else {  // register new device
        # prepare INSERT: register device with push_id
        $regID_insert = $dbh->prepare("insert into ID (target_id, push_id, time) values (NULL, ?, NULL)");
        $regID_insert->execute(array($pushID));
        
        if ($rtn = getID()) {
            $targetID = $rtn;
        }
        else {
            echo "registration failed";
        }
    }
    
    echo $targetID;
?>