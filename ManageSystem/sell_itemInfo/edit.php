<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更改庫存商品資料</title>
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
<h2 style="line-height: 1.5em;">修改庫存商品資料</h2>
<?php
	session_start();  // 啟用交談期
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	$id ="";
	if (isset($_GET["id"])) 
		$id = $_GET["id"];
	else
		$id=$_SESSION["id"];
	$action =$_GET["action"];  // 取得操作種類
switch ($action) {
   case "update": // 更新操作   
		$barcode = $_POST["item_barcode"];  // 取得URL參數的編號
      	$num = $_POST['item_num'];  // 取得欄位tel
		$price = $_POST['item_price']; // 取得欄位name
		$name = $_POST['item_name']; // 取得欄位name
		$brand = $_POST['item_brand']; // 取得欄位name
		$type = $_POST['item_type']; // 取得欄位name
		$sql = "UPDATE sell_item SET item_num='".$num."',item_price='".$price."',item_name='".$name."',item_brand='".$brand."',item_type='".$type."' WHERE item_barcode='".$barcode."'";
		if(mysqli_query($link, $sql)){
		  echo ('<script language="JavaScript">
		   alert("修改成功");location.replace("sell_itemInfo.php");
		  </script>');
		  break;
	  	}
   case "del":    // 刪除操作

		$really=$_GET["really"];
		$action =$_GET["action"];  // 取得操作種類
		if($really==2)
		{
			$id=$_SESSION["id"];
			unset($_SESSION["id"]);
		  $sql = "DELETE FROM sell_item WHERE item_selling ='".$id."' and item_barcode ='".$id."'";
		  if(mysqli_query($link, $sql)){
			echo ('<script language="JavaScript">
			alert("刪除成功");location.replace("sell_itemInfo.php?updateSelling=0");
			</script>');
			  
			}
			break;
		}
		else if($really==1)//for 接下來判別用
		{
		  $_SESSION["id"]=$id;
		}
		else if($really==3)//預設沒刪除
		{
			unset($_SESSION["id"]);
			echo ('<script language="JavaScript">
				alert("沒有刪除該庫存商品資料");location.replace("sell_itemInfo.php?updateSelling=0");
				</script>');
		}
	  	echo ('<script language="JavaScript">
		var yes=confirm("確定修改?");
		if (yes==false) {location.replace("edit.php?action=del&really=3");}
		else{location.replace("edit.php?action=del&really=2");}
		</script>');
		break;
	    // 執行SQL指令
   case "edit":   // 編輯操作
      $sql="SELECT * FROM sell_item WHERE item_barcode='".$id."'";
      $result = mysqli_query($link, $sql); // 執行SQL指令
      $row = mysqli_fetch_assoc($result); // 取回記錄
      	$barcode = $row['item_barcode']; // 取得欄位name
      	$num = $row['item_num'];  // 取得欄位tel
		$price = $row['item_price']; // 取得欄位name
		if($row['item_state']==0){
			$state="未上架";
		}else{
			$state="上架";
		}
		$name = $row['item_name']; // 取得欄位name
		$brand = $row['item_brand']; // 取得欄位name
		$type = $row['item_type']; // 取得欄位name
		break;
}// 顯示編輯表單
	  mysqli_close($link);
?>	
	<div id="content">
		<form action = "edit.php?action=update" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">條碼(唯讀):</label></td>
			<td><input type="text" name="item_barcode" size="10" maxlength="15" style="width:200px;height:20px;"  value="<?php echo $barcode ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品數量:</label></td>
			<td><input type="number" name="item_num" size="10" maxlength="6" style="width:200px;height:20px;" required value="<?php echo $num ?>" /></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">單品售價:</label></td>
			<td><input type="number" name="item_price" size="5" maxlength="6" style="width:200px;height:20px;"  required value="<?php echo $price ?>"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">上下架狀態(唯讀):</label></td>
			<td><input type="text" name="item_state" size="10" maxlength="10" style="width:200px;height:20px;"  value="<?php echo $state ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品名稱:</label></td>
			<td><input type="text" name="item_name" size="10" maxlength="20" style="width:200px;height:20px;"  value="<?php echo $name ?>" /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品對應品牌:</label></td>
			<td><input type="text" name="item_brand" size="10" maxlength="20" style="width:200px;height:20px;"  value="<?php echo $brand ?>" /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品對應型號:</label></td>
			<td><input type="text" name="item_type" size="10" maxlength="20" style="width:200px;height:20px;"  value="<?php echo $type ?>" /></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="修改" />
		</form>
 	</div>
 </div>
</body>
</html>
