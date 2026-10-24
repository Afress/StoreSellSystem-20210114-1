<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>叫貨資料</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="css/supply_orderInfo/supply_orderInfo.css" rel="stylesheet" type="text/css" media="all" />
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
		if (isset($_GET["updateState"]))
			$updateState=$_GET["updateState"];//允許可以更新上下架
		else
			$updateState=0;
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
			$sql = "SELECT supply_index.item_barcode,supply_order.purchase_code,supply_order.purchase_num,supply_order.purchase_price,supply_order.purchase_date,supply_order.purchase_state,supply_order.purchase_checkID,supply_order.factory_name FROM supply_order INNER JOIN supply_index ON supply_index.purchase_code=supply_order.purchase_code";
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
	    echo"<td><label class="."input"." style="."color: white;".">流水號</label></td>
			 <td><label class="."input"." style="."color: white;".">商品條碼</label></td>
			 <td><label class="."input"." style="."color: white;".">單件總數量</label></td>
			 <td><label class="."input"." style="."color: white;".">單品批發價</label></td>
			 <td><label class="."input"." style="."color: white;".">叫貨日期</label></td>
			 <td><label class="."input"." style="."color: white;".">叫貨狀態</label></td>
			 <td><label class="."input"." style="."color: white;".">叫貨資料編號</label></td>
			 <td><label class="."input"." style="."color: white;".">廠商名稱</label></td>
			 <td colspan="."3"."><label class="."input"." style="."color: white;".">功能</label></td>";	
	    echo "</tr>";
		$j = 1;
		while ($rows = mysqli_fetch_assoc($result) and $j <= $records_per_page) {
		   echo "<tr>";
		    echo "<td style="."width:130px".">".$rows['purchase_code']."</td>"; 
		    echo "<td style="."width:200px".">".$rows['item_barcode']."</td>";
		    echo "<td style="."width:200px".">".$rows['purchase_num']."</td>";   
			echo "<td style="."width:130px".">".$rows['purchase_price']."</td>"; 
			echo "<td style="."width:130px".">".$rows['purchase_date']."</td>"; 
			if($rows['purchase_state']==2){
				echo "<td style="."width:130px".">回報廠商中</td>"; 
			}else if($rows['purchase_state']==1){
				echo "<td style="."width:130px".">已到貨</td>"; 
			}else if($rows['purchase_state']==0){
				echo "<td style="."width:130px".">未到貨</td>"; 
			}
			echo "<td style="."width:130px".">".$rows['purchase_checkID']."</td>"; 
			echo "<td style="."width:130px".">".$rows['factory_name']."</td>"; 
			
			if($updateState==1)
			{
			   echo "<td style="."width:200px"."><a href='edit.php?action=edit&id=";
			   echo $rows['purchase_code']."'><b>編輯(unlock)</b></td>";
			   echo "<td style="."width:200px"."><a href=''><b>到貨確認(locked)</b></td>";
			   echo "<td style="."width:200px"."><a href=''><b>回報廠商(locked)</b></td>";
			}
			else if($updateState==2)
			{
				$updateState = $_GET["updateState"];
				$_SESSION["updateState"]=$updateState;
				echo "<td style="."width:200px"."><a href=''><b>編輯(locked)</b></td>";
				echo "<td style="."width:200px"."><a href='updateState.php?id=";
				echo $rows['purchase_code']."&state=";
				echo $rows['purchase_state']."&num=";
				echo $rows['purchase_num']."'><b>到貨確認(unlock)</b></td>";
				echo "<td style="."width:200px"."><a href=''><b>回報廠商(locked)</b></td>";
			}
			else if($updateState==3)
			{
				$updateState = $_GET["updateState"];
				$_SESSION["updateState"]=$updateState;
				echo "<td style="."width:200px"."><a href=''><b>編輯(locked)</b></td>";
				echo "<td style="."width:200px"."><a href=''><b>到貨確認(locked)</b></td>";
				echo "<td style="."width:200px"."><a href='searchFactoryInfo.php?state=";
				echo $rows['purchase_state']."&id=";
				echo $rows['purchase_code']."&factoryName=";
				echo $rows['factory_name']."&report=1'><b>回報廠商(unlock)</b></td>";
			}
		   echo "</tr>";
		   $j++;
		}
		echo "</table></div>";
		echo "<div id="."pageCount".">";
		if ( $pages > 1 )  // 顯示上一頁
		   echo "<a href='supply_orderInfo.php?updateState=".$updateState."&Pages=".($pages-1).
				"'>上一頁</a>| ";
		for ( $i = 1; $i <= $total_pages; $i++ )
		   if ($i != $pages)
			 echo "<a href=\"supply_orderInfo.php?updateState=".$updateState."&Pages=".$i."\">".
				  $i."</a> ";
		   else
			 echo $i." ";
		if ( $pages < $total_pages )  // 顯示下一頁
		   echo "|<a href='supply_orderInfo.php?updateState=".$updateState."&Pages=".($pages+1).
        "'>下一頁</a> ";
		echo "</div>";
	
		mysqli_free_result($result);  // 釋放佔用的記憶體
		mysqli_close($link);
	if($updateState==1)
	{
		echo "<div id="."pageCount".">";
		echo 	"<a href="."addSupplyOrderInfo.php"." >新增叫貨資料</a>";	
		echo 	"|<a href="."searchSupplyOrdeInfo.php?updateState=1".">搜尋叫貨資料</a></center>";
		echo 	"</div>";
	}
	else
	{
		echo "<div id="."pageCount".">";
		echo 	"<a href="."searchSupplyOrdeInfo.php?updateState=".$updateState.">搜尋叫貨資料</a></center>";
		echo 	"</div>";
	}

}	
?>	



</body>
</html>
