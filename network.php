<?php include "header.php"; ?>

<section class="content" id="content">

<section>
	
<!-- Header -->
<div class="welcome">
  <h1>Network</h1>
  <p>Invite and earn <?php echo $perReffer; ?> <?php echo $carrency;?> also you will get a commition from your reffer income</p>
</div>
</section>

<section class="profile-cards">
	



<?php

$userRfrName = Session::get('uniqueUserName');
$adsclicks = $cn->getuserclickrfr($userRfrName);
if ($adsclicks == null) { ?>

	<div class="profile-card">
		<div class="profile-image">
			<img src="me.jpg">
		</div>
		<div class="profile-card-info">
			<h4>Your network code is</h4>
			<p><?php echo $uniqueUserName ;?></p>
		</div>
		<div class="profile-card-footer">
			Not Any Network found
		</div>
	</div>


<?php
} else {
    if ($adsclicks) {
        while ($result = $adsclicks->fetch_assoc()) {
            $propic = $result['userProfile'] ;
			?>

	<div class="profile-card">
		<div class="profile-image">
			<img src="pf.png">
		</div>
		<div class="profile-card-info">
			<h4><?php echo $result['userName'] ;?></h4>
			<p><?php echo $result['userPhone'] ;?></p>
		</div>
		<div class="profile-card-footer">
			Income Generated : 
		</div>
	</div>

<?php
        }
    }
} ?>

</section>
</section>
</section>

<?php include "footer.php";?>