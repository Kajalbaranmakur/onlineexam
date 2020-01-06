<?php session_start(); ?>

<?php 
   if(!isset($_SESSION['score'])){
       header('location:index.php');
   }
   if(!isset($_SESSION['id'])){
       header('location:login.php');
   }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online exam</title>
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
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <span class="navbar-text">
           <span> Hello <?php echo $_SESSION['username']; ?>! </span>
           <a href="index.php?logout=1" class="btn btn-outline-primary btn-sm"> Logout </a>
        </span>
      </div>
    </nav>
    <br>
     <header>
     	<div class="container">
     		<h1>Online exam</h1>          
     	</div>     	 
     </header>
     <main>
     	 <div class="container">
     	 	<h2>You,re Done !</h2>
               <p>Congrats! You have completed the test.</p>
               <p>Final score: <?php  echo $_SESSION['score']; ?></p>
               <a href="index.php?endtest=1" class="start btn btn-info">Take Again</a>
     	 </div>
     </main>
     <footer>
     	  <div class="container">
     	  	  Copyright &copy; 2019, OnlineExam
     	  </div>
     </footer>
</body>
</html>