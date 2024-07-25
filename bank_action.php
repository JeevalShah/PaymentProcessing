<?php
session_start();

include("connection.php");

if(isset($_POST['submit'])){
    // Fetching form data
    $amount = $_POST['amount'];
    $bank_name = $_POST['name'];
    $account_number = $_POST['account'];
    $ifsc_code = $_POST['IFSC'];
    $remarks = $_POST['Remarks'];

    // Assuming you have a valid session variable for the phone number
    $sender_phone = $_SESSION['Phone'];

    if($amount <= 0) {
        echo '<script type="text/javascript">
        setTimeout(function() {
            alert("Amount cannot be negative!");
            window.location.href = "send_bank.php";
            }, 100);
        </script>';
        exit();
    }

    // Fetching sender's balance
    $sender_balance_query = "SELECT `Wallet` FROM `user_accounts` WHERE `Phone` = '$sender_phone'";
    $sender_balance_result = mysqli_query($connection, $sender_balance_query);
    $sender_balance = mysqli_fetch_assoc($sender_balance_result)['Wallet'];

    // Check if sender has sufficient balance
    if ($sender_balance >= $amount) {
        // Deduct amount from sender's balance
        $new_sender_balance = $sender_balance - $amount;
        $update_sender_query = "UPDATE `user_accounts` SET `Wallet` = $new_sender_balance WHERE `Phone` = '$sender_phone'";
        mysqli_query($connection, $update_sender_query);

        // Creating object for today's date
        $today_date = date("Y-m-d");

        // Inserting transaction details into the transaction table
        $transaction_query = "INSERT INTO `bank_transactions`(`ID`,`Name`, `Account`, `IFSC`, `Amount`, `Remarks`, `Phone`, `Date`) VALUES ('', '$bank_name', '$account_number', '$ifsc_code', '$amount', '$remarks', '$sender_phone', '2024-03-26')";
        if(mysqli_query($connection, $transaction_query)) {

            // Alert with a delay before redirecting to dashboard
            echo '<script type="text/javascript">
                setTimeout(function() {
                    alert("Payment Completed!");
                    window.location.href = "dashboard.php";
                }, 100);
            </script>';
        } else {
            echo "Error inserting transaction details: " . mysqli_error($connection);
        }
    } else {
        echo "Insufficient balance in sender's account.";
    }
}
?>

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
                <input type="number" name="account"><br><br>
                <label for="">Enter Bank Name</label><br>
                <input type="text" name="name"><br><br>
                <label for="">Enter IFSC Code</label><br>
                <input type="text" name="IFSC"><br><br>
                <label for="">Enter Amount</label><br>
                <input type="Amount" name="amount"><br><br>
                <input type="text" placeholder="Remarks" name="Remarks">
                <button id="sub1" type="submit" name="submit"><b>Transfer Now</b></button>
                <!--<input type="submit" id="sub1" value="Transfer Now" name="submit">-->
            </div>
            
        </form>
    </div>
</body>
</html>