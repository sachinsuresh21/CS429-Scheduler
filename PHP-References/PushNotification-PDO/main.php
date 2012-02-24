<?php
    
    // set_time_limit(0);
    
    // connect to DB
    require_once 'pwsd.php';    // file omitted
    
    try {
        $dbh = new PDO("mysql:host=nchen10.projects.cs.illinois.edu;dbname=nchen10_push", $user, $password);
    }
    catch (PDOexception $e) {
        echo 'Could not connect: ' . $e->getMessage();
    }
    
    # prepare SELECT: lookup target_id with push_id
    $getMsg_query = $dbh->prepare("select MAC, target_id from MESSAGE where time > DATE_SUB(Now() ,INTERVAL 5 SECOND)");
    $getToken_query = $dbh->prepare("select push_id from ID where target_id=?");
    
    // connect to Apple Push Notification Server
    
    $apnHost = 'ssl://gateway.sandbox.push.apple.com:2195';
    
    // connect to server
    $context = stream_context_create();
    stream_context_set_option($context, 'ssl', 'local_cert', 'apns-dev.pem');
    $connection = stream_socket_client($apnHost, $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context);
    
    print "connected to APN\n";
    
    while (true) {
        
        // look up in DB_MESSAGE
        $getMsg_query->execute();
        
        while ($row = $getMsg_query->fetch()) {	# each RECENT entry in MESSAGE table
            
            $id = $row['target_id'];
            $getToken_query->execute(array($id));
            
            $deviceToken = '';
            if ($pushRow = $getToken_query->fetch()) { // only [need] one row
                $deviceToken = $pushRow['push_id'];
            }
            else {
                print "push_id missing for ID:" . $id . "\n";
                continue;
            }
        
            // prepare JSON
            
            $MAC = $row['MAC'];
            
            $message = $id . ": Wake My Computer";
            $badge = 1; // $argv[2]    // any number
            $sound = 'default';
            
            $payload = array();
            $payload['aps'] = array();
            $payload['aps']['alert'] = $message;
            $payload['aps']['badge'] = $badge;
            $payload['aps']['sound'] = $sound;
            
            $payload['wake'] = array();
            $payload['wake']['targetID'] = str_pad((int) $id, 6, "0", STR_PAD_LEFT);
            $payload['wake']['MAC'] = $MAC;
            
            $payload = json_encode($payload);
            
            // Command 0, Token length 0-32, deviceToken 0-32
            // 'n' format: 16 bit & big endian
            // 'H*': hexadecimal string
            $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
            
            echo "pushed to APN\n";
            
            fwrite($connection, $msg); // push message to APNS
        }
        
        print "sleeping\n";
        sleep(5);
    }
    
?>