<?php include("../includes/sessions.php"); ?>
<?php include("../includes/dbConnection.php"); ?>
<?php include("../includes/functions.php"); ?>

<?php 
	if(!isset($_GET['college'])){
		redirect_to('index.php');
	}
	else
		$facultyName = $_GET['college'];
?>

<?php 
	//Get faculty information
	$faculty = find_faculty_by_name($connection, $facultyName);
	
	//Get educational years of the faculty
	$years = find_all_years($connection, $faculty['id']);
?>
<?php
	// Add Department to the faculty
	
	if(isset($_POST["add_dept"])){
		if(!empty($_POST["new_dept"])){
			$dept_name = $_POST["new_dept"];
			$query = "INSERT INTO `departement`(`departement_name`, `faculty_id`) VALUES ('{$dept_name}', {$faculty['id']})";
			$result = mysqli_query($connection, $query);
			if(!$result){
				$message = "departement creation failed." ;
			}
		}else{
			$message = "ادخل البيانات المطلوبة";
		}
	}
	
?>

<?php
		
		$departments = find_all_departments($connection, $faculty['id']);
?>
<!DOCTYPE html>
<html>

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
                    <a style="font-size:20px" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " " . $_SESSION['username'] . " "; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i>البيانات الشخصية</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>تسجيل خروج</a>
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
                    <li class="active">
                        <a style="font-size:30px" href="#"><i class="fa fa-fw fa-edit"></i> بيانات عامة</a>
                    </li>
                    <li>
                        <a href="staff.php?college=<?php echo $facultyName ?>"><i class="fa fa-fw fa-user"></i> أعضاء هيئة التدريس</a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-book"></i> المقررات الدراسية</a>
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
                    <li>
                        <a href="teams.php?college=<?php echo $facultyName; ?>"><i class="fa fa-fw fa-file"></i> انشاء أسرة طلابية</a>
                    </li>
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- college name -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php
									echo $facultyName;
							?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- college information -->
				<div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-8">
						<div class="panel panel-primary">
							<div class="panel-heading">عميد الكلية</div>
							<div class="panel-body"><b><?php echo $faculty['faculty_dean']; ?><b/></div>
						</div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
							<div class="panel-heading">عدد سنوات الدراسة</div>
							<div class="panel-body"><b><?php echo $faculty['study_years']; ?>  سنوات <b/></div>
						</div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
							<div class="panel-heading">الأقسام</div>
							<div class="panel-body">
								<b>
									<?php
										while($department = mysqli_fetch_assoc($departments)){
											echo $department['departement_name'] . "</br>";
										}
									?>
								<b/></br>
								<a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="glyphicon glyphicon-plus"></i> إضافة قسم <i class="fa fa-fw fa-caret-down"></i></a>
								<div id="demo1" class="collapse">
									<form action="#" method="POST">
										<input name="new_dept" placeholder="اسم القسم">
										<button class="btn btn-primary" type="submit" name="add_dept">
											<span class="glyphicon glyphicon-plus"> </span>
											إضافة قسم
										</button>
									</form>
								</div>
								
							</div>
						</div>
                    </div>
                </div>
                <!-- /.row -->
				</div>
                <div class="col-lg-6">
					<div class="col-lg-2"></div>
					<div class="col-lg-8">
						<center> <img src="images/FCI.png" width="300px" height="300px"/> </center>
					</div>
					<div class="col-lg-2"></div>
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

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
