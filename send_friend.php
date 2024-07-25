<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/send.css">
    <script>
        function redirectToBank() {
            event.preventDefault();
            window.location.href = 'send_bank.php';
        }
    </script>
</head>
<body>
    <div class="navbar">
        <h2 id="logo">PAYZY</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-table-cells-large" id="dash"></i> Dashboard</a></li>
            <li><a href="transaction.php"  style="color: #DBDBDB;"><i class="fa-solid fa-wallet"></i> Transactions</a></li>
            <li><a href="rewards.php"><i class="fa-solid fa-hand-holding-dollar"></i> Rewards</a></li>
            <li><a href="cards.php"><i class="fa-regular fa-credit-card"></i> Cards</a></li>
        </ul>
    </div>
    <div class="s_friend">
        <form action="friend_action.php" method="post">
            <span class="heading">
                <i class="fa-regular fa-paper-plane"></i>
                Send Money
            </span><br>
            <span class="buttons">
                <button>Send to Friend</button>
                <button id="bank" onclick="redirectToBank()">Send to Bank</button>
            </span><br>
            <label for="">Enter Phone Number</label><br>
            <input type="number" name="receiver_phone"><br><br>
            <label for="">Enter Amount</label><br>
            <input type="number" name="amount"><br><br>
            <label for="">Enter Coupon Code</label><br>
            <input type="text" name="coupon_code"><br><br><br>
            <!--<span>
                <select name="" id="">
                    <option value="">Select Card</option>
                    <option value="">card1</option>
                    <option value="">card1</option>
                </select>
            </span>-->
            <button id="sub" type="submit" name="submit"><b>Pay Now</b></button>
            <!--<input type="submit" value="Pay Now" name="submit">-->
            <i class="fa-solid fa-coins coin"></i>
        </form>
    </div>
</body>
</html>