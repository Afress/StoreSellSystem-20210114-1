<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更改叫貨資料</title>
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
<h2 style="line-height: 1.5em;">修改叫貨資料</h2>
<?php
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	$id ="";
	$id .= $_GET["id"];  // 取得URL參數的編號
	$action =$_GET["action"];  // 取得操作種類
switch ($action) {
   case "update": // 更新操作   
   		$code = $_POST['purchase_code']; // 取得欄位name
		$num = $_POST['purchase_num'];  // 取得欄位tel
		$price = $_POST['purchase_price']; // 取得欄位name
		$date = $_POST['purchase_date']; // 取得欄位name
		$state = $_POST['purchase_state']; // 取得欄位name
		$factory_name = $_POST['factory_name']; // 取得欄位name
		
		$sql = "UPDATE supply_order SET purchase_num='".$num."',purchase_price='".$price."',factory_name='".$factory_name."' WHERE purchase_code='".$code."'";
		if(mysqli_query($link, $sql)){
		  echo ('<script language="JavaScript">
		   alert("修改成功");location.replace("supply_orderInfo.php?updateState=1");
		  </script>');
		  break;
	  	}
   case "del":    // 刪除操作
	  $sql = "DELETE FROM sell_item WHERE item_selling ='".$id."' and item_barcode ='".$id."'";
		echo $sql;
	  if(mysqli_query($link, $sql)){
		echo ('<script language="JavaScript">
	    alert("刪除成功");location.replace("supply_orderInfo.php?updateState=1");
	  	</script>');
		  break;
	  }
	    // 執行SQL指令
   case "edit":   // 編輯操作
      $sql="SELECT * FROM supply_order WHERE purchase_code='".$id."'";
      $result = mysqli_query($link, $sql); // 執行SQL指令
      $row = mysqli_fetch_assoc($result); // 取回記錄
      	$code = $row['purchase_code']; // 取得欄位name
		$num = $row['purchase_num'];  // 取得欄位tel
		$price = $row['purchase_price']; // 取得欄位name
		$date = $row['purchase_date']; // 取得欄位name
		$state = $row['purchase_state']; // 取得欄位name
		$factory_name = $row['factory_name']; // 取得欄位name
		break;
}// 顯示編輯表單
	  mysqli_close($link);
?>	
	<div id="content">
		<form action = "edit.php?action=update" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">流水號:(唯讀)</label></td>
			<td><input type="text" name="purchase_code" size="10" maxlength="6" style="width:200px;height:20px;"  value="<?php echo $code; ?>" readonly="readonly"/></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">單件總數量:</label></td>
			<td><input type="number" name="purchase_num" size="5" maxlength="6" style="width:200px;height:20px;" value="<?php echo $num; ?>" required /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">單品批發價:</label></td>
			<td><input type="number" name="purchase_price" size="5" maxlength="6" style="width:200px;height:20px;" value="<?php echo $price; ?>" required /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">叫貨日期:(唯讀)</label></td>
			<td><input type="date" name="purchase_date" size="5" maxlength="6" style="width:200px;height:20px;" value="<?php echo $date; ?>" readonly="readonly" /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">叫貨狀態:(唯讀)</label></td>
			<td><input type="text" name="purchase_state" size="10" maxlength="1" style="width:200px;height:20px;" value="<?php echo $state; ?>" readonly="readonly"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">叫貨資料編號:(唯讀)</label></td>
			<td><input type="text" name="purchase_checkID" size="10" maxlength="6" style="width:200px;height:20px;"  value="<?php echo $code; ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">廠商名稱:</label></td>
			<td><input type="text" name="factory_name" size="10" maxlength="15" style="width:200px;height:20px;"  value="<?php echo $factory_name; ?>" required/></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="修改" />
		</form>
 	</div>
 </div>
</body>
</html>
