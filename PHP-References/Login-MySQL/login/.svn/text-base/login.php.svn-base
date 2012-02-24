<?php

include '../connect.php';

echo '<h3>Sign in</h3>';  

function checkLoggedIn()
{
	//Checking if the user is already signed in, if they are then they could just signout
	return $loggedIn = (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) ? true : false;
}  

function checkPostRequest()
{
	return $bool = ($_SERVER['REQUEST_METHOD'] != 'POST') ? false: true;	
}

function setUpErrors()
{
	$errors_arr = array();
	//if the username wasnt set then 
        if(!isset($_POST['user_name'])  )  
        {  
            $errors_arr[] = 'The username field was empty! Enter a valid one!';  
	} 
	else
	{
		//checks for invalid chars using the ctype_alnum() func
		if(!ctype_alnum($_POST['user_name']))
		{  
			$errors_arr[] = 'The username can only contain letters and digits.';  
		}

		//checks if the username is longer than 20 characters
		if(strlen($_POST['user_name']) > 20)  
		{
			$errors_arr[] = 'The username cannot be longer than 20 characters.';
		}		
	}
  	
	// if the password field was set
	if(!isset($_POST['user_pass'])|| !isset($_POST['user_pass_check']) )  
        {  
            $errors_arr[] = 'The password field was empty! Enter a valid one!';  
	}
	else
	{
		//check to make sure that both passwords match
		if($_POST['user_pass'] != $_POST['user_pass_check'])
	      	{  
			$errors_arr[] = 'The two passwords did not match.';  
		} 
		
	}

	return $errors_arr;

}

function signUp($user_name, $user_pwd)
{
	//encode both the username and the pwd
	$username = mysql_real_escape_string($user_name);
	$userpwd = sha1($user_pwd);

	//the form has been posted without errors, so save it 
	//using mysql_real_escape_string to prevent sql injection 
	//the php funct sha1 hashes the password
	$sql = "INSERT INTO users(user_name, user_pass, user_homepage)
		VALUES('" . mysql_real_escape_string($_POST['user_name']) . "', 
                       '" . sha1($_POST['user_pass']) . "', 'Make Homepage!')";  
  	$result = mysql_query($sql);  
	
	if(!$result)  
        {  
		die('An error occured: '.mysql_error());
	} 
	    
	else
	{ 
		echo 'Success! You can now <a href="signin.php">sign in</a> and make flashcards!'; 
	} 
}

function signIn($user_name, $user_pwd)
{
	//encode both the username and the pwd
	$username = mysql_real_escape_string($user_name);
	$userpwd = sha1($user_pwd);

	//the form has been posted without errors, so save it 
	//using mysql_real_escape_string to prevent sql injection 
	//the php funct sha1 hashes the password 
	$sql = "SELECT user_id, user_name 
		FROM users 
		WHERE user_name = '" . $username."'
		AND user_pass = '" . $userpwd. "'"; 
			
	$result = mysql_query($sql);  
	if(!$result)  
	{  
		die( 'Sign in failed!. Please try again.'.mysql_error()); 
	} 

	else 
	{ 
		//if result is empty then that means that the user doesnt exist yet
		//or that the password and username dont match up correctly
		if(mysql_num_rows($result) == 0) 
		{ 
			echo 'You entered either a wrong user name or password!'; 
		} 
			
		//user exists so we set variables to reflect that the user is signed in
		else 
		{ 
			//using php's session array to pass information of the user's current session
			//set the 'signed_in' variable to true which is checked up above
			//also set other variables that we will use into the session array
			$_SESSION['signed_in'] = true; 
			
			while($row = mysql_fetch_assoc($result)) 
			{ 
				$_SESSION['user_id'] = $row['user_id']; 
				$_SESSION['user_name'] = $row['user_name'];
			} 
			
			echo 'Hello, '.$_SESSION['user_name'].'.<a href="/flashcards/home.php">Your Homepage!</a>.'; 
		} 
	} 
		
}

function continueProcess()
{  
	$isPost = checkPostRequest();
	if($isPost)
	{
		//now the form has been posted and we will check the data they inputted
		//spitting any errors in their inputs
		//then we try to query the user table in our database to see if the user exists
		//the errors array will output any errors in the user's input which was submitted    
		$errors = setUpErrors();
		if(!empty($errors))
		{
			echo 'There were errors in entering your information!'; 
			echo '<ul>'; 
			//displaying the errors as a list
			foreach($errors as $key => $value)
			{ 
				echo '<li>' . $value . '</li>';
			} 
	    		echo '</ul>'; 
		}

		//no errors continue with either signing in or signing up
		else
		{
			$whatDo = $_POST['whichprocess'];
			if($whatDo == 'signin')
				signIn($_POST['user_name'], $_POST['user_pass']);
			else
				signUp($_POST['user_name'], $_POST['user_pass']);
		}
	}

	// Information hasnt been posted yet so post it	
	else
		echo '<form method="post" action="">  
			Username: <input type="text" name="user_name"/> <br/>  
			Password: <input type="password" name="user_pass"> <br/>
			Retype Password: <input type="password" name="user_pass_check"> <br/>
			<input type="radio" name="whichprocess" value="signin" checked="checked" /> Signing In?<br />
			<input type="radio" name="whichprocess" value="signup" /> Registering new user!		       	
			<input type="submit" value="Submit!" />  
			</form>';

}

$issignedin = checkloggedin();
if($issignedin)
	echo 'you are already signed in! <br/> you can <a href="/signout.php">sign out</a> if you want.';
else
	continueProcess();

?>  

