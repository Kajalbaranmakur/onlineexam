<?php require "controller/authController.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<?php include "links.php"; ?>
</head>
<body>
     <div class="container">
     	<div class="row">
     		<!-- col-md-4 is set width of the div (col-md-*), and offset-md-4 to put it in middle position -->

     		<div class="form-div col-md-4 offset-md-4">
     		    <form method = "post" action="signup.php">
     		    	
                    <h3 class="text-center header"> Register </h3>
                    <?php if(isset($errors['db_error'])){ ;?> 
     		        	<div class="alert-danger alert">
     		    		    <?php echo $errors['db_error'];?>
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
     		        	<label for="email">Email</label>
     		        	<input type="email" name="email" class="form-control from-control-lg" value="<?php echo $email; ?>">
     		        	<?php if(isset($errors['email'])){ ;?> 
     		        	<div class="text-danger">
     		    		    <?php echo $errors['email'];?>
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
     		        	<label for="passwordConf">Confirm Password</label>
     		        	<input type="password" name="passwordConf" class="form-control from-control-lg">
     		        </div>
                    <div class="form-group">
                    	<button type="submit" name="signup-btn" class="btn btn-info btn-block btn-lg">Sign Up</button>
                    </div>
                    <p class="text-center">Already a member? <a href="login.php">Log In</a></p>
                </form>	
     		</div>
     	</div>
     </div>

</body>
</html>
