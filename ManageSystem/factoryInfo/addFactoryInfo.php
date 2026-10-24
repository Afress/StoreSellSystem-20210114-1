<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增廠商資料</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="css/edit/edit.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>	
<div id="banner-wrapper"></div>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
			<ul>
				<li><a href="../sellGoods.html" accesskey="1" title="">庫存商品管理</a></li>
				<li><a href="../factoryInfo/factoryInfo.php" accesskey="2" title="">廠商資料管理</a></li>
			</ul>
		</div>
	</div>
</div>
<div class=formPage>	
<h2 style="line-height: 1.5em;">新增廠商負責人資料</h2>
<?php
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	if (isset($_POST["factory_name"]) && isset($_POST["factory_phone"]) && isset($_POST["factory_person"])) 
	{
   $name = $_POST["factory_name"];
   $phone = $_POST["factory_phone"];
   $person = $_POST["factory_person"];
   // 檢查是否有輸入欄位資料
   if ($name != "" && $phone != ""&& $person != "") {
      // 建立SQL字串
      $sql = "INSERT INTO factory_detail (factory_phone, factory_person) values('";
      $sql.= $phone."', '".$person."')";   
	  mysqli_query($link, $sql);
	  $sql = "INSERT INTO factory (factory_name, factory_phone) values('";
      $sql.= $name."', '".$phone."')";   
      if (mysqli_query($link, $sql) ) { // 執行SQL指令
		echo ('<script language="JavaScript">
	   	alert("新增成功");location.replace("factoryInfo.php");
	  	</script>');
      }
   mysqli_close($link);
   }
   };
?>	
	<div id="content">
		<form action = "addFactoryInfo.php" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">廠商名稱:</label></td>
			<td><input type="text" name="factory_name" size="10" maxlength="10" style="width:200px;height:20px;"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">廠商電話:</label></td>
			<td><input type="text" name="factory_phone" size="10" maxlength="10" style="width:200px;height:20px;" required /></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">廠商負責人:</label></td>
			<td><input type="text" name="factory_person" size="5" maxlength="5" style="width:200px;height:20px;"  required /></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="新增" />
		</form>
 	</div>
 </div>
</body>
</html>
