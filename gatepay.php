<?php
session_start();
$dbhost ="localhost"; //xpressjv_tknusers db
$dbuser = "xpressjv_tknroot";//"globalca_root";
$dbpass = "!V5.Woy50zcg";//"fW4j3J_qb9Nc";
$dbname ="xpressjv_tknusers";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	die("Failed to connect");
}
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($db->connect_errno){
	die("Failed to connect");	
}
?>
<?php
	
$planimg = "";	
$plan = "";
$amountinput = '<input type="number"     style="padding: 5px;border-radius: 10px;border: 2px solid #ffb400;font-size: 1.5rem;letter-spacing: 2px;outline: none;"
 id="reqvaal" min="" max="" placeholder="-----" value="50" />';
?>
<!DOCTYPE html>
<html class="no-js" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Gatepay</title>
    <link rel="shortcut icon" href="assets/images/logo/logo-dark.png">    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--=== Reset Css ===-->
    <link rel="stylesheet" href="Loginn/normalize.css">
    <!--=== Bootstrap ===-->
    <link rel="stylesheet" href="Loginn/bootstrap.min.css">
    <!--=== Fontawesome icon ===
    <link rel="stylesheet" href="Loginn/font-awesome-5.10.2.min.css">
    <!--=== Owl-Carousel ===-->
    <link rel="stylesheet" href="Loginn/owl.carousel.min.css">
    <!--=== Magnific Popup===-->
    <link rel="stylesheet" href="Loginn/magnific-popup.css">
    <!--=== nice-select ===-->
    <link rel="stylesheet" href="Loginn/nice-select.css">
    <!--=== Animation Css ===-->
    <link rel="stylesheet" href="Loginn/animate.css">
    <!--=== Main Css ===-->
    <link rel="stylesheet" href="Loginn/style.css">
    <!--=== Responsive Css ===-->
    <link rel="stylesheet" href="Loginn/responsive.css">
		<link rel="stylesheet" href="./apps.css">
		<link rel="stylesheet" href="./m1.css">
		    <link rel="stylesheet" type="text/css" href="jnoty.css">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<!--onload="approx()"-->
<body onload="fapprox();approx();">

    <!-- ==========Preloader========== -->
	
    <div class="preloader" id="hrr" style="display: block;background:#ffb400;">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ==========Preloader========== -->
	<style>
.dropbtn {
  background-color: #3498DB;
  border-radius: 10px 10px 10px 10px;
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 100%;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/*
.dropdown a:hover {background-color: #ddd;}
.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}*/
.dropdown-content a:hover {background-color: blue; color:white;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
.show {display: block;}
</style>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunctionx() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<!--background-image: url('Loginn/account-bg.jpg');-->
    <div class="account-section" style="    background: linear-gradient(to bottom, #ffb400 0%, #00b4ff 100%)
">
        <div class="container">
            <div class="account-title">
                <center>
                <a href="" style="color:#fff; text-shadow:0px 0px 5px #fff;" class="logo">
                                            <img src="assets/images/logo/logo.png" style="border-radius: 20px;width:250px;height:100px;">

                </a>
                </center>
            </div>
            <div class="account-wrapper">
                <div class="account-body" style="display:none;">
				<img src="digital-wallet.png" style="width:70px;height:70px;">
				<img src="<?=$planimg?>" style="width:70px;height:70px;">
				<br><br>
				<div style="border-radius:;background:azure;">
				<div style="text-align:left;"><img src="offer-icon-2.png" style="width:20px;height:20px;"><sub>Plan - name >> </sub><sub><b><?=$plan?></b></sub>
				<img src="package.png" style="width:20px;height:20px;">
				</div>
				<div style="text-align:left;"><span>Set plan worth with respect to selected plan</span>
				<br>
				<span><b style="font-size:1.5rem;">$</b> <?=$amountinput?><b>.00</b></span><sub><b> USD</b></sub></div>
				<div style="text-align:left;"><span> ≈ </span><span><b id="rbtc"></b></span><sub><b> BTC</b></sub></div>
				</div>
				
                    <h3 class="subtitle"></h3>
					
                </div>
				
				<div style="padding:10px;">
			<h3 class="subtitle"></h3>
				<div style="border-radius:;background:azure;padding:10px;">
				
				<div style="text-align:left;">Select from the dropdown and 
				pay  <span id="rbtc0"></span> into any of the given addresses.
				
				<br><sub><b>*Payment processor is initiatlized and awaiting to verify.</b><sub>
				</div>
				<center><br>
					

<style>
.button {
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
<script>
	function myFuncta(x){
		// forscan = document.getElementById('qscan');
		 forsmq = document.getElementById('smq');
		 fortext = document.getElementById('myInput');
		 preper = document.getElementById('preper');
	switch (x.innerHTML){
<?php
 
  $sql = "SELECT * FROM walimg_ekomm";
  $result = mysqli_query($db,$sql);
    
  while ($row = mysqli_fetch_array($result)) {
        $iiddd = $db->insert_id;
    $coin = $row['coin'];
    $addr =$row['addr'];
	$cases = '
	        
			case \''.$coin.'\':
			
			preper.innerHTML = \''.$coin.'\';
			forsmq.src = \'digital-wallet.png\';
			fortext.value = \''.$addr.'\';
			bq(\''.$addr.'\');
			break;
		';
		echo $cases;
		
		}
?>
		default:
			//forscan.src = 'forbtc.png';
			forsmq.src = '';
			fortext.value = '';
}
	}	    
	
</script>
<div class="dropdown">
<p id="deom"></p>
  <button class="dropbtn button" onclick="myFunctionx()">Select Payment Method</button>
  <div class="dropdown-content" id="myDropdown">
    <?php
    if(true){
    $sql = "SELECT * FROM walimg_ekomm";
    $result = mysqli_query($db,$sql);
     while ($row = mysqli_fetch_array($result)) {
echo '<a href="javascript:void(0);" class="icon" onclick="myFuncta(this)">'.$row['coin'].'</a>';
}
    }
    
     ?>

	
</div>
</div>

				
				<br/><br/><br/>
<style>
    
    input {
    padding: 10px;
    border-radius: 20px;
    border: 2px solid steelblue;
    font-size: 1.5rem;
    letter-spacing: 2px;
    outline: none;
}
</style>
</style>				
				<div id="myLinks1">
				    <div id="qrcode">
				<img src="" id="qscan" style="display:none;width: 250px; height: 250px;border-radius: 15px;text-align: center;">
				</div>
				<br><br>
				<hr>
				<h3 id="preper"></h3>
				<hr>
  
				
				<img src="bitco.png" id="smq" style="display:none;cursor:pointer; width: 40px; height: 40px;">
				<input spellcheck="false" type="text" style="width:70%;" value="" placeholder="Click the button above" id="myInput" readonly>
				<img onclick="myFunct()" src="copy.png" style="cursor:pointer; width: 20px; height: 20px;">
<br><br>
				<div><i class="fa fa-qrcode"></i><sub> SCAN QR CODE OR COPY ADDRESS ABOVE.</sub></div><br>		
				</div>
				
				
				<i class="fa fa-spinner w3-spin"></i><b><small> Awaiting </small></b>
				</center>
				</div>
			
			</div>            
				
       
            
				
            </div>
        </div>
    </div>
    <br>
    <footer>
        <center> &copy; All right reserved -- <?=$_SERVER['SERVER_NAME'];?> </center>
    </footer>


    <!--====== Scroll To Top Start ======-->
    <div id="scrollUp" title="Scroll To Top" style="background:#ffb400;">
        <i class="fa fa-arrow-up" style="display:none;"></i>
    </div>
    <!--====== Scroll To Top End ======-->
      

<script>
//var bl = setInterval( function() { approx(); }, 1000);
var reqval = document.getElementById("reqvaal").value;//"45678";;
var nreqval = Number(reqval);

function zzx(){
var reqval = document.getElementById("reqvaal");//"45678";;
var amtf = document.getElementById("amtf");
amtf.value = reqval.value;

var d = new Date();
var msec = Date.parse(d);
document.getElementById("demox").value = msec;



}

function myFunct() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the address: " + copyText.value);
}
// Set the date we're counting down to
var countDownDate = new Date().getTime();
countDownDate += 1200000;
// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("deom").innerHTML =  minutes + "m " + ": " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("deom").innerHTML = "EXPIRED";
  }
}, 1000);

	
	const api_url = 'https://api.cryptonator.com/api/ticker/btc-usd';

		const time_interval = 2;
		function addLeadingZero(num) {
			return (num <= 9) ? ("0" + num) : num;
		}
		function clientDateTime() {
			var date_time = new Date();
			// var weekday = date_time.getDay();
			// var today_date = date_time.getDate();
			// var month = date_time.getMonth();
			// var full_year = date_time.getFullYear();
			var curr_hour = date_time.getHours();
			var zero_added_curr_hour = addLeadingZero(curr_hour);
			var curr_min = date_time.getMinutes();
			var curr_sec = date_time.getSeconds();
			var curr_time = zero_added_curr_hour + ':' + curr_min + ':' + curr_sec;
			return curr_time
		}
		function makeHttpObject() {
			try { return new XMLHttpRequest(); }
			catch (error) { }
		}
		function bitcoinGetData() {
			var request = makeHttpObject();
			request.open("GET", api_url, false);
			request.send(null);
			return request.responseText;
		}
		function bitcoinDataHandler() {
			var raw_data_string = bitcoinGetData();
			var data = JSON.parse(raw_data_string);
			var base = data.ticker.base;
			var target = data.ticker.target;
			var price = data.ticker.price;
			var volume = data.ticker.volume;
			var change = data.ticker.change;
			var api_server_epoch_timestamp = data.timestamp;
			var api_success = data.success;
			var api_error = data.error;
			return price;
			
		}

		
function fapprox(){
    zzx();
    var yag = document.getElementById("reqvaal");
    yag.addEventListener('keydown', zzx);
    yag.addEventListener('keydown', approx);
}
	function approx() {
			var obtainer = bitcoinDataHandler();
			var dol = 1 / obtainer;
			var reqval = document.getElementById("reqvaal").value;//"45678";
			//zzx();
            var nreqval = Number(reqval);
			var lp = nreqval * dol;
			var rbtc = document.getElementById("rbtc").innerHTML = lp.toPrecision(6);			
			var rbtc0 = document.getElementById("rbtc0").innerHTML = lp.toPrecision(6) + " BTC";			
			var req = reqval.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		//	var rv = document.getElementById("reqvaal").value = req;
			//alert("nn");
			
        }

function funcz1(){
    var on0 = document.getElementById("trid0");
    var on1 = document.getElementById("trid1");
    on1.style.display = "block";
    on0.style.display = "none";
    
}

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
      <script type="text/javascript">
function bq(x){
const qrcode = document.getElementById("qrcode");
//const textInput = document.getElementById("myInput");
qrcode.innerHTML ='';
const qr = new QRCode(qrcode);

qr.makeCode(x.trim());

//qr.makeCode(textInput.value.trim());
// textInput.onchange = (e) => {
//     qr.makeCode(e.target.value.trim());
// };
}
</script>

    <!--==================================================================-->
    <script src="Loginn/jquery.min.js.download"></script>
    <script src="Loginn/proper-min.js.download"></script>
    <script src="Loginn/bootstrap.min.js.download"></script>
    <!--=== All Plugin ===-->
    <script src="Loginn/waypoint.min.js.download"></script>
    <script src="Loginn/owl.carousel.min.js.download"></script>
    <script src="Loginn/jquery.rcounter.js.download"></script>
    <script src="Loginn/jquery.magnific-popup.min.js.download"></script>
    <script src="Loginn/jquery.nice-select.min.js.download"></script>
    <script src="Loginn/wow.min.js.download"></script>
    <!--=== All Active ===-->
    <script src="Loginn/main.js.download"></script>





</body></html>