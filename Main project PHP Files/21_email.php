<?php
$to = 'zyjy2009@hotmail.com';


$teamName = 'Montreal Youth Group 6';
$sessionDate = '20-August-2024';
$sessionTime = '6:00 PM';
$sessionType = 'training session';
$memberFirstName = 'John';
$memberLastName = 'Doe';
$memberRole = 'goalkeeper';
$coachFirstName = 'Jane';
$coachLastName = 'Smith';
$coachEmail = 'jane.smith@example.com';


$subject = "$teamName $sessionDate $sessionTime $sessionType";


$message = "
Hello $memberFirstName $memberLastName,

This is your upcoming session:

Date: $sessionDate
Time: $sessionTime
Type: $sessionType
Role: $memberRole

Head Coach: $coachFirstName $coachLastName
Coach Email: $coachEmail

Best,
Youth Soccer Club
";


$headers = 'From: webmaster@example.com' . "\r\n" .
           'Reply-To: webmaster@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();


if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.';
} else {
    echo 'Failed to send email.';
}
?>
