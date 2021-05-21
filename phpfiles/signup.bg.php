<?php
if(isset($_POST['submit'])){

        require 'connect.db.php';

        $userEmail=$_POST['emailId'];
        $userName=$_POST['userId'];
       
            if(empty($userName) || empty($userEmail)){
                  header("Location: ../signup.php?error=emptyfields");
             exit();
                                                }
            elseif(!filter_var($userEmail,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-z0-9]*$/",$userName)){
                header("Location: ../signup.php?error=invalidEmail=".$userEmail."&invaliduser=".$userName);
             exit();
                                                                                                                }
            elseif (!filter_var($userEmail,FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?error=invalidEmail=".$userEmail);
                  exit();
                                                                    }  
            else{       
            $userNameQuery="SELECT * FROM users WHERE userId=? OR emailId=?";
            $preparedstmt=mysqli_stmt_init($dbconn);
            if(!mysqli_stmt_prepare($preparedstmt,$userNameQuery)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
            }
        else{
             mysqli_stmt_bind_param($preparedstmt,"ss",$userName,$userEmail);
                mysqli_stmt_execute($preparedstmt);
                mysqli_stmt_store_result($preparedstmt);

    $checker=mysqli_stmt_num_rows($preparedstmt);

    if($checker>0)
    {
        header("Location: ../signup.php?error=userexisted&Email=".$userEmail."&user=".$userName);
        exit();
    }else{
        $insertedvalue="INSERT INTO users (userId,emailId)  VALUES (?,?)";
        $preparedstmt=mysqli_stmt_init($dbconn);
        if(!mysqli_stmt_prepare($preparedstmt,$insertedvalue)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
             
            mysqli_stmt_bind_param($preparedstmt,"ss",$userName,$userEmail);
            mysqli_stmt_execute($preparedstmt);
            header("Location: ../signup.php?submitted");
            exit();
        }

    }
}
mysqli_stmt_close($preparedstmt);
mysqli_close($dbconn);
}


}else{
    header("Location: ../signup.php?kyabay");
    exit();
}