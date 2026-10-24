<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>廠商資訊</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="css/factoryInfo/factoryInfo.css" rel="stylesheet" type="text/css" media="all" />
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
<form action="addGuestbook.php" method="post" >
<?php
session_start();  // 啟動交談期
	$id = "";
	// 取得URL參數的頁數;
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);
if  ($id == "")  {
	    $records_per_page = 5;  // 每一頁顯示的記錄筆數
		// 取得URL參數的頁數
		if (isset($_GET["Pages"])) 
			$pages = $_GET["Pages"];
		else
			$pages = 1;
	   mysqli_query($link,'SET NAMES utf8');
	   // 建立SQL指令字串
		if ( isset($_SESSION["SQL"]))
		{
			$sql = $_SESSION["SQL"];
			unset($_SESSION["SQL"]);
		}
		else
			$sql = "SELECT factory.factory_name,factory.factory_phone,factory_detail.factory_person FROM factory INNER JOIN factory_detail ON factory.factory_phone=factory_detail.factory_phone";
		// 執行SQL查詢
		$result = mysqli_query($link, $sql);	//取得資料
		$total_fields=mysqli_num_fields($result); // 取得欄位數
		$total_records=mysqli_num_rows($result);  // 取得記錄數
		// 計算總頁數
		$total_pages = ceil($total_records/$records_per_page);
		// 計算這一頁第1筆記錄的位置
		$offset = ($pages - 1)*$records_per_page;
		mysqli_data_seek($result, $offset); // 移到此記錄
	    echo "<div class=formPage><div id="."content"."><table border=1>";
	    echo"<tr>";
	    echo"<td><label class="."input"." style="."color: white;".">廠商名稱</label></td>
			 <td><label class="."input"." style="."color: white;".">廠商電話</label></td>
			 <td><label class="."input"." style="."color: white;".">廠商負責人</label></td>
			 <td colspan="."2"."><label class="."input"." style="."color: white;".">功能</label></td>";	
	    echo "</tr>";
		$j = 1;
		while ($rows = mysqli_fetch_assoc($result) and $j <= $records_per_page) {
		   echo "<tr>";
		   echo "<td style="."width:130px".">".$rows['factory_name']."</td>"; 
		   echo "<td style="."width:200px".">".$rows['factory_phone']."</td>";
		   echo "<td style="."width:200px".">".$rows['factory_person']."</td>";   
	       echo "<td style="."width:200px"."><a href='edit.php?action=edit&id=";
		   echo $rows['factory_name']."'><b>編輯</b></td>";
      	   echo "<td style="."width:200px"."><a href='edit.php?action=del&id=";
		   echo $rows['factory_name']."&phone=";
		   echo $rows['factory_phone']."'><b>刪除</b></td>";
		   echo "</tr>";
		   $j++;
		}
		echo "</table></div>";
		echo "<div id="."pageCount".">";
		if ( $pages > 1 )  // 顯示上一頁
		   echo "<a href='factoryInfo.php?Pages=".($pages-1).
				"'>上一頁</a>| ";
		for ( $i = 1; $i <= $total_pages; $i++ )
		   if ($i != $pages)
			 echo "<a href=\"factoryInfo.php?Pages=".$i."\">".
				  $i."</a> ";
		   else
			 echo $i." ";
		if ( $pages < $total_pages )  // 顯示下一頁
		   echo "|<a href='factoryInfo.php?Pages=".($pages+1).
        "'>下一頁</a> ";
		echo "</div>";
	
		mysqli_free_result($result);  // 釋放佔用的記憶體
		mysqli_close($link);
}	
?>	
<div id="pageCount">
<a href="addFactoryInfo.php" >新增廠商資料</a>		
|<a href="searchFactoryInfo.php">搜尋廠商資料</a></center>
</form>

</div>

</form>
</body>
</html>
