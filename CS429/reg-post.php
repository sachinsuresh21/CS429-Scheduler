<?php
    
    // Assume these info are valid!
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $position = $_POST["position"];
    $privilege = $_POST["privilege"];
    $email = $_POST["email"];
    $companyId = $_POST["companyId"];
    
    try {
        //$dbh = new PDO("mysql:host=nchen10.projects.cs.illinois.edu;dbname=nchen10_push", $user, $password);
        $dbh = new PDO("mysql:host=suresh2.projects.cs.illinois.edu;dbname=suresh2_schedulerApp", "suresh2_cs428", "cs428");
        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOexception $e) {
        echo 'Could not connect: ' . $e->getMessage();
    }
    
    $regUser_insert = $dbh->prepare("insert into users (FirstName, LastName, Position, Privilege, UserId, Email) values (?, ?, ?, ?, ?, ?)");
    
    $regReg_insert = $dbh->prepare("insert into registration (UserId, CompanyId, username, password) values (?, ?, ?, ?)");
    
    try {
        $regUser_insert->execute(array($firstname, $lastname, 0, 0, NULL, $email));
    }
    catch (PDOexception $e) {
        echo 'Could not insert to Users: ' . $e->getMessage();
    }
    
    $getId_query = $dbh->prepare("select userId from users where email=?");
    
    function getID() {
        
        $getID_query = $GLOBALS["$getId_query"];
        $email = $GLOBALS["email"];
        
        # sql_query
        $getID_query->execute(array($email));
        
        if ($row = $getID_query->fetch()) { // only [need] one row
            return $row['UserId'];
        }
        else {
            return null;
        }
    }
    
    if ($userID = getID()) {   // found targetID. Should continue pulling data
        
        try {
            $regReg_insert->execute(array($userID, NULL, $username, $password));
        }
        catch (PDOexception $e) {
            echo 'Could not insert to Reg: ' . $e->getMessage();
        }
        
    }
    
    $getFirstName_query = $dbh->prepare("select FirstName from users where email=?");
    $getFirstName_query->execute(array($email))
    while ($row = $getFirstName_query->fetch()) {	# each RECENT entry in MESSAGE table
        $fname = $row['FirstName'];
        echo $fname;
    }
    
?>