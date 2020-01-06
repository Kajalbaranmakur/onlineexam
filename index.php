<?php 
require "controller/authController.php" ;
if(!isset($_SESSION['id'])){
     header('location:login.php');
     exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<?php include "links.php"; ?>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Onlineexam</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="viewquestions.php">View Questions Answer <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <span class="navbar-text">
           <span> Hello <?php echo $_SESSION['username']; ?>! </span>
           <a href="index.php?logout=1" class="btn btn-outline-primary btn-sm"> Logout </a>
        </span>
      </div>
    </nav>

  <!--  print sucessfully loged in -->
      <?php if(isset($_SESSION['message'])){; ?>
          <div class="alert text-center <?php echo $_SESSION['alert-class']; ?>">
              <?php 
                 echo $_SESSION['message'];
                 unset($_SESSION['message']);
                 unset($_SESSION['alert-class']);
              ?>        
          </div>
      <?php }; ?>
      <br>
    
     <main>
       <div class="container">
        <h2>Mock test</h2>
               <p>This is a multiple choice quiz to test your knowledge in aptitude</p>
               <ul>
                    <li><strong>Number of questions : </strong> <?php echo $total ; ?></li>
                    <li><strong>Type : </strong> Multiple choice</li>
                    <li><strong>Estimated time</strong> <?php echo $total * .5; ?> minute</li>
               </ul>
               <a href="question.php?n=1" class="btn btn-info">Start test</a>
       </div>
     </main><br>
     <footer>
        
     </footer>
</body>
</html>