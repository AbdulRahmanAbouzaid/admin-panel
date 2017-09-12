<?php include("../includes/sessions.php"); ?>
<?php include("../includes/dbConnection.php"); ?>
<?php include("../includes/functions.php"); ?>

<?php
	if(!isset($_GET['college'])){
		redirect_to('index.php');
	}
	
	if(!isset($_SESSION["admin_id"])){
		redirect_to("login.php");
	}
?>

<?php 
	$facultyName = $_GET['college'];
	$faculty = find_faculty_by_name($connection, $facultyName);
	$years = find_all_years($connection, $faculty['id']);
?>
<?php
	$message="";
	if(isset($_POST["add_team"])){
		if(!empty($_POST["teamName"]) || !empty($_POST["teamEmail"]) || !empty($_POST["teamPassword"])){
			$name = $_POST["teamName"];
			$password = $_POST["teamPassword"];
			$email = $_POST["teamEmail"];
			$query = "INSERT INTO `family`(`family_name`, `email`, `password`, `faculty_id`) VALUES ('{$name}','{$email}','{$password}',{$faculty['id']})";
			$result = mysqli_query($connection, $query);
			if(!$result){
				$message =  mysqli_error($connection);
				//$message .= $result;
			}
			else{
				$message = "تم إضافة الأسرة بنجاح";
				$color= "green";
			}
		}
		else{
			$message = "ادخل البيانات المطلوبة";
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
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a style="font-size:20px" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo " " . $_SESSION['username'] . " "; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> بيانات شخصية</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> تسجيل الخروج</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="glyphicon glyphicon-education"></i> الكليات</a>
                    </li>
                    <li>
                        <a href="info.php?college=<?php echo $facultyName; ?>"><i class="fa fa-fw fa-edit"></i> بيانات عامة</a>
                    </li>
                    <li>
                        <a href="staff.php?college=<?php echo $facultyName; ?>"><i class="fa fa-fw fa-user"></i> أعضاء هيئة التدريس</a>
                    </li>
                    <li>
                        <a href="courses.php?college=<?php echo $faculty['faculty_name']; ?>"><i class="glyphicon glyphicon-book"></i> المقررات الدراسية</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-user"></i> الطلاب <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <?php 
								while($year = mysqli_fetch_assoc($years)){
									
							?>
							<li>
                                <a href="students.php?faculty_id=<?php echo $faculty['id']; ?>&year_id=<?php echo $year['id']?>">
									<?php echo $year['year_name']; ?>
								</a>
                            </li>
							<?php } ?>
                        </ul>
                    </li>
                    <li class="active">
                        <a style="font-size:25px" href="#"><i class="fa fa-fw fa-file"></i> إنشاء أسرة طلابية</a>
                    </li>
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
							<div class="row">
								<div class="col-lg-4">
									<h2> انشاء أسرة طلابية </h2>
								</div>
							</div>
								<div style="font-size:20px; color:<?php if(isset($color)) echo $color; else echo "red";?>"><?php if(isset($message)) echo $message; ?></div>
								<div class="col-lg-4">
									<form action="#" method="POST">
										<label for="teamName"> اسم الأسرة </label>
										<input class="form-control" name="teamName" placeholder="ادخل اسم الأسرة"></br>
										<label for="teamEmail"> البريد الإلكترونى</label>
										<input class="form-control" name="teamEmail" placeholder="أنشأ بريد الكترونى للأسرة"></br>
										<label for="teamPassword"> كلمة المرور</label>
										<input class="form-control" name="teamPassword" placeholder="أنشأ كلمة مرور للأسرة"></br>
										<button class="btn btn-primary" type="submit" name="add_team">
											<span class="glyphicon glyphicon-plus"> </span>
											إضافة أسرة
										</button>
									</form>
								</div>
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

</body>

</html>
