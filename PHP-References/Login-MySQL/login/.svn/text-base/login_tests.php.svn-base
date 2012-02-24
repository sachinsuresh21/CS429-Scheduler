<?php

// document root is "/home/cs/zhagui1/public_html"
require_once($_SERVER['DOCUMENT_ROOT'].'/ScheduleMee/login.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ScheduleMee/simpletest/autorun.php'); 

class TestOfLoggingIn extends UnitTestCase {
    function testInvalidSignIn() 
    {
    	$_POST['user_name'] = "";
    	$_POST['user_pwd'] = "";
    	
    	$errors = setUpErrors();
    	
    	$errorstring = implode($errors);
    	$invalidname = "The username field was empty! Enter a valid one!";
    	$invalidpwd = "A password field was empty! Enter a valid one!";
    
    	$isnamevalid = strpos($errorstring, $invalidname);
    	$ispwdvalid = strpos($errorstring, $invalidname);
    	
    	 	
    	$result = ( $isnamevalid === false || $ispwdvalid ===false) ? false:true;
    
        $this->assertTrue($result);
    }
    
    function testInvalidUsername() 
    {
    	$_POST['user_name'] = "%%%%%$$$";
    	$_POST['user_pwd'] = "";
    	
    	$errors = setUpErrors();
    	
    	$errorstring = implode($errors);
    	$invalidname = "The username can only contain letters and digits.";
    
    	$isnamevalid = strpos($errorstring, $invalidname);    	
    	 	
    	$result = ( $isnamevalid === false)? false:true;
    
        $this->assertTrue($result);
    }
    
    function testInvalidPasswords() 
    {
    	$_POST['user_name'] = "vgz";
    	$_POST['user_pass'] = "ilovecs";
    	$_POST['user_pass_check'] = "not373";
    	
    	$errors = setUpErrors();
    	
    	$errorstring = implode($errors);
    	$mismatched = "The two passwords did not match.";
    
    	$ismismatched = strpos($errorstring, $mismatched);    	
    	 	
    	$result = ( $isnamevalid === false)? false:true;
    
        $this->assertTrue($result);
    }
    
    function testInvalidUser() 
    {
    	$name = "batman";
    	$pwd = "robin";
    	$result = signIn($name, $pwd);    
        $this->assertFalse($result);
    }
    
    function testValidRegistration() 
    {
    	$name = "superman";
    	$pwd = "loislane";
    	$result = signUp($name, $pwd);    
        $this->assertTrue($result);
    }
    
}

?>

