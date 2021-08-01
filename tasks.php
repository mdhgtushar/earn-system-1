<?php include "header.php"; ?>
<style>a{color: #000;text-decoration: none;}</style>
<section class="content" id="content">

<!-- Header -->
<div class="welcome">
<h1>Server time: <?php echo date("d-F m:s a") ;?></h1>
<p>Next Refrish time: <?php echo date("d-F") ;?>  12:00 am</p>
</div>


<section class="subject-cards">



<?php

$getTask = $tk->getAllTasks();
if ($getTask) {
while ($result = $getTask->fetch_assoc()) {
$taskId =  $result['taskId'] ;
$taskImg = $result['taskImage'] ;
$taskTitle = $result['taskTitle'] ;
$taskPrice =  $result['taskPrice'] ;
$insertClk = $tk->chkviewedads($taskId, $userId);
if ($insertClk) {
$results = $insertClk->fetch_assoc() ;
$viewed = $results['taskId'];
$viewedN = $result['taskId'];
$viewedT = $results['taskViewTime'];
$datetime = date("Y-m-d 00:00:00");
if ($viewedT == $datetime) {
$viewedUnviewed =  "<span style='color:green'>(Earned)</spen>";
} else {
$viewedUnviewed = null;
}
}
?>
<a href="taskview.php?id=<?php echo $result['taskId'] ?>">
<div class="subject-card">
<div class="subject-image">
<img src="../renew/<?php echo $taskImg;?>">
</div>
<div class="subject-card-info">
<h3><?php echo $taskTitle;?></h3>
<p><?php echo $taskPrice;?> Tk <?php echo $viewedUnviewed?></p>
</div>
</div>
</a>
<?php
}
}
?>


</section>

</section>

<?php include "footer.php";?>