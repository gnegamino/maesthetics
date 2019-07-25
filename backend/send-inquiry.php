<?php

if (
    !isset($_POST['contactName'])
    || !isset($_POST['contactNumber'])
    || !isset($_POST['contactAddress'])
    || !isset($_POST['contactRemarks'])
) {
    response(["message" => "Please input all required fields."]);
    return;
}

$escaped = escapeString([
    'contactName' => $_POST['contactName'],
    'contactNumber' => $_POST['contactNumber'],
    'contactAddress' => $_POST['contactAddress'],
    'contactRemarks' => $_POST['contactRemarks']
]);

$contactName = $escaped['contactName'];
$contactNumber = $escaped['contactNumber'];
$contactAddress = $escaped['contactAddress'];
$contactRemarks = $escaped['contactRemarks'];

if (strlen(trim($contactName)) < 2) {
    response(["message" => "Please input valid name."]);
    return;
}

if (strlen(trim($contactNumber)) < 4) {
    response(["message" => "Please input valid contact number."]);
    return;
}

if (!filter_var($contactAddress, FILTER_VALIDATE_EMAIL)) {
    response(["message" => "Please input valid E-mail Address."]);
    return;
}

if (strlen(trim($contactRemarks)) < 5) {
    response(["message" => "Please input your note or message."]);
    return;
}

global $emails;

foreach ($emails as $key => $value) {
    if (!send($contactName, $contactNumber, $contactAddress, $contactRemarks, $value)) {
        response(["message" => "Unable to send. Please try again."]);
        return;
    }
}

response(["message" => ""]);

function send(
    $contactName,
    $contactNumber,
    $contactAddress,
    $contactRemarks,
    $to
) {
    $from    = "inquire-no-reply@m-aestheticsclinic.com";
    $subject = "Online Inquiry";
    $headers = "From:".$from;

    $message = "Name: ".$contactName."\r\n";
    $message .= "Contact No.: ".$contactNumber."\r\n";
    $message .= "E-mail Address: ".$contactAddress."\r\n";
    $message .= "\r\n\r\n";
    $message .= "Note/Message: ".$contactRemarks."\r\n";

    return @mail($to, $subject, $message, $headers);
}