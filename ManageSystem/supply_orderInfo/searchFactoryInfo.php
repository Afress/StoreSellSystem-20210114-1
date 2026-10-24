<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查詢回報廠商資料</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="css/edit/edit.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>	
<?php
	// 取得URL參數的頁數
session_start();  // 啟用交談期
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
if (isset($_GET["factoryName"])) 
	$factoryName = $_GET["factoryName"];
if (isset($_GET["state"])) 
	$state = $_GET["state"];
if (isset($_GET["id"])) 
	$id = $_GET["id"];
	
$report=$_GET["report"];

if($report==2)
{	
	$id = $_SESSION["id"];
	$state=$_SESSION["state"];
	$factoryName=$_SESSION["factoryName"];
	$sql = "UPDATE supply_order SET purchase_state='".$state."' WHERE factory_name ='".$factoryName."'  and purchase_code ='".$id."' ";
	mysqli_query($link, $sql);
	unset($_SESSION["id"]);
	unset($_SESSION["factoryName"]);
	unset($_SESSION["state"]);
	echo ('<script language="JavaScript">
	alert("未進行回報廠商動作");location.replace("supply_orderInfo.php?updateState=3");
	</script>');
}
else if($report==3)
{
	$state=$_SESSION["state"];
	$id=$_SESSION["id"];
	$factoryName=$_SESSION["factoryName"];
	if (isset($state)&&isset($factoryName)&&isset($id)) 
	{
	   // 建立SQL字串
	   $sql = "SELECT factory.factory_name,factory.factory_phone,factory_detail.factory_person FROM factory INNER JOIN factory_detail ON factory.factory_phone=factory_detail.factory_phone ";
	   // 檢查是否輸入姓名
	   if ($factoryName!= "" )
		  $name = "factory.factory_name LIKE '%".$factoryName."%' ";
	   else
		  $name = "";
	   // if條件組合SQL字串
	   if ( chop($name) != "")
		  $sql.= "WHERE ".$name ;
	   $sql.= " ORDER BY factory.factory_name";  // 最後加上排序
	   $_SESSION["SQL"] = $sql;
		unset($_SESSION["factoryName"]);
		unset($_SESSION["state"]);
		unset($_SESSION["id"]);
	   header("Location: ../factoryInfo/factoryInfo.php");  // 轉址
	}
}
else
{
	echo ('<script language="JavaScript">
	var yes=confirm("確定回報廠商?");
	if (yes==false) {location.replace("searchFactoryInfo.php?report=2");}
	else {location.replace("searchFactoryInfo.php?report=3");}
	</script>');
	$_SESSION["state"]=$state;
	$_SESSION["id"]=$id;
	$_SESSION["factoryName"]=$factoryName;
	$sql = "UPDATE supply_order SET purchase_state=2 WHERE factory_name ='".$factoryName."' and purchase_code ='".$id."'";
	mysqli_query($link, $sql);
}


?>	
</body>
</html>
