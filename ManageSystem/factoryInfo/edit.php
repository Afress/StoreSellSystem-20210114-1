<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更改廠商資料</title>
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
<h2 style="line-height: 1.5em;">修改廠商負責人資料</h2>
<?php
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	$id = $_GET["id"];  // 取得URL參數的編號
	$action = $_GET["action"];  // 取得操作種類
switch ($action) {
   case "update": // 更新操作   
	  $phone = $_POST["factory_phone"];
      $person = $_POST["factory_person"];
      $sql = "UPDATE factory_detail SET factory_person='".$person."' WHERE factory_phone='".$phone."'";
      $result =mysqli_query($link, $sql);  // 執行SQL指令
	  echo ('<script language="JavaScript">
	   alert("修改成功");location.replace("factoryInfo.php");
	  </script>');
      break;
   case "del":    // 刪除操作
	  $aphone = $_GET["phone"];  // 取得操作種類
	  $sql = "DELETE FROM factory WHERE factory_name='".$id."'";//要先刪除外鍵才能刪除主鍵
	  mysqli_query($link, $sql);  // 執行SQL指令
	  $sql = "DELETE FROM factory_detail WHERE factory_phone='".$aphone."'";
	  if(mysqli_query($link, $sql)){
		echo ('<script language="JavaScript">
	    alert("修改成功");location.replace("factoryInfo.php");
	  	</script>');
		  break;
	  }
	    // 執行SQL指令
   case "edit":   // 編輯操作
      $sql="SELECT factory_detail.factory_phone,factory_detail.factory_person FROM factory INNER JOIN factory_detail ON factory.factory_phone=factory_detail.factory_phone WHERE factory.factory_name='".$id."'";
      $result = mysqli_query($link, $sql); // 執行SQL指令
      $row = mysqli_fetch_assoc($result); // 取回記錄
      $phone = $row['factory_phone']; // 取得欄位name
      $person = $row['factory_person'];  // 取得欄位tel
}// 顯示編輯表單
	  mysqli_close($link);
?>	
	<div id="content">
		<form action = "edit.php?action=update&id=<? echo $id ?>" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">廠商名稱(唯讀):</label></td>
			<td><input type="text" name="factory_name" size="10" maxlength="10" style="width:200px;height:20px;"  value="<?php echo $id ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">廠商電話(唯讀):</label></td>
			<td><input type="text" name="factory_phone" size="10" maxlength="10" style="width:200px;height:20px;" required value="<?php echo $phone ?>" readonly="readonly"/></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">廠商負責人:</label></td>
			<td><input type="text" name="factory_person" size="5" maxlength="5" style="width:200px;height:20px;"  required value="<?php echo $person ?>"/></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="修改" />
		</form>
 	</div>
 </div>
</body>
</html>
