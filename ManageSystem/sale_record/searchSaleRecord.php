<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查詢銷售資料</title>
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
<h2 style="line-height: 1.5em;">查詢銷售資料</h2>
<?php
	// 取得URL參數的頁數
session_start();  // 啟用交談期
if (isset($_POST["Search"])) {
   // 建立SQL字串
	$sql = "SELECT sell_detail.sale_recordNum,sell_detail.item_barcode,sale_record.sale_date FROM sell_detail INNER JOIN sale_record ON sell_detail.sale_recordNum=sale_record.sale_recordNum ";
   // 檢查是否輸入姓名
   if (chop($_POST["sale_recordNum"]) != "" )
      $recordNum = "sale_record.sale_recordNum LIKE '%".$_POST["sale_recordNum"]."%' ";
   else
      $recordNum = "";
   // if條件組合SQL字串
   if ( chop($recordNum) != "")
      $sql.= "WHERE ".$recordNum ;
   $sql.= " ORDER BY sell_detail.sale_recordNum";  // 最後加上排序
   $_SESSION["SQL"] = $sql;
   header("Location: sale_record.php");  // 轉址
}
?>	
	<div id="content">
		<form action = "searchSaleRecord.php" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">流水號:</label></td>
			<td><input type="text" name="sale_recordNum" size="10" maxlength="6" style="width:200px;height:20px;" required /></td>
		   </tr>
		 </table>
			<br>
		<input  type="submit" name="Search" value="搜尋" />
		</form>
 	</div>
 </div>
</body>
</html>
