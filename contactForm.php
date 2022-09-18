<?php
  
if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $visitor_message = "";
    $email_body = "<div>";
      
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Sender Name:</b></label>&nbsp;<span>".$visitor_name."</span>
                        </div></br>";
    }
 
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Sender Email:</b></label>&nbsp;<span>".$visitor_email."</span>
                        </div></br>";
    }
      
    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason:</b></label>&nbsp;<span>".$email_title."</span>
                        </div></br>";
    }
      
      
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                           <label><b>Message:</b></label>
                           <div>".$visitor_message."</div>
                        </div>";
    }
      

        $recipient = "esaikia@protonmail.com";
    
    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
      
    if(mail($recipient, $email_title, $email_body, $headers)) {
        echo $status = "ok";
        echo '<script type="text/javascript">';
        echo ' alert("Thank you for your message. I will get back to you ASAP.")';  //not showing an alert box.
        echo '</script>';
        // echo "<p>Thank you for your message, $visitor_name. I will get back to you ASAP.</p>";
    } else {
        echo $status = "err";
    }

    echo $status;die;
      
} else {
    echo '<p>Something went wrong</p>';
}
?>