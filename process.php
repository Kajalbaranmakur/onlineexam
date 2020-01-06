<?php include 'database.php' ?>
<?php session_start(); ?>
<?php 

    //Check to see score is set or not
    if(!isset($_SESSION['score'])){
        $_SESSION['score'] = 0;
    }
    //count number of question answerd
    if(!isset($_SESSION['question_no'])){
        $_SESSION['question_no'] = 0;
    }

    
    if(isset($_POST['question_submit'])){
        $number = $_POST['number'];
        $select_choice = $_POST['choice'];
        $next = $number + 1;
        
        //It count how many questions have submited
        if($_SESSION['question_no'] <= $number){
            $_SESSION['question_no']++;
        }
        
        //Get total number of questions
        $query  = "SELECT * FROM questions";
        $result = $connection->query($query) or die($connection->error.__LINE__);  
        $total  = $result->num_rows;


        //if any answer ic clicked
        if (isset($_POST['choice'])) {
            //Get correct answer
             $sql= "SELECT is_correct
                    FROM choices 
                    WHERE id = $select_choice" ;
             $query= $connection->query($sql) or die($connection->error.__LINE__);
             $choice = $query->fetch_assoc();
             $ans = $choice['is_correct'];

            //if answer is correct increment score            
            if($ans == 1){
                //if iquestion is submited second times by back page then thin number is not count
                if($_SESSION['question_no'] == $number){
                    $_SESSION['score']++;
                }
            }
        }

        //if it is the last question then go to final page
        if($number == $total){   
            header('location:final.php');
            exit();
        }else{
            header('location:question.php?n='.$next);
        }
    }
 ?>