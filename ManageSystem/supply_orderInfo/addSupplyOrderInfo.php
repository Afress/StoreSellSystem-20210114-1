<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增叫貨資料</title>
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
<h2 style="line-height: 1.5em;">新增叫貨資料</h2>
<?php
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	
	$sql = "SELECT * FROM supply_order";
	// 執行SQL查詢
	$result = mysqli_query($link, $sql);	//取得資料
	$total_records=mysqli_num_rows($result);  // 取得記錄數
	$len=strlen($total_records);//取得字元長度
	$New_recordNum="";//設定為字串使可以固定長度
	for	 ($i=0;$i<(6-$len);$i++)
	{
		$New_recordNum.='0';
	}
	$New_recordNum.=$total_records+1;
	
	if (isset($_POST["purchase_code"]) && isset($_POST["item_barcode"]) && isset($_POST["purchase_num"])&& isset($_POST["purchase_price"])&& isset($_POST["purchase_date"])&& isset($_POST["purchase_state"])&& isset($_POST["purchase_checkID"])&& isset($_POST["factory_name"])) 
	{
      	$code = $_POST['purchase_code']; // 取得欄位name
		$item_barcode="";
      	$item_barcode .= $_POST['item_barcode'];  // 取得欄位tel
		$num = $_POST['purchase_num'];  // 取得欄位tel
		$price = $_POST['purchase_price']; // 取得欄位name
		$date = $_POST['purchase_date']; // 取得欄位name
		$state = $_POST['purchase_state']; // 取得欄位name
		$factory_name = $_POST['factory_name']; // 取得欄位name
		
		$sql2 = "SELECT * FROM sell_item WHERE item_barcode='".$item_barcode."'";
		$result=mysqli_query($link, $sql2);
		$total_records=mysqli_num_rows($result);
		if ($total_records==0) { // 執行SQL指令，且未成功執行
			echo ('<script language="JavaScript">
			alert("未找到該商品");location.replace("addSupplyOrderInfo.php");
			</script>');
			$code="";
		}
		$sql3 = "SELECT * FROM factory WHERE factory_name='".$factory_name."'";
		$result=mysqli_query($link, $sql3);
		$total_records=mysqli_num_rows($result);
		if ($total_records==0) { // 執行SQL指令，且未成功執行
			echo ('<script language="JavaScript">
			alert("未找到該工廠");location.replace("addSupplyOrderInfo.php");
			</script>');
			$code="";
		}
		
		
		echo ('<script language="JavaScript">
		var yes=confirm("確定新增該筆叫貨資訊?");
		if (yes==false) {alert("沒新增叫貨資訊");location.replace("addSupplyOrderInfo.php");}
		</script>');
		
		// 檢查是否有輸入欄位資料
	   if ($code != "" && $item_barcode!= "" && $num != ""&& $price != ""&& $date != ""&& $state != ""&& $factory_name != "") {
		   
		   	$sql3= "SELECT * FROM supply_index WHERE purchase_code='".$code."'";
			$result = mysqli_query($link, $sql3);	//取得資料
			$total_records=mysqli_num_rows($result);  // 取得記錄數
		   	if($total_records>0)
			{
				echo ('<script language="JavaScript">
					alert("重複流水號，請聯絡工程師");location.replace("addSupplyOrderInfo.php");
					</script>');
			}
		  // 建立SQL字串

		    $sql1 = "INSERT INTO supply_order (purchase_code , purchase_num, purchase_price, purchase_date, purchase_state, purchase_checkID,factory_name ) values('";
		    $sql1.= $code."', '".$num."', '".$price."', '".$date."', '".$state."', '".$code."', '".$factory_name."')";   
		  	mysqli_query($link, $sql1);
		 	$sql4 = "INSERT INTO supply_index (purchase_code,item_barcode) values( '";
		    $sql4.= $code."', '".$item_barcode ."')";   
		   	if(mysqli_query($link, $sql4))
			{
			echo ('<script language="JavaScript">
			alert("成功新增");location.replace("supply_orderInfo.php?updateState=1");}
			</script>');	
			}
  	 	  mysqli_close($link);
   		}
   };
?>	
	<div id="content">
		<form action = "addSupplyOrderInfo.php" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">流水號:(唯讀)</label></td>
			<td><input type="text" name="purchase_code" size="10" maxlength="6" style="width:200px;height:20px;"  value="<?php echo $New_recordNum; ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品條碼:</label></td>
			<td><input type="text" name="item_barcode" size="10" maxlength="15" style="width:200px;height:20px;" required /></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">單件總數量:</label></td>
			<td><input type="number" name="purchase_num" size="5" maxlength="6" style="width:200px;height:20px;"  required /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">單品批發價:</label></td>
			<td><input type="number" name="purchase_price" size="5" maxlength="6" style="width:200px;height:20px;"  required /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">叫貨日期:</label></td>
			<td><input type="date" name="purchase_date" size="5" maxlength="6" style="width:200px;height:20px;"  required /></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">叫貨狀態:(唯讀，預設尚未到貨)</label></td>
			<td><input type="text" name="purchase_state" size="10" maxlength="1" style="width:200px;height:20px;" value=0 readonly="readonly"  required/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">叫貨資料編號:(唯讀)</label></td>
			<td><input type="text" name="purchase_checkID" size="10" maxlength="6" style="width:200px;height:20px;"  value="<?php echo $New_recordNum; ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">廠商名稱:</label></td>
			<td><input type="text" name="factory_name" size="10" maxlength="15" style="width:200px;height:20px;"  required/></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="新增" />
		</form>
 	</div>
 </div>
</body>
</html>
