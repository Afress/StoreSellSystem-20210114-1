<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增銷售資料</title>
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
<h2 style="line-height: 1.5em;">新增銷售資料</h2>
<?php
	// 取得URL參數的頁數
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
	
	$sql = "SELECT * FROM sale_record";
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
	if (isset($_POST["sale_recordNum"]) && isset($_POST["item_barcode"]) && isset($_POST["sale_date"])) 
	{
	   $recordNum = $_POST["sale_recordNum"];
	   $barcode = $_POST["item_barcode"];
	   $date = $_POST["sale_date"];
	   $sql = "SELECT item_barcode FROM sell_item WHERE item_barcode='".$barcode."'";
		$result=mysqli_query($link, $sql);
		$total_records=mysqli_num_rows($result);
		if ($total_records==0) { // 執行SQL指令，且未成功執行
		echo ('<script language="JavaScript">
		alert("未找到該商品");location.replace("addSaleRecord.php");
		</script>');
		$barcode="";
		}
		echo ('<script language="JavaScript">
		var yes=confirm("確定新增?");
		if (yes==false) {location.replace("addSaleRecord.php?rel=0");}
		</script>');
		
		$yes=$_GET['rel'];
	    if ($recordNum != "" && $barcode != ""&& $date != ""&&$yes==1) {// 檢查是否有輸入欄位資料
		  // 建立SQL字串
		  $sql = "INSERT INTO sale_record (sale_recordNum, sale_date) values('";
		  $sql.= $recordNum."', '".$date."')";   
		  mysqli_query($link, $sql);
		  $sql = "INSERT INTO sell_detail (item_barcode, sale_recordNum) values('";
		  $sql.= $barcode."', '".$recordNum."')";   
			if(mysqli_query($link, $sql))
			{
			echo ('<script language="JavaScript">
			alert("成功新增");
			</script>');	
			}
			$sql1 = "SELECT item_num FROM sell_item WHERE item_barcode='".$barcode."'";
			mysqli_query($link, $sql1);
			$result = mysqli_query($link, $sql1); // 執行SQL指令
      		$row = mysqli_fetch_assoc($result); // 取回記錄
			$num = $row['item_num'];  // 取得欄位tel
			$num=$num-1;
			$sql2 = "UPDATE sell_item SET item_num='".$num."' WHERE item_barcode='".$barcode."'";
			if(mysqli_query($link, $sql2))
			{
				echo ('<script language="JavaScript">
				alert("成功變更庫存數量");location.replace("sale_record.php");
				</script>');	
			}
			else{
				echo ('<script language="JavaScript">
				alert("新增失敗銷售資料");location.replace("addSaleRecord.php?rel=0");
				</script>');
			}
	   }
	   mysqli_close($link);
	}
?>	
	<div id="content">
		<form action = "addSaleRecord.php?rel=1" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">流水號(唯讀):</label></td>
			<td><input type="text" name="sale_recordNum" size="6" maxlength="10" style="width:200px;height:20px;" value="<?php echo $New_recordNum; ?>" readonly="readonly"/></td>
		   </tr>
			<tr>
		   <td><label class="input" style="color: white;">商品條碼:</label></td>
			<td><input type="text" name="item_barcode" size="15" maxlength="15" style="width:200px;height:20px;" required /></td>
		   </tr>
		   <tr>
		   <td><label class="input" style="color: white;">銷售日期:</label></td>
			<td><input type="date" name="sale_date"  style="width:200px;height:20px;"  required /></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="新增" />
		</form>
 	</div>
 </div>
</body>
</html>
