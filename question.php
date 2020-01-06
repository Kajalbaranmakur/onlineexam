<?php include 'database.php' ?>

<?php 
    //Set question number
    $number = (int) $_GET['n'];
    
    //Get questions
    $query = "SELECT * FROM questions WHERE question_number = $number";
    $run_query = $connection->query($query) or die($connection->error.__LINE__);
    $questions = $run_query->fetch_assoc();

    //Get choice
    $query = "SELECT * FROM choices WHERE question_number = $number";
    $choices = $connection->query($query) or die($connection->error.__LINE__);

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
     	 	<div class="current" >Question <?php echo $questions['question_number'] ?> to <?php echo $total ?></div>
     	 	<p class="question">
     	 		<?php echo $questions['text']; ?>     	 			
     	 	</p>
     	 	<form method="post" action="process.php">
     	 		<ul class="choice">
     	 			 <?php  while($row = $choices->fetch_assoc()){ ;   ?>
                         	<li>
                         		<input type="radio" name="choice" value= <?php echo $row['id']; ?> > 
                         		<?php echo $row['text']; ?>
                            </li>
                     <?php  }; ?>   	 			
     	 		</ul>
     	  		<input type="submit" name="question_submit" value="Submit" class="btn btn-outline-secondary">
     	  		<input type="hidden" name="number" value="<?php echo $number ; ?>">
     	 	</form>
     	 </div>
     </main>
     <footer>
     	  <div class="container">
     	  	  Copyright &copy; 2019, OnlineExam
     	  </div>
     </footer>
</body>
</html>