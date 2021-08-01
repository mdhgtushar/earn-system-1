<?php
include_once "config/config.php";
include_once "lib/Session.php";
session::checkSession();
include_once 'Classes/viewTask.php';
include_once "Classes/profile.php";
$tk= new Task();

if (isset($_GET['id'])){
$id = $_GET['id'];
}else{
echo'<script>
window.location.assign("dashbord.php")</script>';
}
$id = $_GET['id'];

$getAllTasksbyId = $tk->getAllTasksbyId($id);
if ($getAllTasksbyId) {
$result = $getAllTasksbyId->fetch_assoc(); 
$taskLink = $result['taskLink'] ;
}

$tk= new Task();
$id = $_GET['id'];
$usrId = Session::get('userId');
$getCat = $tk->getAdsClkByid($usrId);
if ($getCat) {
while ( $result = $getCat->fetch_assoc()) {
$adclk=$result['userAdsClick']  ;
}
}
$oneclk= 1;
$clicks = $adclk + $oneclk ;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$insertClk = $tk->inserTaskClkbyId($id, $usrId, $clicks);
}

if (isset($insertClk)) {
echo $insertClk;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Task</title>
<style>
*{
margin: 0;
font-family: Arial, Helvetica, sans-serif;
}
h2,input{
padding: 5px 10px;
margin: 5px;
border: 1px solid #ddd;
float: left;
overflow: hidden;
font-size: 20px;
}


.container{
overflow: hidden;
}
iframe{
width: 100%;
height: 98vh;
}
</style>
</head>

<body onload="load()">
<section class="container">
<h2 id="timeBox">Starting..</h2>

<span id="statusBox"></span>

</section>
<hr>

<iframe src="<?php echo $taskLink;?>" frameborder="0"></iframe>


<script>
function load(){
var timeBox = document.getElementById('timeBox');
var statusBox = document.getElementById('statusBox');

var i = 0;
var total = 5;

setInterval(function startCountdown(){
if(total > i){
timeBox.innerHTML = total;
total--;
}else{
timeBox.innerHTML = "<span style='color:green'>Done</span>";
statusBox.innerHTML = '<form action="" method="post"><input type="submit" class="btn btn-success" value="Back"></form>';
}
}, 1000);
}
</script>
</body>
</html>