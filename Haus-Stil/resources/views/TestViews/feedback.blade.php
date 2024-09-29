<!DOCTYPE html>
<html>
<head>
    <title>Checkout Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p><strong>First Name:</strong> {{ $checkoutData['firstname'] }}</p>
    <p><strong>Last Name:</strong> {{ $checkoutData['lastname'] }}</p>
    <p><strong>Country:</strong> {{ $checkoutData['country'] }}</p>
    <p><strong>Address:</strong> {{ $checkoutData['address'] }}</p>
    <p><strong>Postal Number:</strong> {{ $checkoutData['postal_number'] }}</p>
    <p><strong>City:</strong> {{ $checkoutData['city'] }}</p>
    <p><strong>Phone:</strong> {{ $checkoutData['phone'] }}</p>
    <p><strong>Email:</strong> {{ $checkoutData['email'] }}</p>
    <p><strong>Total Price:</strong> ${{ $checkoutData['total_price'] }}</p>
</body>
</html>
