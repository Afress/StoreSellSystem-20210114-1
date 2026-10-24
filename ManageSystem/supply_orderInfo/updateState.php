<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>更新上下架狀態</title>
</head>
<body>
<?php
session_start();  // 啟動交談期

if(isset($_GET["state"]))
	$type=$_GET["state"];

if($type==3)//for 判斷條件離開
{
		  unset($_SESSION["state"]);
		unset($_SESSION["id"]);
		unset($_SESSION["num"]);
	  echo ('<script language="JavaScript">
	   alert("沒有修改到貨狀態");location.replace("supply_orderInfo.php?updateState=2");
	  </script>');
}
	
if ( isset($_GET["state"]) ) 
{
	$link =@mysqli_connect(
	   "localhost",
	   "manager",
	   "gsshop2020",
	   "productmanage"
	);

	// 執行SQL查詢

	if(isset($_GET["state"]))
		$type=$_GET["state"];

	if($type==3)
	{
		  unset($_SESSION["state"]);
		unset($_SESSION["id"]);
		unset($_SESSION["num"]);
		  echo ('<script language="JavaScript">
		   alert("沒有修改到貨狀態");location.replace("supply_orderInfo.php?updateState=2");
		  </script>');
	}
	else if($type==4)
	{
		$type=$_SESSION["state"];
		$id=$_SESSION["id"];
		$addNum=$_SESSION["num"];
		$type=$_SESSION["state"];
		if($type==0||$type==2){
			$type=1;
		}else{
			echo ('<script language="JavaScript">
		   alert("這筆已經到貨過了，不允許更改狀態");location.replace("supply_orderInfo.php?updateState=2");
		  </script>');
		}
		unset($_SESSION["state"]);
		
		$sql="SELECT * FROM supply_index WHERE purchase_code='".$id."'";
		$result = mysqli_query($link, $sql); // 執行SQL指令
		$row = mysqli_fetch_assoc($result); // 取回記錄
		$item_barcode = $row['item_barcode']; // 取得欄位name

		$sql = "UPDATE supply_order SET purchase_state='".$type."' WHERE purchase_code='".$id."'";
		mysqli_query($link, $sql);
		if(mysqli_query($link, $sql)){
		  echo ('<script language="JavaScript">
		   alert("修改狀態成功");location.replace("supply_orderInfo.php?updateState=1");
		  </script>');
		}

		$sql1 = "SELECT item_num FROM sell_item WHERE item_barcode='".$item_barcode."'";
		mysqli_query($link, $sql1);
		$result = mysqli_query($link, $sql1); // 執行SQL指令
		$row = mysqli_fetch_assoc($result); // 取回記錄
		$num = $row['item_num'];  // 取得欄位tel
		$num=$num+$addNum;
		$sql2 = "UPDATE sell_item SET item_num='".$num."' WHERE item_barcode='".$item_barcode."'";
		if(mysqli_query($link, $sql2))
		{
			echo ('<script language="JavaScript">
			alert("成功變更庫存數量");location.replace("supply_orderInfo.php?updateState=2");
			</script>');	
		}
		else{
			echo ('<script language="JavaScript">
			alert("新增失敗銷售資料");location.replace("supply_orderInfo.php?updateState=2");
			</script>');
		}
	}
	else if($type!=1)
	{
		$id=$_GET["id"];
		$addNum=$_GET["num"];
		 $_SESSION["state"]=$type;
		$_SESSION["id"]=$id;
		$_SESSION["num"]=$addNum;

		echo ('<script language="JavaScript">
		var yes2=confirm("確定修改?");
		if (yes2==false) {location.replace("updateState.php?state=3");} 
		else{location.replace("updateState.php?state=4");}
		</script>');
	}
	


}
?>
</body>
</html>
