<?php
include_once "config/config.php";
include_once "lib/Session.php";
session::checkSession();
include_once "Classes/Adminpost.php";
include_once "Classes/profile.php";
include_once "Classes/counting.php";
include_once "Classes/Payment.php";
include_once "Classes/viewTask.php";




$pf = new updatePF();
$pm = new Payment();
$cn = new Counting();
$tk = new Task();
$ap = new AdminPost();

$uniqueUserName = Session::get('uniqueUserName');
$userLocation =  Session::get('address');
$userEmail = Session::get('userEmail');

$userPhone = Session::get('userPhone');
$withdrawStatus = true;
$carrency = "$";
$minimumPayout = "100";
$propic = Session::get('userProfile');
if ($propic == "") { $propic = "User.png"; }

$userName =  Session::get('userName');

$adclk = 0; //user ads click
$pndpym = 0; //panding ammount
$payment = 0; // paid ammount
$totalRefAdsClick = 0; // reffer ads click
$perReffer = 50; // par reffer income
$adsPrice = 4; // per ads price
$todayAdsClick = 0; //today ads click
$id = Session::get('userId');
$userRfrName = Session::get('uniqueUserName');
$userId = Session::get('userId');



$getCat = $pf->getAdsClkByid($id);
if ($getCat) {
    $result = $getCat->fetch_assoc();
    $adclk = $result['userAdsClick']  ;
}


$getCat = $pm->getPending($id);
if ($getCat) {
    while ($result = $getCat->fetch_assoc()) {
        $pndpym += $result['paymentAmmount']  ;
    }
}

$getCat = $pm->getPayment($id);
if ($getCat) {
    while ($result = $getCat->fetch_assoc()) {
        $payment += $result['paymentAmmount']  ;
    }
}


$totalReffer = $cn->referrals($userRfrName);
$result = $totalReffer->fetch_assoc();
$totalReffer = $result['count(userRfrName)'] ;


$rfrAdsClick = $cn->getuserclickrfr($userRfrName);
if ($rfrAdsClick) {
    while ($result = $rfrAdsClick->fetch_assoc()) {
        $totalRefAdsClick += $result['userAdsClick'] ;
    }
}



$todayAdsClick = $cn->adsclicks($id);
$result = $todayAdsClick->fetch_assoc();
$todayAdsClick =$result['count(userId)'] ;


$accountCreated = strtotime(Session::get('userAccountCreated'));
$accountCreated = date("d-F-Y", $accountCreated);





function add_months($months, DateTime $dateObject)
{
    $next = new DateTime($dateObject->format('Y-F-d'));
    $next->modify('last day of +'.$months.' month');
    if ($dateObject->format('d') > $next->format('d')) {
        return $dateObject->diff($next);
    } else {
        return new DateInterval('P'.$months.'M');
    }
}

function endCycle($d1, $months)
{
    $date = new DateTime($d1);
    $newDate = $date->add(add_months($months, $date));
    $newDate->sub(new DateInterval('P1D'));
    $dateReturned = $newDate->format('Y-F-d');
    return $dateReturned;
}

$startDate = Session::get('userAccountCreated');
$adsclicks = $cn->referrals($userRfrName);
$result = $adsclicks->fetch_assoc();
if ($totalReffer == 0) {
    $nMonths = 1;
} else {
    $nMonths = $totalReffer;
}
$accountValid = endCycle($startDate, $nMonths);


$selfIncome = $adclk * $adsPrice;
$rfrIncome = $totalRefAdsClick + ($totalReffer * $perReffer);
$balance = ($selfIncome + $rfrIncome) - ($pndpym + $payment);





?>

<!DOCTYPE html>
<html>
<head>
<title>Header</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<section class="header">

<section class="header-left">
<img class="menu-icon" onclick="sidebarToggle()" src="assets/images/menu.svg">

<img class="header-logo" src="assets/images/logo.png">
</section>
<section class="header-right">

<div class="header-menu">
<a class="header-menu-item" href="profile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Profile</a>
</div>

</section>
</section>
<section class="body">

<section class="sidebar" id="sidebar">
<div class="sidebar-content">


<!-- <div class="sidebar-profile" onclick="authVerify()">
<div class="sidebar-profile-image">
<img src="assets/images/user-login.png">
</div>
<div class="sidebar-profile-info">
<h4>Login now</h4>
<p>or Register</p>
</div>
</div> -->

<div class="profile-card" style="width: initial;border: none;">
<div class="profile-image">
<img src="pf.png">
</div>
<div class="profile-card-info">
<h4><?php echo $userName;?></h4>
<p>Reffer code : <span style="text-decoration: underline;"><?php echo $uniqueUserName?></span></p>
</div>
</div>


<div>
	<div class="nav-button"><a href="dashbord.php"><i class="fa fa-home" aria-hidden="true"></i> Dashbord</a></div>
	<div class="nav-button"><a href="tasks.php"><i class="fa fa-asterisk" aria-hidden="true"></i> Tasks</a></div>
	<div class="nav-button"><a href="network.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> My Network</a></div>
	<div class="nav-button"><a href="payment.php"><i class="fa fa-trophy" aria-hidden="true"></i> Payment</a></div>
	<div class="nav-button"><a href="profile.php"><i class="fa fa-flask" aria-hidden="true"></i> Profile</a></div>
	<div class="nav-button"><a href="logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a></div>
</div>


</div>
</section>


