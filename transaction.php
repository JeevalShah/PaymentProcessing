<?php
session_start();

// Include connection.php to establish database connection
include("connection.php");

$session_phone = $_SESSION['Phone'];

// Perform query to fetch transaction records from the database
$transaction_query = "SELECT * FROM `transactions` WHERE `Sender` = '$session_phone' OR `Receiver` = '$session_phone' ORDER BY `ID` DESC";
$transaction_result = mysqli_query($connection, $transaction_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    th{
        padding:  3px 70px;
    }
    table {
        border-bottom: 1px solid rgba(75, 75, 75, 1);
        border-collapse: collapse;
        position: relative;
        right: 130px;
        top: 25px;
    }
    table{
        margin-left: 20px;
        text-align: center;
    }
    .transac{
        background-color: #050414;
        height: 600px;
        width: 1200px;
        position: relative;
        left: 280px;
        top: 50px;
    }
    td {
        padding: 5px;
    }
    #money {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Use the default text color */
    }

    #money:visited {
        color: inherit; /* Use the default text color for visited links */
    }

    #money:focus, #money:hover {
        outline: none; /* Remove outline on focus/hover */
        color: inherit; /* Use the default text color on focus/hover */
    }

</style>
<body>
<button class="send1"><a href="send_friend.php" id="money"><i class="fa-solid fa-paper-plane icn"></i>Send Money</a></button>
    <div class="navbar">
        <h2 id="logo">PAYZY</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-table-cells-large" id="dash"></i> Dashboard</a></li>
            <li><a href="transaction.php" style="color: #DBDBDB;"><i class="fa-solid fa-wallet"></i> Transactions</a></li>
            <li><a href="rewards.php"><i class="fa-solid fa-hand-holding-dollar"></i> Rewards</a></li>
            <li><a href="cards.php"><i class="fa-regular fa-credit-card"></i> Cards</a></li>
        </ul>
    </div>
    <div class="transac">
        <h3 style="color: white; position: relative; right: 170px; top: 15px;">Previous Transactions</h3>
        <table style="color: rgba(159, 168, 194, 1);">
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Date
                </th>
                <th>
                    Transaction ID
                </th>
                <th>
                    Status
                </th>
                <th>
                    Amount
                </th>
            </tr>
            <?php
                // Check if there are any transaction records
                if (mysqli_num_rows($transaction_result) > 0) {
                    // Loop through each transaction record and display it in the table
                    while ($row = mysqli_fetch_assoc($transaction_result)) {
                        // Determine whose name to display based on whether you are the sender or receiver
                        if ($row['Sender'] == $session_phone) {
                            $name = $row['Name'];
                        } else {
                            $name = $row['SenderName'];
                        }
                        // Set the color of the amount based on whether you are the sender or receiver
                        $amount_color = ($row['Receiver'] == $session_phone) ? 'green' : 'red';
                        echo "<tr>";
                        echo "<td>".$name."</td>";
                        echo "<td>".$row['Date']."</td>";
                        echo "<td>".$row['ID']."</td>";
                        echo "<td>".$row['Status']."</td>";
                        echo "<td style='color: $amount_color;'>".$row['Amount']."</td>";
                        echo "</tr>";
                    }
                } else {
                    // If there are no transaction records, display a message in the table
                    echo "<tr><td colspan='5'>No transactions found.</td></tr>";
                }
            ?>
        </table>
    </div>
    
</body>
</html>
