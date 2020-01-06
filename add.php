<?php include 'database.php' ?>
<?php 
    if(isset($_POST['submit'])){
      //Get the variables
      $question_number = $_POST['question_number'];
      $question_text   = $_POST['question_text'];
      $correct_choice  = $_POST['correct_choice'];

      //Get choices
      $choices    = array();
      $choices[1] = $_POST['choice1'];
      $choices[2] = $_POST['choice2'];
      $choices[3] = $_POST['choice3'];
      $choices[4] = $_POST['choice4'];

      //Question query
      $query = "INSERT INTO questions(question_number, text)
                VALUES('$question_number', '$question_text')";
      $run_query = $connection->query($query) or die($connection->error.__LINE__);

      //Validate insert
      if($run_query){
         foreach ($choices as $key => $value) {
            if($value != ''){
               if($correct_choice == $key){
                   $is_correct = 1;
               }else{
                   $is_correct = 0;
               }

               //choice query
               $query  = "INSERT INTO choices(question_number,is_correct, text)
                          VALUES('$question_number','$is_correct', '$value')";
               $insert_row = $connection->query($query) or die($connection->error.__LINE__);
              
              //validate insert
               if($insert_row){

                 continue;
               }else{
                  die('Error : ('.$connection->errno .')'. $connection->error);
               }
            }
          }
        $msg = "Question sucessfully added.";
      }
    }

   //Get get the position to insert new question
   $query  = "SELECT * FROM questions";
   $result = $connection->query($query) or die($connection->error.__LINE__);  
   $total  = $result->num_rows;
   $num    = 1;
   $next   = $num;
   while($ro = $result->fetch_assoc()){
      if($num == $ro['question_number']){
         $next = $num + 1;
      }
      $num++;
   }
   //$next   = $total + 1;
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
     	 	<h2>Add a questions</h2>
            
                <p class="text-success success-msg">
                      <?php 
                          if(isset($msg)){
                             echo $msg;
                          }
                      ?>
                </p>

               <form method="post" action="add.php">
                    <div class="form-group">
                      <label>Question number :</label>
                      <input type="number" name="question_number" value="<?php echo $next; ?>">
                    </div>
                    <div class="form-group">
                      <label>Question text :</label>
                      <input type="text" name="question_text">
                    </div>
                    <div class="form-group">
                      <label>Choice 1 :</label>
                      <input type="text" name="choice1">
                    </div>
                    <div class="form-group">
                      <label>Choice 2 :</label>
                      <input type="text" name="choice2">
                    </div>
                    <div class="form-group">
                      <label>Choice 3 :</label>
                      <input type="text" name="choice3">
                    </div>
                    <div class="form-group">
                      <label>Choice 4 :</label>
                      <input type="text" name="choice4">
                    </div>
                    <div class="form-group">
                      <label>Correct choice number :</label>
                      <input type="number" name="correct_choice">
                    </div>
                    <button type="submit" class="btn btn-info" name="submit">Submit</button>
               </form>
     	 </div>
     </main>
     <!-- <footer>
     	  <div class="container">
     	  	  Copyright &copy; 2019, OnlineExam
     	  </div>
     </footer> -->
</body>
</html>