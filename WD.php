<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect form data
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $enquiryType = filter_input(INPUT_POST, 'enquiryType', FILTER_SANITIZE_STRING);
    $propertyType = filter_input(INPUT_POST, 'propertyType', FILTER_SANITIZE_STRING);
    $bedrooms = filter_input(INPUT_POST, 'bedrooms', FILTER_SANITIZE_STRING);
    $minPrice = filter_input(INPUT_POST, 'minPrice', FILTER_SANITIZE_NUMBER_INT);
    $maxPrice = filter_input(INPUT_POST, 'maxPrice', FILTER_SANITIZE_NUMBER_INT);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$firstName || !$lastName || !$email || !$phone || !$enquiryType) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Prepare email content
    $to = "princegoti13@gmail.com"; // Your email address
    $subject = "New Property Enquiry from $firstName $lastName";
    $body = "You have received a new enquiry:\n\n";
    $body .= "Name: $firstName $lastName\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Enquiry Type: $enquiryType\n";
    $body .= "Property Type: $propertyType\n";
    $body .= "Bedrooms: $bedrooms\n";
    $body .= "Price Range: £$minPrice - £$maxPrice\n";
    $body .= "Location: $location\n";
    $body .= "Message:\n$message\n";

    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your enquiry. We will get back to you soon.";
    } else {
        echo "There was a problem sending your enquiry. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
