<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Determine which form was submitted
    $form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';

    if ($form_type == 'contact') {
        // Validate and sanitize input for contact form
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
        $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Check if required fields are filled
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            echo "All fields are required.";
            exit;
        }

        $to = 'pleasuresafaritours@gmail.com,contactus@pleasuresafaritours.com';  
        $email_subject = "New Contact Form Submission: $subject";
        $email_body = "You have received a new message from the contact form on your website.\n\n".
                      "Name: $name\n".
                      "Email: $email\n\n".
                      "Message:\n$message";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "Email successfully sent.";
        } else {
            echo "Email sending failed.";
        }
    } elseif ($form_type == 'booking') {
        // Validate and sanitize input for booking form
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $datetime = filter_var(trim($_POST['datetime']), FILTER_SANITIZE_STRING);
        $destination = filter_var(trim($_POST['destination']), FILTER_SANITIZE_STRING);
        $persons = filter_var(trim($_POST['persons']), FILTER_SANITIZE_STRING);
        $categories = filter_var(trim($_POST['categories']), FILTER_SANITIZE_STRING);
        $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Check if required fields are filled
        if (empty($name) || empty($email) || empty($datetime) || empty($destination) || empty($persons) || empty($categories) || empty($message)) {
            echo "All fields are required.";
            exit;
        }

        $to = 'pleasuresafaritours@gmail.com,contactus@pleasuresafaritours.com';  
        $email_subject = "New Booking Form Submission";
        $email_body = "You have received a new booking request.\n\n".
                      "Name: $name\n".
                      "Email: $email\n".
                      "Date & Time: $datetime\n".
                      "Destination: $destination\n".
                      "Number of Persons: $persons\n".
                      "Categories: $categories\n\n".
                      "Special Request:\n$message";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "Email successfully sent.";
        } else {
            echo "Email sending failed.";
        }
    } else {
        echo "Invalid form type.";
    }
} else {
    echo "Invalid request method.";
}
?>
