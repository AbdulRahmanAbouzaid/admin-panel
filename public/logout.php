<?php include("../includes/sessions.php"); ?>
<?php include("../includes/functions.php"); ?>

<?php
	unset($_SESSION['admin_id']); 
	redirect_to('login.php');
?>