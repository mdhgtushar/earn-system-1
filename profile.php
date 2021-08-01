<?php include "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $useradd =  $useradd = $pf->updatePf($_POST, $id);
}

?>
<style>.center{max-width: 100%;margin: 10px;border: 1px solid #ddd;padding: 10px;}.input-group{padding: 5px 0;overflow: hidden;}
table{width: 100%;}
th,td{padding: 10px 20px; border: 1px solid #ddd;text-align: left;}
</style>


<section class="content" id="content">

<section>

<!-- Header -->
<div class="welcome">
<h1>Profile</h1>
<p>Your profile is compleate</p>
</div>
</section>






<div class="center" style="overflow: scroll;">
<div style="padding:10px">
<h2>Profile info</h2>
<p>You can update your info anytime</p>
<p></p>
</div>
<table>
    <tr>
        <th>Name</th>
        <td><?php echo $userName; ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $uniqueUserName; ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo $userEmail; ?></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><?php echo $userPhone; ?></td>
    </tr>
    <tr>
        <th>Location</th>
        <td><?php echo $userLocation?></td>
    </tr>
</table>
</div>



<div class="center">
<div style="padding:10px">
<h2>Profile Edit</h2>
<p>Edit you profile</p>
<p>
    <?php if(isset($msg)){
        echo $msg;
    }?>
</p>

</div>
<form class="login-form header-form" action="" method="post">



<div class="input-group">
<button class="login-input-button" name=""><i>N</i></button>
<input class="login-input-box" type="text" placeholder="Name"  name="userName" value="<?php echo $userName; ?>" autocomplete="off">
</div>



<div class="input-group">
<button class="login-input-button" name=""><i>E</i></button>
<input class="login-input-box" type="text" placeholder="Email."  name="userEmail" value="<?php echo $userEmail; ?>" autocomplete="off">
</div>

<div class="input-group">
<button class="login-input-button" name=""><i>P</i></button>
<input class="login-input-box" type="text" placeholder="Phone" name="userPhone" value="<?php echo $userPhone; ?>" autocomplete="off">
</div>
<div class="input-group">
<button class="login-input-button" name=""><i>A</i></button>
<input class="login-input-box" type="text" placeholder="Address"  name="address"  value="<?php echo $userLocation; ?>" autocomplete="off">
</div>

<div class="input-group">
<input class="login-input-button" type="submit" value="Update Now" style="width: 100%; color:#000;" >
</div>
</form>
</div>

</section>


<?php include "footer.php";?>