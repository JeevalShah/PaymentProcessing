<?php
session_start();

include("connection.php");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $number = $_POST['number'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];
    $phone = $_SESSION['Phone'];

    // Insert card details into the `card` table
    $query = "INSERT INTO `card`(`Name`, `Number`, `Expiry`, `CVV`, `Phone`) VALUES ('$name', '$number', '$expiry', '$cvv', '$phone')";
    
    if(mysqli_query($connection, $query)) {
        // Fetch the inserted card from the `card` table
        $card_query = "SELECT * FROM `card` WHERE `Name` = '$name' AND `Number` = '$number' AND `Expiry` = '$expiry' AND `CVV` = '$cvv' AND `Phone` = '$phone' LIMIT 1";
        $card_result = mysqli_query($connection, $card_query);
        
        if(mysqli_num_rows($card_result) == 1) {
            $card = mysqli_fetch_assoc($card_result);
            // Echo the card details within the HTML structure
            echo '<div class="card">
                    <div class="card-content">
                        <h5>Balance</h5>
                        <p>'.$card["Balance"].'</p>
                        <h5>Card Number</h5>
                        <p>'.$card["Number"].'</p>
                        <h5>Expires</h5>
                        <p>'.$card["Expiry"].'</p>
                    </div>
                  </div>';
        } else {
            echo "Error: Failed to fetch the inserted card";
        }
        header("Location: cards.php");
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>
