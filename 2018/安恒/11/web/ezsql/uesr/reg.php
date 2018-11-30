<?php
include_once('../config/sys_config.php');
require_once('../header.php');
$input_error = $name_error ="";

    if(isset($_SESSION['name_error']) && $_SESSION['name_error'] != ''){
        $name_error = $_SESSION['name_error'];
        $_SESSION['name_error'] = '';
    }
  
    if(isset($_SESSION['input_error']) && $_SESSION['input_error'] != '') {
        $input_error = $_SESSION['input_error'];
        $_SESSION['input_error'] = '';
    }
?>
<form class="bs-example form-horizontal" action="regCheck.php" method="post" name="reg">
	<legend>????????????</legend>
	<div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">????????????</label>
        <div class="col-lg-3">
            <input type="text" name="username" class="form-control" id="inputEmail" placeholder="Username">
            <?php echo  $name_error;?>
        </div>
	</div>
    <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">???????????????</label>
        <div class="col-lg-3">
            <input type="password" name="New_pass" class="form-control" id="inputEmail" placeholder="Password">
        </div>
	</div>
	<div class="form-group">
		<label for="inputEmail" class="col-lg-2 control-label" >???????????????</label>
        <div class="col-lg-3">
			<input type="password" name="Re_pass" class="form-control" id="inputEmail" placeholder="Re_Password"">
            <?php echo  $input_error; ?>
        </div>
        <label class="col-lg-12" style="margin-top:15px; height:40px;  right:-323px" >
        <input type="submit" name="submit" class="btn btn-success" value="??????"/>
        &nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="reset" name="reset" class="btn btn-warning" value="??????"/></label>
    </div>				  
</form>
<?php
require_once('../Trim.php');
?>
