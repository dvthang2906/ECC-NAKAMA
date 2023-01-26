<?php
// session_start();
$add_userName = $_SESSION['add-userName'];
// if the sign up form was submitted
if($_POST){
    $email = isset($_POST["add-email"]) ? $_POST["add-email"] : "";
    $_SESSION['email_active'] = $email;
    // posted email must not be empty
    if(empty($email)){
        echo "<div>Email cannot be empty.</div>";
    }
 
    // must be a valid email address
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<div>Your email address is not valid.</div>";
    }
 
    else{
       //include database connection
        include 'connect.php';
 
        // check first if record exists
        $query = "SELECT id FROM users WHERE email = ? and verified = '1'";
        $result0401 = $conn->query($query);
        
 
        if($result0401 -> num_rows > 0){
            echo "<div>Your email is already activated.</div>";
        }else{
            // check first if there's unverified email related
            $query = "SELECT id FROM users WHERE email = ? and verified = '0'";
            $result0401_2 = $conn->query($query);
 
            if($result0401_2 -> num_rows > 0){
 
                // you have to create a resend verification script
                echo "<div>Your email is already in the system but not yet verified. <a href='resend.php'>Resend verification?</a>.</div>";
            }
 
            else{
 
                // now, compose the content of the verification email, it will be sent to the email provided during sign up
                // generate verification code, acts as the "key"
                $verificationCode = md5(uniqid("yourrandomstringyouwanttoaddhere", true));
                $_SESSION['verificationCode'] = $verificationCode;
                // send the email verification
                $verificationLink = "https://chikk.000webhostapp.com/activate.php?code=" . $verificationCode;
 
                $htmlStr = "";
                $htmlStr .= "Hi " . $email . "!!!";
 
                $htmlStr .= "ようこそ!!!!!!!!!!!";
                $htmlStr .= "$verificationLink";
 
                // $htmlStr .= "ECC<br>";
                $htmlStr .= "";
 
 
                $name = "nakama.com";
                $email_sender = "no-reply@nakama.com";
                $subject = "Verification Link | SHOP | Subscription";
                $recipient_email = $email;
 
                $headers  = "MIME-Version: 1.0rn";
                $headers .= "Content-type: text/html; charset=iso-8859-1rn";
                $headers .= "From: {$name} <{$email_sender}> n";
 
                $body = $htmlStr;
 
                // send email using the mail function, you can also use php mailer library if you want
                if( mail($recipient_email, $subject, $body, $headers) ){
 
                    // tell the user a verification email were sent
                    echo "<div id='successMessage'><b>" . $email . "</b>に確認リンクを送りました。<br> メールの受信トレイを開き、指定されたリンクをクリックしてログインしてください。</div>";
 
 
                    // save the email in the database
                    $created = date('Y-m-d H:i:s');
                    
                    // echo"$email<br>";
                    // echo"$verificationCode<br>";
                    // echo"$created<br>";
                   
 
                    //write query, verified = '0' means it is unverified, on activation, it becomes '1'
                    $query_2 = "INSERT INTO `users`(`nickname`, `email`, `verified`, `verification_code`, `created`)
                            VALUES('$add_userName', '$email', '0', '$verificationCode','$created')";
                    
                                
                    // Execute the query
                    if($conn-> query($query_2) === true){
                        $conn -> commit();
                        // echo "<div>Unverified email was saved to the database.</div>";
                    }else{
                        echo"error";
                    }
 
                }else{
                    die("Sending failed.");
                }
            }
 
 
        }
 
    }
 
}
?>
