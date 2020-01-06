<?php 
require 'config/db.php';
session_start();

$errors   = array();
$username = "";
$email    = "";

 //get total number of questions
 $query  = "SELECT * FROM questions";
 $result = $conn->query($query) or die($conn->error.__LINE__);  
 $total  = $result->num_rows;


//if user click on sign up button
if(isset($_POST['signup-btn'])){
	$username     = $_POST['username'];
	$email        = $_POST['email'];
	$password     = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];
    
	//validation
	if(empty($username)){
		$errors['username'] = "Username required";
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errors['email'] = "Email address is invalid";
	}
	if(empty($email)){
		$errors['email'] = "Email required";
	}
	if(empty($password)){
		$errors['password'] = "Password required";
	}
	if($password != $passwordConf){
		$errors['password'] = "Two password do not match";
	}

	$emailQuery = "SELECT * FROM users WHERE username = '$username'";
	$run_query_name  = mysqli_query($conn, $emailQuery);
	$userCountname  = $run_query_name->num_rows;

	if($userCountname > 0){
		$errors['username'] = "Username already exists";
	}
    
    $emailQuery = "SELECT * FROM users WHERE email = '$email'";
	$run_query  = mysqli_query($conn, $emailQuery);
	$userCount  = $run_query->num_rows;

	if($userCount > 0){
		$errors['email'] = "Email already exists";
	}

	if(count($errors) == 0){
		$password = password_hash($password, PASSWORD_DEFAULT);
		$token    = bin2hex(rand(1000, 9999)); //$token is used to verify email
		$verified = 0;
    
		$query = "INSERT INTO users(username, email, verified, password, token) 
                  VALUES('$username', '$email','$verified', '$password', '$token')";
        $run_query = mysqli_query($conn, $query);

        if($run_query){
        	//login user automatically
        	$user_id = $conn->insert_id;//id of last inserted user
        	$_SESSION['id'] = $user_id;
        	$_SESSION['username'] = $username;
        	$_SESSION['email'] = $email;
        	$_SESSION['verified'] = $verifird;

        	//set flush message
        	$_SESSION['message'] = "You are now logged in!";
        	$_SESSION['alert-class'] = "alert-success";

        	header('location:index.php');
        	exit();
        }else{    	
        	$errors['db_error'] = "Database Error : Failed to register";
        }       
	}
}

//if user clicked on login button
if(isset($_POST['login-btn'])){
	$username     = $_POST['username'];
	$password     = $_POST['password'];

    //validation
	if(empty($username)){
		$errors['username'] = "Username required";
	}
	if(empty($password)){
		$errors['password'] = "Password required";
	}
    
    if(count($errors) == 0){
	    $sql = "SELECT * FROM users 
	            WHERE username = '$username' OR email = '$username'";
	    $result  = mysqli_query($conn, $sql);
	    $userCount  = $result->num_rows;
	    if($userCount > 0){
	    	$user = $result->fetch_assoc();
	    	if(password_verify($password, $user['password'])){
	    		//log in success
            	$_SESSION['id'] = $user['id'];
            	$_SESSION['username'] = $user['username'];
            	$_SESSION['email'] = $user['email'];
            	$_SESSION['verified'] = $user['verified'];
    
            	//set flush message
            	$_SESSION['message'] = "You are now logged in!";
            	$_SESSION['alert-class'] = "alert-success";
    
            	header('location:index.php');
            	exit();
	    	}else{
	    		$errors['login-fail'] = "Wrong password";
	    	}
	    }else{
	    	$errors['login-fail'] ="You not have a account";
	    }
	}
}

//logout user
if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['id']);
	unset($_SESSION['username']);
	unset($_SESSION['email']);
	unset($_SESSION['varified']);
	header('location:login.php');
	exit();
}


//count number of question answerd
if(!isset($_SESSION['question_no'])){
	$_SESSION['question_no'] = 0;
}


//Check answer
if(isset($_POST['submit_ans'])){      

  	    //Check to see score is set or not
        if(!isset($_SESSION['score'])){
	        $_SESSION['score'] = 0;    
        }

    	$number = $_POST['number'];
    	$select_choice = $_POST['choice'];
    	$next = $number + 1;

    	//It count how many questions have submited
    	if($_SESSION['question_no'] <= $number){
    		$_SESSION['question_no']++;
    	}
        

    	//Get total number of questions
        $query  = "SELECT * FROM questions";
        $result = $conn->query($query) or die($conn->error.__LINE__);  
        $total  = $result->num_rows;


    	//if any answer ic clicked
    	if (isset($_POST['choice'])) {
    	    //Get correct answer
    	     $sql= "SELECT is_correct
    	            FROM choices 
    	            WHERE id = $select_choice" ;
             $query= $conn->query($sql) or die($conn->error.__LINE__);
             $choice = $query->fetch_assoc();
             $ans = $choice['is_correct'];

            //if answer is correct increment score            
            if($ans == 1){
            	//if iquestion is submited second times by back page then thin number is not count
            	if($_SESSION['question_no'] == $number){
            	    $_SESSION['score']++;
	            }
	        }
        }

        //if it is the last question then go to final page
        if($number == $total){   
            header('location:final.php');
            exit();
        }else{
            header('location:question.php?n='.$next);
        }
        
}

  
if(isset($_GET['endtest'])){ 
    unset($_SESSION['score']); 
    header('location:index.php'); 
    exit(); 
}
?>