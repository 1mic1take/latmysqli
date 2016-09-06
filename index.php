<?php
include("connectdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

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
					<li class="active"><a href="index.php">ข้อมูลพนักงานทั้งหมด</a></li>
					<li><a href="add.php">เพิ่มข้อมูลพนักงาน</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>ข้อมูลพนักงานทั้งหมด</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				$idstaff = $_GET['idstaff'];
				$cek = mysqli_query($connectdb, "SELECT * FROM staffdata WHERE idstaff='$idstaff'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($connectdb, "DELETE FROM staffdata WHERE idstaff='$idstaff'");
					if($delete){
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">เลือกประเภทของพนักงาน</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="routine" <?php if($filter == 'routine'){ echo 'selected'; } ?>>พนักงานประจำ</option>
						<option value="contract" <?php if($filter == 'contract'){ echo 'selected'; } ?>>พนักงานสัญญาจ้าง</option>
                        <option value="outsource" <?php if($filter == 'outsource'){ echo 'selected'; } ?>>พนักงานบริการนอกสถานที่</option>
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>ลำดับที่</th>
					<th>รหัสพนักงาน</th>
					<th>ชื่อ - นามสกุล</th>
                    <th>ประจำไซท์งาน</th>
                    <th>วันเกิด</th>
					<th>เบอร์โทรศัพท์</th>
					<th>ตำแหน่ง</th>
					<th>สถานะ</th>
                    <th>เครื่องมือ</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($connectdb, "SELECT * FROM staffdata WHERE status='$filter' ORDER BY idstaff ASC");
				}else{
					$sql = mysqli_query($connectdb, "SELECT * FROM staffdata ORDER BY idstaff ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">Data Tidak Ada.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['idstaff'].'</td>
							<td><a href="profile.php?idstaff='.$row['idstaff'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['namestaff'].'</a></td>
                            <td>'.$row['onsite'].'</td>
                            <td>'.$row['birthday'].'</td>
							<td>'.$row['telephone'].'</td>
                            <td>'.$row['position'].'</td>
							<td>';
							if($row['status'] == 'routine'){
								echo '<span class="label label-success">routine</span>';
							}
                            else if ($row['status'] == 'contract' ){
								echo '<span class="label label-info">contract</span>';
							}
                            else if ($row['status'] == 'outsource' ){
								echo '<span class="label label-warning">outsource</span>';
							}
						echo '
							</td>
							<td>

								<a href="edit.php?idstaff='.$row['idstaff'].'" title="แก้ไขข้อมูล" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="password.php?idstaff='.$row['idstaff'].'" title="เปลี่ยน Password" data-placement="bottom" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&idstaff='.$row['idstaff'].'" title="ลบข้อมูล" onclick="return confirm(\'คุณต้องการลบข้อมูล '.$row['namestaff'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy; copy right 2016</p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
