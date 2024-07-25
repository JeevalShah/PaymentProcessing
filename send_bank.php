<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/send.css">
    <script>
        function redirectToFriend() {
            event.preventDefault();
            window.location.href = 'send_friend.php';
        }
    </script>
</head>
<body>
    <div class="navbar">
        <h2 id="logo">PAYZY</h2>
        <ul>
        <li><a href="dashboard.php" style="color: #DBDBDB;"><i class="fa-solid fa-table-cells-large" id="dash"></i> Dashboard</a></li>
            <li><a href="send_friend.php" style="color: #DBDBDB;"><i class="fa-solid fa-wallet"></i> Transactions</a></li>
            <li><a href="rewards.php"><i class="fa-solid fa-hand-holding-dollar"></i> Rewards</a></li>
            <li><a href="cards.php"><i class="fa-regular fa-credit-card"></i> Cards</a></li>
        </ul>
    </div>
    <div class="s_bank">
        <form action="bank_action.php" method="post">
            <span class="heading">
                <i class="fa-regular fa-paper-plane"></i>
                Send Money
            </span><br>
            <span class="buttons">
                <button id="bank" onclick="redirectToFriend()">Send to Friend</button>
                <button>Send to Bank</button>
            </span><br>
            <i class="fa-solid fa-mobile-screen phone"></i>
            <div class="ele">
                <label for="">Enter Bank A/c Number</label><br>
                <input type="number" name="account" required><br><br>
                <label for="">Enter Bank Name</label><br>
                <input type="text" name="name" required><br><br>
                <label for="">Enter IFSC Code</label><br>
                <input type="text" name="IFSC" required><br><br>
                <label for="">Enter Amount</label><br>
                <input type="Amount" name="amount" required><br><br>
                <input type="text" placeholder="Remarks" name="Remarks">
                <button id="sub1" type="submit" name="submit"><b>Transfer Now</b></button>
                <!--<input type="submit" id="sub1" value="Transfer Now" name="submit">-->
            </div>
            
        </form>
    </div>
</body>
</html>