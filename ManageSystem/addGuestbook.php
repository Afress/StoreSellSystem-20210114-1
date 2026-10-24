<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>成功留言</title>
</head>
<body>
<?php
session_start();  // 啟用交談期
if ( isset($_POST["Talk"]) ) {
   $file = "guestbook.txt";
   if ( !file_exists($file) ) { // 檔案不存在
      $fp = fopen($file, "w");  // 建立檔案
      fclose($fp);
   }
   $talk =$_POST["Talk"];  $account="";
   $fp = fopen($file, "a");  // 開啟檔案
	
	$account = $_SESSION["userAccount"] ;
	if(empty($account)){
		echo ('<script language="JavaScript">
   		alert("請先登入");location.replace("login.php");
		</script>');
	}
	$link =@mysqli_connect(
	   "localhost",
	   "root",
	   "",
	   "userdata"
	);
   mysqli_query($link,'SET NAMES utf8');
   $sql="SELECT Username FROM normaluser WHERE account='".$account."'"; 
	// 執行SQL查詢
   $result=mysqli_query($link,$sql);
   $row = mysqli_fetch_assoc($result);
   $name=$row['Username'];
   $today = date("Y年m月d日 h:i:s");
   // 建立留言訊息
   $msg  = "<b>留言時間</b>".$today."<br/>";
   $msg .= "姓名：".$name."<br/>";   
   $msg .= "留言：".$talk."<br/><hr/>";
   fputs($fp, $msg);  // 寫入檔案
   fclose($fp);       // 關閉檔案
	echo ('<script language="JavaScript">
   alert("成功留言");location.replace("forum.php");
	</script>');
}
else
{
	echo ('<script language="JavaScript">
   alert("加入失敗!請聯繫工程師");location.replace("forum.php");
	</script>');	
}
	
	
?>
</body>
</html>
