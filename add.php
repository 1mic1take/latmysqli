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
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">

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
					<li class="active"><a href="add.php">เพิ่มข้อมูลพนักงาน</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>ข้อมูลพนักงาน &raquo; เพิ่มข้อมูลพนักงาน</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$idstaff		 = $_POST['idstaff'];
				$namestaff		 = $_POST['namestaff'];
				$onsite	 		 = $_POST['onsite'];
				$birthday	 	 = $_POST['birthday'];
				$address	     = $_POST['address'];
				$telephone		 = $_POST['telephone'];
				$position		 = $_POST['position'];
				$status			 = $_POST['status'];
				$username		 = $_POST['username'];
				$pass1	         = $_POST['pass1'];
				$pass2           = $_POST['pass2'];

				$cek = mysqli_query($connectdb, "SELECT * FROM staffdata WHERE idstaff='$idstaff'");
				if(mysqli_num_rows($cek) == 0){
					if($pass1 == $pass2){
						$pass = md5($pass1);
						$insert = mysqli_query($connectdb, "INSERT INTO staffdata(idstaff, namestaff, onsite, birthday, address, telephone, position, status, username, password)
															VALUES('$idstaff','$namestaff', '$onsite', '$birthday', '$address', '$telephone', '$position', '$status', '$username', '$pass')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>บันทึกข้อมูลพนักงานเรียบร้อย</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>มีความผิดพลาดในการบันทึกข้อมูลพนักงาน</div>';
						}
					} else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password ไม่เหมือนกัน</div>';
					}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>รหัสพนักงาน ซ้ำกัน</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">รหัสพนักงาน</label>
					<div class="col-sm-2">
						<input type="text" name="idstaff" class="form-control" placeholder="กรุณาใส่รหัสพนักงาน" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ชื่อพนักงาน</label>
					<div class="col-sm-4">
						<input type="text" name="namestaff" class="form-control" placeholder="กรุณาใส่ ชื่อ-นามสกุล พนักงาน" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ประจำไซท์งาน</label>
					<div class="col-sm-4">
						<input type="text" name="onsite" class="form-control" placeholder="กรุณาใส่ไซท์งานที่ประจำ" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">วัน-เดือน-ปี เกิด</label>
					<div class="col-sm-2">
						<input type="text" name="birthday" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ที่อยู่</label>
					<div class="col-sm-3">
						<textarea name="address" class="form-control" placeholder="กรุณาใส่ชื่อที่อยู่"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
					<div class="col-sm-3">
						<input type="text" name="telephone" class="form-control" placeholder="กรุณาใส่เบอร์โทรศัพท์" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ตำแหน่ง</label>
					<div class="col-sm-2">
						<select name="position" class="form-control" required>
							<option value="">กรุณาเลือกตำแหน่ง</option>
							<option value="Operator">ผู้ประกอบการ</option>
							<option value="Leader">ผู้จัดการ</option>
                            <option value="Supervisor">ผู้บริหาร</option>
							<option value="Manager">หัวหน้างาน</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">สถานะ</label>
					<div class="col-sm-3">
						<select name="status" class="form-control">
							<option value="">เลือกประเภทของพนักงาน</option>
                            <option value="outsource">พนักงานบริการนอกสถานที่</option>
							<option value="contract">พนักงานสัญญาจ้าง</option>
							<option value="routine">พนักงานประจำ</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-2">
						<input type="text" name="username" class="form-control" placeholder="กรุณาใส่ชื่อผู้ใช้">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass1" class="form-control" placeholder="กรุณาใส่รหัสผ่าน">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Re Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass2" class="form-control" placeholder="กรุณายืนยันรหัสผ่าน">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="บันทึก">
						<a href="index.php" class="btn btn-sm btn-danger">กลับไปหน้าแรก</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
