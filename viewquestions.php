<?php require "controller/authController.php" ; ?>

<?php 
    $p=0;
    //Get questions
    $query     = "SELECT * FROM questions";
    $run_query = $conn->query($query) or die($conn->error.__LINE__);

    //Delete question
    if(isset($_POST['submit'])){
      if($_POST['row'] > 0){
        $number = $_POST['row'];

        //Get questions
        $query   = "DELETE FROM questions WHERE question_number = $number";
        $run     = $conn->query($query) or die($conn->error.__LINE__);

        //Get choice
        $query   = "DELETE FROM choices WHERE question_number = $number";
        $choices = $conn->query($query) or die($conn->error.__LINE__);
        $p = 1;
      }
      
      header('location:viewquestions.php?msg='.$p);
    }
    
    // to get "deleted successfully" massage (for this reason $p and $msg variable created).
    $msg = 0;
    if(isset($_GET['msg'])){
      $msg = (int) $_GET['msg'];
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
     		<h1>All questions</h1>          
     	</div>     	 
    </header>
    <main>
     	 <div class="container">

     	 	<a href="add.php" class="btn btn-info btn-block">Add Questions</a><br>
        <form action="viewquestions.php" method="post"> 
            <div class="input-group mb-3">
              <input type="number" name="row" class="form-control" placeholder=" Enter Question Number">
              <div class="input-group-append">
                <button type="submit" class="btn btn-danger" name="submit">Delete This Question</button>
              </div>
            </div>            
        </form>   

        <p class="text-success success-msg">
            <?php    
                if($msg == 1){
                    echo "Question sucessfully deleted.";
                }
            ?>
        </p><br>

          <?php  while($r = $run_query->fetch_assoc()){ ; $x = 0; ?>
            <ul>
              <li> 
                 <?php echo $r['question_number'].") ".$r['text']; ?>
              </li>
              <li>
                <?php 
                  //Get choice
                  $number  = $r['question_number'];
                  $query   = "SELECT * FROM choices WHERE question_number = $number";
                  $choices = $conn->query($query) or die($conn->error.__LINE__);
                  while($c = $choices->fetch_assoc()){ ;
                  $x++;
                ?>
                <ul>
                  <li>
                    <?php 
                       echo $x.": ".$c['text']." ";
                       //Get the right answer, printed with *
                       if($c['is_correct'] == 1 ){
                          echo "*";
                       }
                    ?>                   
                  </li>
                </ul>
              <?php }; ?>
              </li>
            </ul>
          <?php }; ?>
        <br><br>
     	</div>
    </main>
  </body>
</html>