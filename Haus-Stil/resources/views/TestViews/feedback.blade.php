<!DOCTYPE html>
<html>
<head>
    <title>Checkout Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p><strong>First Name:</strong> {{ $feedbackData['firstname'] }}</p>
    <p><strong>Last Name:</strong> {{ $feedbackData['lastname'] }}</p>
    <p><strong>Email:</strong> {{ $feedbackData['email'] }}</p>
    <p><strong>message:</strong> {{ $feedbackData['message'] }}</p>
</body>
</html>
