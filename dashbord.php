<?php include "header.php"; ?>


<section class="content" id="content">
<section>
<!-- Header -->
<div class="welcome">
  <h1>Welcome <?php echo $userName;?></h1>
  <p>Dashbord</p>
</div>
</section>
<br>
<section>
	<div class="navbar">
		<h3>Income</h3>
	</div>
</section>
<section class="profile-cards">
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $balance ;?> <?php echo $carrency;?></h4>
			<p>Current Balance</p>
		</div>
    </div>
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $todayAdsClick * $adsPrice ;?> <?php echo $carrency;?></h4>
			<p>Today's income</p>
		</div>
    </div>
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $selfIncome;?> <?php echo $carrency;?></h4>
			<p>Self income</p>
		</div>
    </div>
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $rfrIncome ;?> <?php echo $carrency;?></h4>
			<p>Referral income</p>
		</div>
    </div>
</section>
<section>
	<div class="navbar">
		<h3>Clicks</h3>
	</div>
</section>

<section class="profile-cards">
	
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $todayAdsClick ;?></h4>
			<p>Today's Ads Clicks</p>
		</div>
    </div>

	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $adclk ;?></h4>
			<p>Self Ads Clicks</p>
		</div>
    </div>
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $totalRefAdsClick ;?></h4>
			<p>Referral Ads Clicks</p>
		</div>
    </div>

</section>

<section>
	<div class="navbar">
		<h3>Payment</h3>
	</div>
</section>

<section class="profile-cards">
	
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $payment ;?> <?php echo $carrency;?></h4>
			<p>Ammount Paid</p>
		</div>
    </div>
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $pndpym ;?> <?php echo $carrency;?></h4>
			<p>Ammount Panding</p>
		</div>
    </div>
</section>

<section>
	<div class="navbar">
		<h3>Network</h3>
	</div>
</section>
<section class="profile-cards">
	<div class="profile-card">
		<div class="profile-card-info">
			<h4><?php echo $totalReffer ;?></h4>
			<p>Referrals</p>
		</div>
    </div>
</section>


<section>
	<div class="navbar">
		<h3>Admin Posts</h3>
	</div>
</section>
<section class="exams">
<?php
$getTask = $ap->getAllTasks();
if ($getTask) {
    while ($result = $getTask->fetch_assoc()) {
        ?>
<div class="exam-card" style="width: 50%;float:left">
<div class="exam-card-tumb">
<p class="exam-card-header"><b><?php echo $result['postTitle'] ; ?></b></p>
<img class="exam-image" src="../renew/admin/<?php echo $result['postImage'] ; ?>">
</div>
<div class="exam-card-footer">
		<a href="<?php echo $result['postId'] ; ?>">Read More..</a>
</div>
</div>
<?php
    }
}?>

</section>
</section>

<?php include "footer.php";?>