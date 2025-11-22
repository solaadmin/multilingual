<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to = "info@solaadmin.nl";

    // Detect which form was submitted
    if (isset($_POST['form_type']) && $_POST['form_type'] == "appointment") {
        $subject = "Appointment Booking";
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $subj = $_POST['subject'];

        $message = "
        <h3>New Appointment Booking</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Date:</strong> {$date}</p>
        <p><strong>Time:</strong> {$time}</p>
        <p><strong>Subject/Note:</strong> {$subj}</p>
        ";

    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == "contact") {
        $subject = "Contact Form Enquiry";
        $assist = $_POST['username'];
        $phone = $_POST['phone'];
        $name = $_POST['text'];

        $message = "
        <h3>New Contact Form Submission</h3>
        <p><strong>How to assist:</strong> {$assist}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Name:</strong> {$name}</p>
        ";
    } else {
        die("Invalid form submission.");
    }

    // Email headers
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Sola Admin <no-reply@solaadmin.nl>" . "\r\n";
    $headers .= "Bcc: cleverminds.co.in@gmail.com\r\n";

    // Send mail
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Thank you! Your request has been submitted successfully.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Mail sending failed. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "No direct access allowed.";
}
?>
