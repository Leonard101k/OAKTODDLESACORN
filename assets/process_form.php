<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include the PHPMailer autoloader

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullName = test_input($_POST["fullName"]);
    $dob = test_input($_POST["dob"]);
    $gender = test_input($_POST["gender"]);
    $parent1Name = test_input($_POST["parent1Name"]);
    $parent1Relation = test_input($_POST["parent1Relation"]);
    $parent1Contact = test_input($_POST["parent1Contact"]);
    $parent1Email = test_input($_POST["parent1Email"]);
    $parent2Name = test_input($_POST["parent2Name"]);
    $parent2Relation = test_input($_POST["parent2Relation"]);
    $parent2Contact = test_input($_POST["parent2Contact"]);
    $parent2Email = test_input($_POST["parent2Email"]);

    // Compose the email message
    $to = "your_email@example.com"; // Replace with your email address
    $subject = "New Enrollment Form Submission";

    $message = "New enrollment form submission:\n\n";
    $message .= "Student Information:\n";
    $message .= "Full Name: $fullName\n";
    $message .= "Date of Birth: $dob\n";
    $message .= "Gender: $gender\n\n";

    $message .= "Parent/Guardian Information:\n";
    $message .= "Parent/Guardian 1 Name: $parent1Name\n";
    $message .= "Relationship to Student: $parent1Relation\n";
    $message .= "Contact Number: $parent1Contact\n";
    $message .= "Email Address: $parent1Email\n\n";

    $message .= "Parent/Guardian 2 Name: $parent2Name\n";
    $message .= "Relationship to Student: $parent2Relation\n";
    $message .= "Contact Number: $parent2Contact\n";
    $message .= "Email Address: $parent2Email";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_username'; // Replace with your SMTP username
        $mail->Password   = 'your_password'; // Replace with your SMTP password
        $mail->SMTPSecure = 'tls'; // You may need to change this to 'ssl' depending on your server
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('webmaster@example.com', 'Webmaster');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send email
        $mail->send();

        // You can add additional logic here, such as redirecting the user to a thank you page
        header("Location: thanks.html");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Helper function to sanitize form data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
