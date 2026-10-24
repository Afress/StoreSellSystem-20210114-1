<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查詢庫存商品資料</title>
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
<h2 style="line-height: 1.5em;">查詢庫存商品資料</h2>
<?php
	// 取得URL參數的頁數
session_start();  // 啟用交談期
if (isset($_POST["Search"])) {
   // 建立SQL字串
   $sql = "SELECT * FROM sell_item ";
   // 檢查是否輸入姓名
   if (chop($_POST["item_name"]) != "" )
      $name = "sell_item.item_name LIKE '%".$_POST["item_name"]."%' ";
   else
      $name = "";
   // if條件組合SQL字串
   if ( chop($name) != "" )
      $sql.= "WHERE ".$name ;
   $sql.= " ORDER BY sell_item.item_name";  // 最後加上排序
   $_SESSION["SQL"] = $sql;
   header("Location: sell_itemInfo.php");  // 轉址
}
?>	
	<div id="content">
		<form action = "searchItemInfo.php" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">庫存商品名稱:</label></td>
			<td><input type="text" name="item_name" size="10" maxlength="20" style="width:200px;height:20px;"  /></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" name="Search" value="搜尋" />
		</form>
 	</div>
 </div>
</body>
</html>
