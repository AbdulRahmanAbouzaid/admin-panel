<?php include("../includes/sessions.php"); ?>
<?php include("../includes/dbConnection.php"); ?>
<?php include("../includes/functions.php"); ?>

<?php 
   if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
	   
		$found_admin = attemp_login($connection, $username, $password);
		if($found_admin){
			$_SESSION["admin_id"] = $found_admin['id'] ;
			$_SESSION['username'] = $username;
			//if($found_admin['college']=='عام'){
				redirect_to("index.php");
			//}
		}else{
			$message = "admin not found";
		  //$_SESSION["message"] = "Admin not found";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Core CSS RTL-->
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/sb-admin-rtl.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a style="font-size:20px" href="#"><i class="fa fa-fw fa-power-off"></i> بيانات تسجيل دخول</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
				<form action="#" method="POST">
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="form-group">
										<label>اسم المستخدم</label>
										<input class="form-control" placeholder="اكتب اسم المستخدم الخاص بك" name="username">
								</div>

							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="form-group">
										<label>كلمة المرور</label>
										<input class="form-control" type="password" placeholder="ادخل كلمة المرور" name="password">
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<button style="font-size:20px" type="submit" name="submit" class="btn btn-primary">
									<span class="glyphicon glyphicon-ok"> </span>
									تسجيل الدخول
								</button>
							</div>
						</div>
				</form>

				<h2> <?php if(isset($message)) echo $message; ?> </h2>
                


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
