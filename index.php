<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width, initial-scale=1">

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>

</head>
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div id='cssmenu'>
<ul>
<li><a href='#'>PDKT - Pendeteksi Ujaran Kebencian  || </a></li>
   <li class='active'><a href='#'>Home</a></li>
   <li><a href='#'>Cari Tweet</a></li>
   <li><a href='#'>Cari Akun</a></li>
   <li><a href='#'>Board Analisis</a></li>
</ul>
</div>
<div style="display:none;" id="myDiv" class="animate-bottom">
  <h1>Hasil Klasifikasi:</h1>
  <p>
<?php
   $a = 'E:/xampp/htdocs/pdkt/CNN-balaibahasapure/test-release.txt';
if (strpos(file_get_contents($a), '1') !== false) {
	
echo "<center><img src='red3.png" . "' alt='error'><br><h2>Ujaran Kebencian</h2></center>";
} else {
echo "<center><img src='green2.png" . "' alt='error'><br><h2>Tidak Ujaran Kebencian</h2></center>";
}
?>
  
  </p>

</div>

<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

</body>
</html>
