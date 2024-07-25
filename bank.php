<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Form</title>
</head>
<body>
    <form action="bank_action.php" method="post">
        <label for="">Name on the Card</label><br>
        <input type="text" name="name" required><br><br>
        <label for="">Card Number</label><br>
        <input type="number" name="number" required><br><br>
        <label for="">Expiry</label><br>
        <input type="month" name="date" required><br><br>
        <label for="">CVV</label><br>
        <input type="number" name="cvv" required><br><br>
        <label for="">Enter Balance</label><br>
        <input type="number" name="balance"><br><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>