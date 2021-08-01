<?php include "header.php";
$input = null;
if($balance < $minimumPayout){$input = "disabled";}





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (($_POST['paymentAmmount']) <= $balance && $balance > $minimumPayout) {

$paymentAmmount = $_POST['paymentAmmount'];
$userId = Session::get('userId');
$userName = Session::get('userName');
$paymentMethod = $_POST['paymentMethod'];
$paymentNumber = $_POST['paymentNumber'];
$paymentNote = $_POST['paymentNote'];
$paymentinsert = $pm->paymentinsert($userName, $userId, $paymentMethod, $paymentNumber, $paymentAmmount, $paymentNote);
} else {
$popo = "Not Enough Balance ".$balance;
}
}

?>
<style>.center{max-width: 100%;margin: 10px;border: 1px solid #ddd;padding: 10px;}.input-group{padding: 5px 0;overflow: hidden;}</style>


<section class="content" id="content">

<section>

<!-- Header -->
<div class="welcome">
<h1>Payment</h1>
<p>Minimum Payout is: <?php echo $minimumPayout;?> <?php echo $carrency?></p>
</div>
</section>

<?php if($withdrawStatus == false){ ?>
<div class="center">
<div style="text-align: center;padding:10px">
<h2>Withdraw Off</h2>
<p>Payment is unavilable. We will back soon</p>
</div>
</div>
<?php } else{ ?>


<div class="center">
<div style="text-align: center;padding:10px">
<h2>Withdraw Box</h2>
<p>Your Balance is : <?php echo $balance ;?> <?php echo $carrency;?></p>
<?php if (isset($popo)) {
    echo $popo;
}?><br>
<?php if (isset($paymentinsert)) {
    echo $paymentinsert;
}?>
</div>

<form class="login-form header-form" action="" method="post">
<div class="input-group">
<button class="login-input-button" type="submit" name=""><i>PM</i></button>
<select class="login-input-box" name="paymentMethod">
<option value="">Select One</option>
<option value="Bkash">Bkash</option>
<option value="Nagad">Nagad</option>
<option value="Roket">Roket</option>
<option value="DBBL">DBBL</option>
</select>
</div>


<div class="input-group">
<button class="login-input-button" type="submit" name=""><i>AN</i></button>
<input class="login-input-box" type="number" placeholder="Account Number" name="paymentNumber" autocomplete="off">
</div>

<div class="input-group">
<button class="login-input-button" type="submit" name=""><i>AT</i></button>
<select class="login-input-box" name="" id="">
<option value="">Personal</option>
<option value="">Agent</option>
</select>
</div>

<div class="input-group">
<button class="login-input-button" type="submit" name=""><i>A</i></button>
<input class="login-input-box" type="number" placeholder="Ammount"  name="paymentAmmount" autocomplete="off">
</div>

<div class="input-group">
<button class="login-input-button" type="submit" name=""><i>N</i></button>
<input class="login-input-box" type="text" placeholder="Note" name="paymentNote" autocomplete="off">
</div>

<div class="input-group">
<input class="login-input-button" type="submit" value="Withdrow now" style="width: 100%; color:#000;" <?php echo $input?>>
</div>
</form>
</div>
<?php }?>
</section>


<?php include "footer.php";?>