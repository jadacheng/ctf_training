<?php
include_once('../config/sys_config.php');

if (isset($_SESSION['user_name'])) {
	include_once('../header.php');
	if (!isset($SESSION['user_id'])) {
		$sql = "SELECT * FROM dwvs_user_message WHERE DWVS_user_name ="."'{$_SESSION['user_name']}'";
		$data = mysqli_query($connect,$sql) or die('Mysql Error!!');
		$result = mysqli_fetch_array($data);
		$_SESSION['user_id'] = $result['DWVS_user_id'];
	}

	$html_avatar = htmlspecialchars($_SESSION['user_favicon']);
	
	
	if(isset($_GET['id'])){
		$id=waf($_GET['id']);
		$sql = "SELECT * FROM dwvs_user_message WHERE DWVS_user_id =".$id;
		$data = mysqli_multi_query($connect,$sql) or die();
		
		$result = mysqli_store_result($connect);
		$row = mysqli_fetch_row($result);
		echo '<h1>user_id:'.$row[0]."</h1><br><h2>user_name:".$row[1]."</h2><br><h3>???????????????".$row[4]."</h3>";
		mysqli_free_result($result);
		die();
	}
	mysqli_close($connect);
?>
<div class="row">
	<div style="float:left;">
		<div><h2><?php echo "?????????".$_SESSION['user_name']?></h2>
		</div>	
	</div>
	
	<div style="float:right;padding-right:900px">
		<div><a href="./user.php?id=<?php echo $_SESSION['user_id'];?>"><button type="button" class="btn btn-primary">????????????</button></a></div>
		<br />
		<div><a href="logout.php"><button type="button" class="btn btn-primary">?€€???</button></a></div><br /><br /><br /><br />
	</div>
</div>
<?php 
	require_once('../Trim.php');
}
else {
	not_find($_SERVER['PHP_SELF']);
}
?>
