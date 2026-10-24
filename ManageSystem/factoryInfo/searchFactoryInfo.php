<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查詢廠商資料</title>
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
<h2 style="line-height: 1.5em;">查詢廠商資料</h2>
<?php
	// 取得URL參數的頁數
session_start();  // 啟用交談期
if (isset($_POST["Search"])) {
   // 建立SQL字串
   $sql = "SELECT factory.factory_name,factory.factory_phone,factory_detail.factory_person FROM factory INNER JOIN factory_detail ON factory.factory_phone=factory_detail.factory_phone ";
   // 檢查是否輸入姓名
   if (chop($_POST["factory_name"]) != "" )
      $name = "factory.factory_name LIKE '%".$_POST["factory_name"]."%' ";
   else
      $name = "";
   // if條件組合SQL字串
   if ( chop($name) != "" && chop($tel) != "")
      $sql.= "WHERE ".$name ;
   elseif ( chop($name) != "" )  // 只有姓名
          $sql .= " WHERE ".$name;
   $sql.= " ORDER BY factory.factory_name";  // 最後加上排序
   $_SESSION["SQL"] = $sql;
   header("Location: factoryInfo.php");  // 轉址
}
?>	
	<div id="content">
		<form action = "searchFactoryInfo.php" method="post">
		<table border=2>
			<tr>
		   <td><label class="input" style="color: white;">廠商名稱:</label></td>
			<td><input type="text" name="factory_name" size="10" maxlength="10" style="width:200px;height:20px;"  /></td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" name="Search" value="搜尋" />
		</form>
 	</div>
 </div>
</body>
</html>
