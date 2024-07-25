<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
    <div id="blurr">
    <button class="send1"><a href="send_friend.php" id="money"><i class="fa-solid fa-paper-plane icn"></i>Send Money</a></button>
    <div class="navbar">
        <h2 id="logo">PAYZY</h2>
        <ul>
        <li><a href="dashboard.php"><i class="fa-solid fa-table-cells-large" id="dash"></i> Dashboard</a></li>
            <li><a href="transaction.php"><i class="fa-solid fa-wallet"></i> Transactions</a></li>
            <li><a href="rewards.php" style="color: #DBDBDB;"><i class="fa-solid fa-hand-holding-dollar"></i> Rewards</a></li>
            <li><a href="cards.php"><i class="fa-regular fa-credit-card"></i> Cards</a></li>
        </ul>
    </div>
    <div class="reward">
        <div class="c">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <h3>Get Upto ₹100 Back</h3>
            <h4>Min Order ₹750</h4>
            <h6>Valid Till 31st March, 2024</h6>
            <button onclick="openPage1()"><b>Collect Now</b></button>
        </div>
    </div>
    <div class="reward">
        <div class="c">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <h3>Get Upto ₹50 Back</h3>
            <h4>Min Order ₹500</h4>
            <h6>Valid Till 31st March, 2024</h6>
            <button onclick="openPage2()"><b>Collect Now</b></button>
        </div>
    </div>
    <div class="reward">
        <div class="c">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <h3>Get Upto ₹100 Back</h3>
            <h4>Min Order ₹850</h4>
            <h6>Valid Till 31st March, 2024</h6>
            <button onclick="openPage3()"><b>Collect Now</b></button>
        </div>
    </div>
    <div class="reward">
        <div class="c">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <h3>Get Upto ₹200 Back</h3>
            <h4>Min Order ₹1000</h4>
            <h6>Valid Till 31st March, 2024</h6>
            <button onclick="openPage4()"><b>Collect Now</b></button>
        </div>
    </div>
    <div class="reward">
        <div class="c">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <h3>Get Upto ₹250 Back</h3>
            <h4>Min Order ₹1250</h4>
            <h6>Valid Till 31st March, 2024</h6>
            <button onclick="openPage5()"><b>Collect Now</b></button>
        </div>
    </div>
    </div>

    <div class="page" id="page1">
        <h2>Get Upto ₹100 Back</h2>
        <h4>Min Order ₹750</h4>
        <h5>Valid Till 31st March, 2024</h5>
        <i class="fa-solid fa-xmark" id="cancel" onclick="closePage1()"></i>
        <i class="fa-solid fa-hand-holding-dollar"></i>
        <input type="text" id="coupon1">
        <i class="fa-regular fa-copy" id="copy" onclick="copyTxt1()"></i>
    </div>
    <div class="page" id="page2">
        <h2>Get Upto ₹50 Back</h2>
        <h4>Min Order ₹500</h4>
        <h5>Valid Till 31st March, 2024</h5>
        <i class="fa-solid fa-xmark" id="cancel" onclick="closePage2()"></i>
        <i class="fa-solid fa-hand-holding-dollar"></i>
        <input type="text" id="coupon2">
        <i class="fa-regular fa-copy" id="copy" onclick="copyTxt2()"></i>
    </div>
    <div class="page" id="page3">
        <h2>Get Upto ₹100 Back</h2>
        <h4>Min Order ₹850</h4>
        <h5>Valid Till 31st March, 2024</h5>
        <i class="fa-solid fa-xmark" id="cancel" onclick="closePage3()"></i>
        <i class="fa-solid fa-hand-holding-dollar"></i>
        <input type="text" id="coupon3">
        <i class="fa-regular fa-copy" id="copy" onclick="copyTxt3()"></i>
    </div>
    <div class="page" id="page4">
        <h2>Get Upto ₹200 Back</h2>
        <h4>Min Order ₹1000</h4>
        <h5>Valid Till 31st March, 2024</h5>
        <i class="fa-solid fa-xmark" id="cancel" onclick="closePage4()"></i>
        <i class="fa-solid fa-hand-holding-dollar"></i>
        <input type="text" id="coupon4">
        <i class="fa-regular fa-copy" id="copy" onclick="copyTxt4()"></i>
    </div>
    <div class="page" id="page5">
        <h2>Get Upto ₹250 Back</h2>
        <h4>Min Order ₹1250</h4>
        <h5>Valid Till 31st March, 2024</h5>
        <i class="fa-solid fa-xmark" id="cancel" onclick="closePage5()"></i>
        <i class="fa-solid fa-hand-holding-dollar"></i>
        <input type="text" id="coupon5">
        <i class="fa-regular fa-copy" id="copy" onclick="copyTxt5()"></i>
    </div>


</body>
<script>
    document.getElementById('coupon1').value="New!";
    document.getElementById('page1').style.display = "none";
    function openPage1() {
        document.getElementById("page1").style.display = "block";
        document.getElementById('blurr').style.opacity = "20%";
    }
    function closePage1() {
        document.getElementById("page1").style.display = "none";
        document.getElementById('blurr').style.opacity = "100%";
    }
    function copyTxt1(){
        var copyTxt = document.getElementById('coupon1').value;
        navigator.clipboard.writeText(copyTxt);
        alert("The coupon code has been copied");
    }

    document.getElementById('coupon2').value="WelcomeBack!";
    document.getElementById('page2').style.display = "none";
    function openPage2() {
        document.getElementById("page2").style.display = "block";
        document.getElementById('blurr').style.opacity = "20%";
    }
    function closePage2() {
        document.getElementById("page2").style.display = "none";
        document.getElementById('blurr').style.opacity = "100%";
    }
    function copyTxt2(){
        var copyTxt = document.getElementById('coupon2').value;
        navigator.clipboard.writeText(copyTxt);
        alert("The coupon code has been copied");
    }

    document.getElementById('coupon3').value="Hello!";
    document.getElementById('page3').style.display = "none";
    function openPage3() {
        document.getElementById("page3").style.display = "block";
        document.getElementById('blurr').style.opacity = "20%";
    }
    function closePage3() {
        document.getElementById("page3").style.display = "none";
        document.getElementById('blurr').style.opacity = "100%";
    }
    function copyTxt3(){
        var copyTxt = document.getElementById('coupon3').value;
        navigator.clipboard.writeText(copyTxt);
        alert("The coupon code has been copied");
    }

    document.getElementById('coupon4').value="Discount!";
    document.getElementById('page4').style.display = "none";
    function openPage4() {
        document.getElementById("page4").style.display = "block";
        document.getElementById('blurr').style.opacity = "20%";
    }
    function closePage4() {
        document.getElementById("page4").style.display = "none";
        document.getElementById('blurr').style.opacity = "100%";
    }
    function copyTxt4(){
        var copyTxt = document.getElementById('coupon4').value;
        navigator.clipboard.writeText(copyTxt);
        alert("The coupon code has been copied");
    }

    document.getElementById('coupon5').value="250OFF!";
    document.getElementById('page5').style.display = "none";
    function openPage5() {
        document.getElementById("page5").style.display = "block";
        document.getElementById('blurr').style.opacity = "20%";
    }
    function closePage5() {
        document.getElementById("page5").style.display = "none";
        document.getElementById('blurr').style.opacity = "100%";
    }
    function copyTxt5(){
        var copyTxt = document.getElementById('coupon5').value;
        navigator.clipboard.writeText(copyTxt);
        alert("The coupon code has been copied");
    }

</script>
</html>