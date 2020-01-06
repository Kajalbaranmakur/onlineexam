<?php include 'database.php' ?>
<?php 
   //Get total number of questions
   $query  = "SELECT * FROM questions";
   $result = $connection->query($query) or die($connection->error.__LINE__);  
   $total  = $result->num_rows;

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
     	 	<h2>Mock test</h2>
               <p>This is a multiple choice quiz to test your knowledge in aptitude</p>
               <ul>
                    <li><strong>Number of questions : </strong> <?php echo $total ; ?></li>
                    <li><strong>Type : </strong> Multiple choice</li>
                    <li><strong>Estimated time</strong> <?php echo $total * .5; ?> minute</li>
               </ul>
               <a href="question.php?n=1" class="btn btn-info">Start test</a>
     	 </div>
     </main>
     <footer>
     	  <div class="container">
     	  	  Copyright &copy; 2019, OnlineExam
     	  </div>
     </footer>
</body>
</html>