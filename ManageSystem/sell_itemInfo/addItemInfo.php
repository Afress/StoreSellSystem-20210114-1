<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增庫存商品資料</title>
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
<h2 style="line-height: 1.5em;">新增庫存商品資料</h2>
<?php
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);

	if (isset($_POST["item_barcode"]) && isset($_POST["item_num"]) && isset($_POST["item_price"])&& isset($_POST["item_state"])&& isset($_POST["item_name"])&& isset($_POST["item_brand"])&& isset($_POST["item_type"])) 
	{
      	$barcode = $_POST['item_barcode']; // 取得欄位name
      	$num = $_POST['item_num'];  // 取得欄位tel
		$price = $_POST['item_price']; // 取得欄位name
		$state = $_POST['item_state']; // 取得欄位name
		$name = $_POST['item_name']; // 取得欄位name
		$brand = $_POST['item_brand']; // 取得欄位name
		$type = $_POST['item_type']; // 取得欄位name
		
		$len=strlen($barcode);//取得字元長度
		if($len!=15)
		{
			echo ('<script language="JavaScript">
			alert("條碼長度不成立，請重新輸入");location.replace("addItemInfo.php");
			</script>');
			$barcode="";
		}		
		
   		// 檢查是否有輸入欄位資料
		echo ('<script language="JavaScript">
		var yes=confirm("確定新增?");
		if (yes==false) {location.replace("addItemInfo.php?rel=0");}
		</script>');
		$yes=$_GET['rel'];
	   if ($barcode != "" && $num != ""&& $price != ""&& $state != ""&& $name != ""&& $brand != ""&& $type != ""&&$yes==1) {
		  // 建立SQL字串
		$sql3= "SELECT * FROM sell_item WHERE item_barcode='".$barcode."'";
		$result = mysqli_query($link, $sql3);	//取得資料
		$total_records=mysqli_num_rows($result);  // 取得記錄數
		if($total_records>0)
		{
			echo ('<script language="JavaScript">
				alert("重複條碼，請重新設定條碼");location.replace("addItemInfo.php?rel=0");
				</script>');
		}
	   else{
			$sql = "INSERT INTO sell_item (item_barcode, item_num, item_price, item_state, item_name, item_brand, item_type,item_selling) values('";
			$sql.= $barcode."', '".$num."', '".$price."', '".$state."', '".$name."', '".$brand."', '".$type."', '".$barcode."')";   
			  if (mysqli_query($link, $sql) ) { // 執行SQL指令
				echo ('<script language="JavaScript">
				alert("新增成功");location.replace("sell_itemInfo.php");
				</script>');
			  }
		}


	   mysqli_close($link);
	   }
   };
?>	
	<div id="content">
		<form action = "addItemInfo.php?rel=1" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">條碼:</label></td>
			<td><input type="text" name="item_barcode" size="10" maxlength="15" style="width:200px;height:20px;"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品數量:</label></td>
			<td><input type="number" name="item_num" size="10" maxlength="5" style="width:200px;height:20px;" required /></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">單品售價:</label></td>
			<td><input type="number" name="item_price" size="5" maxlength="6" style="width:200px;height:20px;"  required /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">上下架狀態:(唯讀，預設未上架)</label></td>
			<td><input type="text" name="item_state" size="10" maxlength="3" style="width:200px;height:20px;" value=0 readonly="readonly"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品名稱:</label></td>
			<td><input type="text" name="item_name" size="10" maxlength="20" style="width:200px;height:20px;"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品對應品牌:</label></td>
			<td><input type="text" name="item_brand" size="10" maxlength="20" style="width:200px;height:20px;"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品對應型號:</label></td>
			<td><input type="text" name="item_type" size="10" maxlength="20" style="width:200px;height:20px;"  required/></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="新增" />
		</form>
 	</div>
 </div>
</body>
</html>
