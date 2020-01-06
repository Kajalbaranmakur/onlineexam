<?php require "controller/authController.php" ; ?>

<?php 
    //Set question number
    $number = (int) $_GET['n'];
    
    if($number != 1){    
        if(!isset($_SESSION['score'])){
            header('location:index.php');
        }
    }
    if(!isset($_SESSION['id'])){
        header('location:login.php');
    }
    
    //Get questions
    $query = "SELECT * FROM questions WHERE question_number = $number";
    $run_query = $conn->query($query) or die($conn->error.__LINE__);
    $questions = $run_query->fetch_assoc();

    //Get choice
    $query = "SELECT * FROM choices WHERE question_number = $number";
    $choices = $conn->query($query) or die($conn->error.__LINE__);

    //Get total number of questions
    $query  = "SELECT * FROM questions";
    $result = $conn->query($query) or die($conn->error.__LINE__);  
    $total  = $result->num_rows;
    
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
     	 	<div class="current" >Question <?php echo $questions['question_number']; ?> to <?php echo $total ?></div>
     	 	<p class="question">
     	 		<?php echo $questions['text']; ?>     	 			
     	 	</p>
     	 	<form method="post" action="question.php">
     	 		<ul class="choice">
     	 			 <?php  while($row = $choices->fetch_assoc()){ ;   ?>
                         	<li>
                         		<input type="radio" name="choice" value= <?php echo $row['id']; ?> > 
                         		<?php echo $row['text']; ?>
                            </li>
                     <?php  }; ?>   	 			
     	 		</ul>
     	  		<input type="submit" name="submit_ans" value="Submit" class="btn btn-outline-secondary">
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
<