<?php
    include('connection.php');

    session_start();

    // Fetch user details from the database
    $select_user = mysqli_query($connection, "SELECT * FROM `user_accounts` WHERE `Phone` = '{$_SESSION['Phone']}'");
    $user = mysqli_fetch_assoc($select_user);
    
    // Fetch card details from the database
    $select_cards = mysqli_query($connection, "SELECT * FROM `card` WHERE `Phone` = '{$_SESSION['Phone']}' ORDER BY `ID` ASC");

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
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        th{
            padding:  3px 40px;
        }
        table {
            border-bottom: 1px solid rgba(75, 75, 75, 1);
            border-collapse: collapse;
            text-align: center;
        }
        table {
            margin-left: 20px;
        }
        td {
            padding: 5px;
        }

        #money {
            text-decoration: none; 
            color: inherit;
        }

        #money:visited {
            color: inherit;
        }

        #money:focus, #money:hover {
            outline: none;
            color: inherit;        
        }

</style>
</head>

<body>
    <button class="send1"><a href="send_friend.php" id="money"><i class="fa-solid fa-paper-plane icn"></i>Send Money</a></button>
    <div class="navbar">
        <h2 id="logo">PAYZY</h2>
        <ul>
            <li><a href="dashboard.php" style="color: #DBDBDB;"><i class="fa-solid fa-table-cells-large" id="dash"></i> Dashboard</a></li>
            <li><a href="transaction.php"><i class="fa-solid fa-wallet"></i> Transactions</a></li>
            <li><a href="rewards.php"><i class="fa-solid fa-hand-holding-dollar"></i> Rewards</a></li>
            <li><a href="cards.php"><i class="fa-regular fa-credit-card"></i> Cards</a></li>
        </ul>
    </div>
    <div class="balance">
        <h3 style="color: white; text-align: center;">Balance</h3>
        <p style="color: white; text-align: center;">₹<?php echo $user['Wallet']; ?></p>
        <canvas id="myChart" style="width:300px;max-width:350px"></canvas>
        <script>
            var xValues = ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat"];
            var yValues = [55, 49, 44, 24, 15, 10];
            var barColors = ["rgba(151, 71, 255, 1)", "rgba(151, 71, 255, 1)","rgba(151, 71, 255, 1)","rgba(151, 71, 255, 1)","rgba(151, 71, 255, 1)","rgba(151, 71, 255, 1)"];

            new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {
                display: true,
                text: "Expenses"
                }
            }
            });
        </script>
    </div>

    <div class="overview">
        <h3 style="color: white; text-align: center;">Overview This Month</h3>
        <img src="images/chart.jpg" alt="" style="width: 260px; margin-left: 38px;">
    </div>
    <div class="cards">
    <h3 style="color: white; margin-left: 20px;">Saved Cards</h3>
    <?php while ($card = mysqli_fetch_assoc($select_cards)) { ?>
        <div class="card">
            <div class="card-content">
                <h5 style="margin-top: 3px; font-size: 18px; margin-bottom: 5px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Name</h5>
                <p style="font-size: 20px; margin-bottom: 10px;"><?php echo $card['Name']; ?></p>
                <h5 style="margin-top: 7px; font-size: 18px; margin-bottom: 5px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Card Number</h5>
                <p style="font-size: 20px; margin-bottom: 10px;letter-spacing: 2px;"><?php echo $card['Number']; ?></p>
                <h5 style="margin-top: 7px; font-size: 18px; margin-bottom: 5px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Expires</h5>
                <p style="font-size: 20px; margin-bottom: 10px;"><?php echo $card['Expiry']; ?></p>
            </div>
        </div>
    <?php } ?>
    </div>
    <div class="transactions">
        <h3 style="color: white; margin-left: 20px;">Previous Peer Transactions</h3>
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
            <tr>
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
        </table>
    </div>
    
</body>
</html>