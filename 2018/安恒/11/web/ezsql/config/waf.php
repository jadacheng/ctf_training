<?php
	
	function waf($str){
		$black_str = "/(and|into|or|union|sleep|select|substr|order|left|right|order|by|where|rand|exp|updatexml|insert|update|dorp|delete|[|]|[&])/i";
		$str = preg_replace($black_str, "@@",$str);
		return addslashes($str);
	}
	
	function waf_exec($str){
	$black_str = "/(;|&|>|}|{|%|#|!|\?|@|\+|\/| )/i";
		$str = preg_replace($black_str, "",$str);
		return $str;
	}

?>
