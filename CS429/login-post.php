<?php
    
    // Assume these info are valid!
    
    $username = $_POST["username"];
    $password = $_POST["password"];
//    $firstname = $_POST["firstname"];
//    $lastname = $_POST["lastname"];
//    $position = $_POST["position"];
//    $privilege = $_POST["privilege"];
//    $email = $_POST["email"];
//    $companyId = $_POST["companyId"];
    
    try {
        $dbh = new PDO("mysql:host=suresh2.projects.cs.illinois.edu;dbname=suresh2_schedulerApp", "suresh2_cs428", "cs428");
        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOexception $e) {
        echo 'Could not connect: ' . $e->getMessage();
}
//    
//    $regUser_insert = $dbh->prepare("insert into users (FirstName, LastName, Position, Privilege, UserId, Email) values (?, ?, ?, ?, ?, ?)");
//    
//    $regReg_insert = $dbh->prepare("insert into registration (UserId, CompanyId, username, password) values (?, ?, ?, ?)");
//    
//    try {
//        $regUser_insert->execute(array($firstname, $lastname, 0, 0, NULL, $email));
//    }
//    catch (PDOexception $e) {
//        echo 'Could not insert to Users: ' . $e->getMessage();
//    }
    
    $getId_query = $dbh->prepare("select userId from registration where username=? and password=?");
    
    function getID() {
        
        $getID_query = $GLOBALS["$getId_query"];
        $username = $GLOBALS["username"];
        $password = $GLOBALS["password"];
        
        # sql_query
        $getID_query->execute(array($username, $password));
        
        if ($row = $getID_query->fetch()) { // only [need] one row
            return $row['UserId'];
        }
        else {
            return null;
        }
    }
    
    if ($userID = getID()) {   // found targetID. Should continue pulling data
        
        $getFirstName_query = $dbh->prepare("select FirstName from users where userid=?");
        $getFirstName_query->execute(array($userID))
        while ($row = $getFirstName_query->fetch()) {	# each RECENT entry in MESSAGE table
            $fname = $row['FirstName'];
            echo "Hi" . $fname;
        }
        
    }
?>