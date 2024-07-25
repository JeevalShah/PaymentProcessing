<?php
    include('connection.php');

    session_start();

    // Fetch card details from the database
    $select = mysqli_query($connection,"SELECT * FROM `card` WHERE `Phone` = '{$_SESSION['Phone']}' ORDER BY `ID` ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #money {
            text-decoration: none; /
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
    <div id="blurr">
    <button class="send1"><a href="send_friend.php" id="money"><i class="fa-solid fa-paper-plane icn"></i>Send Money</a></button>
    <div class="navbar">
        <h2 id="logo">PAYZY</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-table-cells-large" id="dash"></i> Dashboard</a></li>
            <li><a href="transaction.php"><i class="fa-solid fa-wallet"></i> Transactions</a></li>
            <li><a href="rewards.php"><i class="fa-solid fa-hand-holding-dollar"></i> Rewards</a></li>
            <li><a href="cards.php" style="color: #DBDBDB;"><i class="fa-regular fa-credit-card"></i> Cards</a></li>
        </ul>
    </div>
    
    <!-- Display card details fetched from the database -->
    <?php while ($card = mysqli_fetch_assoc($select)) { ?>
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


    <div class="card add" onclick="openForm()">
        <p>
            <i class="fa-solid fa-plus"></i>
            <p>Add New Card</p>
        </p>
    </div>
    </div>
    <div class="form" id="form">
        <form action="card_action.php" method="post">
            <i class="fa-solid fa-xmark" id="cancel1" onclick="closePage()"></i>
            <h2 style="font-weight: bold; font-size: 40px; margin-bottom: 21.5px; margin-left: 60px;">Add New Card</h2>
            <label for="">Name on the Card</label><br>
            <input type="text" class="name" name="name"><br><br>
            <label for="">Card Number</label><br>
            <input type="number" class="number" name="number"><br><br>
            <label for="">Expiry</label><br>
            <input type="month" id="date" name="expiry">
            <label for="" class="cvv" id="lbl" >CVV</label><br>
            <input type="number" class="cvv" id="inp" name="cvv"><br><br>
            <input type="submit" name="submit" value="Add Card" id="sub">
        </form>
    </div>
</body>
<script>
    document.getElementById("form").style.display = 'none';
    function openForm(){
        document.getElementById("form").style.display = 'block';
        document.getElementById("blurr").style.opacity = '20%';
    }
    function closePage() {
        document.getElementById("form").style.display = "none";
        document.getElementById('blurr').style.opacity = "100%";
    }
</script>
</html>
