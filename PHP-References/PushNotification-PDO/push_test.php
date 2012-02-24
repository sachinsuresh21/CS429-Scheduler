<?php
    
    // set_time_limit(0);
    
    $apnHost = 'ssl://gateway.sandbox.push.apple.com:2195';
    
    // connect to push server
    $context = stream_context_create();
    stream_context_set_option($context, 'ssl', 'local_cert', 'apns-dev.pem');
    $connection = stream_socket_client($apnHost, $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context);
    
    print "connected to APN\n";
    
    while (true) {
        
        $deviceToken = '5a38b963 ac336ede 296d9cb8 4ecfd7b1 f81ad781 9d9e6d37 59ef75fc f00363c9';
        
        echo "Type to continue\>";
        fgets(STDIN);
        $message = "help me power on"; #trim(fgets(STDIN)); // reads line from STDIN
        $badge = 1; // $argv[2]    // any number
        $sound = 'default';
        
        $payload = array();
        $payload['aps'] = array();
        $payload['aps']['alert'] = $message;
        $payload['aps']['badge'] = $badge;
        $payload['aps']['sound'] = $sound;
        
        $payload['wake'] = array();
        $payload['wake']['targetID'] = "000001";
        $payload['wake']['MAC'] = "0013D59ACC";
        
        $payload = json_encode($payload);
        
        // Command 0, Token length 0-32, deviceToken 0-32
        // 'n' format: 16 bit & big endian
        // 'H*': hexadecimal string
        $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
        
        echo "pushed to APN\n";
        
        fwrite($connection, $msg); // push message to APNS
        
        // sleep(60);
    }
    
?>