<?php
include("connectdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--
Project      : Data Karyawan CRUD MySQLi (Create, read, Update, Delete) PHP, MySQLi dan Bootstrap
Author		 : Hakko Bio Richard, A.Md
Website		 : http://www.niqoweb.com
Blog         : http://www.acchoblues.blogspot.com
Email	 	 : hakkobiorichard[at]gmail.com
-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ระบบ เพิ่ม ลบ แก้ไข ฐานข้อมูล</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-block visible-sm-block" href="">ข้อมูลพนักงาน</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="">ข้อมูลพนักงาน</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">ข้อมูลพนักงานทั้งหมด</a></li>
					<li><a href="add.php">เพิ่มข้อมูลพนักงาน</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>ข้อมูลพนักงาน &raquo; เปลี่ยนรหัสผ่าน</h2>
			<hr />

			<p>เปลี่ยนรหัสผ่านข้อมูลพนักงานรหัส <?php echo '<b>'.$_GET['idstaff'].'</b>'; ?></p>

			<?php
			if(isset($_POST['ganti'])){
				$idstaff	= $_GET['idstaff'];
				$password 	= md5($_POST['password']);
				$password1 	= $_POST['password1'];
				$password2 	= $_POST['password2'];

				$cek = mysqli_query($connectdb, "SELECT * FROM staffdata WHERE idstaff='$idstaff' AND password='$password'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ใส่รหัสผ่านไม่ถูกต้อง</div>';
				}else{
					if($password1 == $password2){
						if(strlen($password1) >= 6){
							$pass = md5($password1);
							$update = mysqli_query($connectdb, "UPDATE staffdata SET password='$pass' WHERE idstaff='$idstaff'");
							if($update){
								echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>เปลี่ยนรหัสผ่นเรียบร้อยแล้ว</div>';
							}else{
								echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>รหัสผ่านผิดพลาด ลองอีกครั้ง</div>';
							}
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ความยาวตัวอักษรรหัสผ่านอย่างน้อย 6 ตัวอักษร</div>';
						}
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>รหัสผ่านไม่เหมือนกัน</div>';
					}
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">รหัสผ่านเดิม</label>
					<div class="col-sm-4">
						<input type="password" name="password" class="form-control" placeholder="กรุณาพิมพ์รหัสผ่านเดิม" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">รหัสผ่านใหม่</label>
					<div class="col-sm-4">
						<input type="password" name="password1" class="form-control" placeholder="กรุณาพิมพ์รหัสผ่านใหม่" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">รหัสผ่านใหม่อีกครั้ง</label>
					<div class="col-sm-4">
						<input type="password" name="password2" class="form-control" placeholder="กรุณาพิมพ์รหัสผ่านใหม่อีกครั้ง" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="ganti" class="btn btn-sm btn-info" value="บันทึกการเปลี่ยนแปลง">
						<a href="index.php" class="btn btn-sm btn-danger"><b>กลับไปสู่หน้าแรก</b></a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
