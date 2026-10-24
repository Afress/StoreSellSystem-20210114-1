<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>成功更新上下架狀態</title>
</head>
<body>
<?php

if ( isset($_GET["id"]) ) 
{
	$id=$_GET["id"];
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	$type=$_GET["state"];
	echo $type;
	if($type==0){
		$type=1;
	}else{
		$type=0;
	}
	// 執行SQL查詢
	$sql = "UPDATE sell_item SET item_state='".$type."' WHERE item_barcode='".$id."'";
	if(mysqli_query($link, $sql)){
	  echo ('<script language="JavaScript">
	   alert("修改成功");location.replace("sell_itemInfo.php?updateSelling=1");
	  </script>');
	}
}
	
?>
</body>
</html>
