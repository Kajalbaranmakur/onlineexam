<?php session_start(); ?>

<?php 
   if(!isset($_SESSION['score'])){
       header('location:question.php?n=1');
   }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online exam</title>
	<?php include "links.php"; ?>
</head>
<body>
     <header>
     	<div class="container">
     		<h1>Online exam</h1>          
     	</div>     	 
     </header>
     <main>
     	 <div class="container">
     	 	<h2>You,re Done !</h2>
               <p>Congrats! You have completed the test.</p>
               <p>Final score: <?php  echo $_SESSION['score'] ?></p>
               <a href="question.php?n=1" class="start btn btn-info">Take Again</a>
     	 </div>
     </main>
     <footer>
     	  <div class="container">
     	  	  Copyright &copy; 2019, OnlineExam
     	  </div>
     </footer>
</body>
</html>
<?php session_destroy(); ?>