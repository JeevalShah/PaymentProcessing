<?php
session_start();

include("connection.php");

if(isset($_POST['submit'])){
    // Fetching form data
    $receiver_phone = $_POST['receiver_phone'];
    $amount = $_POST['amount'];
    $coupon_code = $_POST['coupon_code'];

    $sender_phone = $_SESSION['Phone'];
    $cashback = 0;

    if($amount <= 0) {
        echo '<script type="text/javascript">
        setTimeout(function() {
            alert("Amount cannot be negative!");
            window.location.href = "send_friend.php";
            }, 100);
        </script>';
        exit();
    }
    

    if($amount >= 750 and $coupon_code == "New!") {
        $cashback = 0.1 * $amount;
        if($cashback > 100) {
            $cashback = 100;
        }
    } else if($amount >= 500 and $coupon_code == "WelcomeBack!") {
        $cashback = 0.05 * $amount;
        if($cashback > 50) {
            $cashback = 50;
        }
    } else if($amount >= 850 and $coupon_code == "Hello!") {
        $cashback = 0.08 * $amount;
        if($cashback > 100) {
            $cashback = 100;
        }
    } else if($amount >= 1000 and $coupon_code == "Discount!") {
        $cashback = 0.15 * $amount;
        if($cashback > 200) {
            $cashback = 200;
        }
    } else if($amount >= 1250 and $coupon_code == "250OFF!") {
        $cashback = 0.18 * $amount;
        if($cashback > 250) {
            $cashback = 250;
        }
    }

    // Fetching sender's name from the user_accounts table using the sender's phone number
    $sender_query = "SELECT `Name` FROM `user_accounts` WHERE `Phone` = '$sender_phone' LIMIT 1";
    $sender_result = mysqli_query($connection, $sender_query);
    if($sender_result && mysqli_num_rows($sender_result) == 1) {
        $sender_data = mysqli_fetch_assoc($sender_result);
        $sender_name = $sender_data['Name'];
    } else {
        // Handle if sender's name is not found
        $sender_name = "Unknown sender";
    }

    $receiver_query = "SELECT `Name` FROM `user_accounts` WHERE `Phone` = '$receiver_phone' LIMIT 1";
    $receiver_result = mysqli_query($connection, $receiver_query);
    if($receiver_result && mysqli_num_rows($receiver_result) == 1) {
        $receiver_data = mysqli_fetch_assoc($receiver_result);
        $receiver_name = $receiver_data['Name'];
    } else {
        // Handle if receiver's name is not found
        $receiver_name = "Unknown receiver";
    }

    // Creating object for today's date
    $today_date = date("Y-m-d");

    // Inserting transaction details into the transaction table
    $transaction_query = "INSERT INTO `transactions`(`ID`, `Name`, `Sender`, `Receiver`, `Amount`, `Status`, `Date`, `SenderName`) VALUES ('', '$receiver_name', '$sender_phone', '$receiver_phone', '$amount', 'Completed', '2024-03-26', '$sender_name')";
    $sender_balance_query = "SELECT `Wallet` FROM `user_accounts` WHERE `Phone` = '$sender_phone'";
    $sender_balance_result = mysqli_query($connection, $sender_balance_query);
    $sender_balance = mysqli_fetch_assoc($sender_balance_result)['Wallet'];

    // Check if sender has sufficient balance
    if ($sender_balance >= $amount) {
        // Deducting amount from sender's balance
        $new_sender_balance = $sender_balance - $amount;
        $update_sender_query = "UPDATE `user_accounts` SET `Wallet` = $new_sender_balance WHERE `Phone` = '$sender_phone'";
        mysqli_query($connection, $update_sender_query);

        // Fetching receiver's balance
        $receiver_balance_query = "SELECT `Wallet` FROM `user_accounts` WHERE `Phone` = '$receiver_phone'";
        $receiver_balance_result = mysqli_query($connection, $receiver_balance_query);
        $receiver_balance = mysqli_fetch_assoc($receiver_balance_result)['Wallet'];

        // Adding amount to receiver's balance
        $new_receiver_balance = $receiver_balance + $amount;
        $update_receiver_query = "UPDATE `user_accounts` SET `Wallet` = $new_receiver_balance WHERE `Phone` = '$receiver_phone'";
        mysqli_query($connection, $update_receiver_query);

    } else {
        echo "Insufficient balance in sender's account.";
    }
    if(mysqli_query($connection, $transaction_query)) {
        // Check if cashback is greater than 0
        if ($cashback > 0) {
            // Add cashback to sender's balance
            $new_sender_balance += $cashback;

            // Update sender's balance in the database
            $update_sender_balance_query = "UPDATE `user_accounts` SET `Wallet` = $new_sender_balance WHERE `Phone` = '$sender_phone'";
            mysqli_query($connection, $update_sender_balance_query);

            // Inserting cashback transaction details into the transaction table
            $cashback_transaction_query = "INSERT INTO `transactions`(`ID`, `Name`, `Sender`, `Receiver`, `Amount`, `Status`, `Date`, `SenderName`) VALUES ('', 'Cashback', '$sender_phone', '$sender_phone', '$cashback', 'Completed', '2024-03-26', 'PAYZY_CASHBACK')";
            mysqli_query($connection, $cashback_transaction_query);
        }

        // Alert with a delay before redirecting to dashboard
        echo '<script type="text/javascript">
                    setTimeout(function() {
                        alert("Payment Completed!");
                        window.location.href = "dashboard.php";
                    }, 100);
              </script>';

        // Echoing transaction details
        /*echo '<div class="transaction-details">
                <h4>Transaction Details</h4>
                <p><strong>Sender:</strong> '.$sender_name.'</p>
                <p><strong>Receiver Phone:</strong> '.$receiver_phone.'</p>
                <p><strong>Amount:</strong> '.$amount.'</p>
                <p><strong>Coupon Code:</strong> '.$coupon_code.'</p>
                <p><strong>Transaction Date:</strong> '.$today_date.'</p>
              </div>';
        header("Location: dashboard.php");*/
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

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