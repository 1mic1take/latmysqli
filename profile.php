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
			<h2>ข้อมูลพนักงาน &raquo; ข้อมูล</h2>
			<hr />
			
			<?php
			$idstaff = $_GET['idstaff'];
			
			$sql = mysqli_query($connectdb, "SELECT * FROM staffdata WHERE idstaff='$idstaff'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($connectdb, "DELETE FROM staffdata WHERE idstaff='$idstaff'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ลบข้อมูลเรียบร้อยแล้ว</div>';
				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ลบข้อมูลไม่ได้</div>';
				}
			}
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">รหัสพนักงาน</th>
					<td><?php echo $row['idstaff']; ?></td>
				</tr>
				<tr>
					<th>ชื่อ - นาสกุล พนักงาน</th>
					<td><?php echo $row['namestaff']; ?></td>
				</tr>
				<tr>
					<th>ประจำไซท์งาน & วันเกิด</th>
					<td><?php echo $row['onsite'].', '.$row['birthday']; ?></td>
				</tr>
				<tr>
					<th>ที่อยู่</th>
					<td><?php echo $row['address']; ?></td>
				</tr>
				<tr>
					<th>เบอร์โทรศัพท์</th>
					<td><?php echo $row['telephone']; ?></td>
				</tr>
				<tr>
					<th>ตำแหน่ง</th>
					<td><?php echo $row['position']; ?></td>
				</tr>
				<tr>
					<th>สถานะ</th>
					<td><?php echo $row['status']; ?></td>
				</tr>
				<tr>
					<th>ชื่อผู้ใช้</th>
					<td><?php echo $row['username']; ?></td>
				</tr>
				<tr>
					<th>รหัสผ่าน</th>
					<td><?php echo $row['password']; ?></td>
				</tr>
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> กลับสู่หน้าหลัก</a>
			<a href="edit.php?idstaff=<?php echo $row['idstaff']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไขข้อมูล</a>
			<a href="profile.php?aksi=delete&idstaff=<?php echo $row['idstaff']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบข้อมูล <?php echo $row['namestaff']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบข้อมูล</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>