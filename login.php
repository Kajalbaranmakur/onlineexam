<?php require "controller/authController.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<?php include "links.php"; ?>
</head>
<body>
     <div class="container">
     	<div class="row">
     		<!-- col-md-4 is set width of the div (col-md-*), and offset-md-4 to put it in middle position -->
     		<div class="col-md-4 offset-md-4 form-div login">
     		   <form method = "post" action="login.php">
     		    	<h3 class="text-center"> Login </h3>
                     
                    <?php if(isset($errors['login-fail'])){ ;?> 
                         <div class="alert-danger alert">
                             <?php echo $errors['login-fail'];?>
                        </div> 
                    <?php }; ?> 
     		       
     		     <div class="form-group">
     		        	<label for="username">Username</label>
     		        	<input type="text" name="username" class="form-control from-control-lg" value="<?php echo $username; ?>">
                         <?php if(isset($errors['username'])){ ;?> 
                         <div class="text-danger">
                             <?php echo $errors['username'];?>
                        </div> 
                        <?php }; ?> 
     		     </div>
     		     <div class="form-group">
     		        	<label for="password">Password</label>
     		        	<input type="password" name="password" class="form-control from-control-lg">
                         <?php if(isset($errors['password'])){ ;?> 
                         <div class="text-danger">
                             <?php echo $errors['password'];?>
                        </div> 
                        <?php }; ?>
     		     </div>
                    <div class="form-group">
                    	<button type="submit" name="login-btn" class="btn btn-info btn-block btn-lg">Log In</button>
                    </div>
                    <p class="text-center">Not yet a member? <a href="signup.php">Sign Up</a></p>
                </form>	
     		</div>
     	</div>
     </div>

</body>
</html>