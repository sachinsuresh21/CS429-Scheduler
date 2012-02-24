<?php
    
    require_once 'pwsd.php';
    
    #$name = htmlEntities(stripslashes($_POST["username"]), ENT_QUOTES);
    #$content = htmlEntities(stripslashes($_POST["comment"]), ENT_QUOTES);;

    $targetID = "";
    $pushID = $_POST["pushID"];
    #$pushID = $_GET['pushID'];  // debug ONLY
    
    if (!$pushID) {
        echo "ERROR";
        return;
    }
    
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
    $getMsg_query = $dbh->prepare("select MAC from MESSAGE where target_id=? ORDER BY time DESC");
    $delReq_query = $dbh->prepare("delete from MESSAGE where target_id=?");
    
    # get target_id
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
    
    $retJSON = array();
    
    if ($rtn = getID()) {   // found targetID. Should continue pulling data
        $targetID = $rtn;
        
        $retJSON['targetID'] = $targetID;
        $getMsg_query->execute(array($targetID));
        
        if ($row = $getMsg_query->fetch()) {   // only return most recent request
            $retJSON['MAC'] = $row['MAC'];
            $delReq_query->execute(array($targetID));
        }
        
    }
    else {  // register new device
        # prepare INSERT: register device with push_id
        $regID_insert = $dbh->prepare("insert into ID (target_id, push_id, time) values (NULL, ?, NULL)");
        $regID_insert->execute(array($pushID));
        
        if ($rtn = getID()) {
            $retJSON['targetID'] = $rtn;
        }
        else {
            echo "registration failed";
        }
    }
    
    echo json_encode($retJSON);
?>