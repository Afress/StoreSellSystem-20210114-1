<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>建立文章</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="css/newArticle/newArticle.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>	
<div id="banner-wrapper"></div>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
			<ul>
				<li><a href="article.html" accesskey="1" title="">Homepage</a></li>
				<li><a href="forum.php" accesskey="2" title="">internet forum</a></li>
				<li><a href="login.php" accesskey="4" title="">UserData</a></li>
				<li><a href="contact.html" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
</div>
<div class=formPage>	
<h2 style="line-height: 1.5em;">新建文章</h2>
<?php
	session_start();  // 啟動交談期
	if(!isset($_SESSION["login_session"])){
		echo ('<script language="JavaScript">
	    alert("請先登入再進行建立文章操作");location.replace("login.php");
		</script>');
	}
	
	$id = "";$title = "";$username="";$jpgName = NULL;$checkAccount="";
	// 取得URL參數的頁數
	if ( isset($_SESSION["userAccount"] ) )
	   $checkAccount = $_SESSION["userAccount"] ;
	if ( isset($_POST["Title"]) )
   		$title = $_POST["Title"];
	if ( isset($_FILES["file"]) )
	   $jpgName = $_FILES["file"]["name"];
	$link =@mysqli_connect(
	   "localhost",
	   "root",
	   "",
	   "userdata"
	);
if  ($title != "")  {
		if($_SESSION["login_session"]==true){
			// 設定SQL查詢字串
	   //送出UTF8編碼的MySQL指令
	   mysqli_query($link,'SET NAMES utf8');
	   // 建立SQL指令字串
	   $sql="SELECT * FROM normaluser WHERE account='".$checkAccount."'"; 
		// 執行SQL查詢
	   $result=mysqli_query($link,$sql);
	   if(empty($result))
		 echo ('<script language="JavaScript">
		   alert("找不到");location.replace("login.php");
			</script>');
		// 計算總頁數
		$total_records=mysqli_num_rows($result);
	   if ( $total_records > 0 ) {
		  $row = mysqli_fetch_assoc($result); // 取回記錄
		  $username = $row['Username']; // 取得欄位name
		  
		  $sql="SELECT Id FROM article";
		  $result=mysqli_query($link,$sql);
		  $total_records=mysqli_num_rows($result);
		  $id=$total_records+1;
		  $sql ="INSERT INTO article  (Id, Title, Username,JpgName,CreateTime) VALUES ('";
		  $sql.=$id."','".$title."','";
		  $sql.=$username."','".$jpgName."','".date("Y-m-d")."')";
		  $result=mysqli_query($link, $sql);
		  if(empty($result))
		 	echo ('<script language="JavaScript">
		    alert("'.$sql.'");location.replace("newArticle.php");
			</script>');
		  $fileName = $title.".txt";  // 檔案名稱
		  $fp = fopen($fileName, "w+");//預建立
		  fclose($fp);  // 關閉檔案

		  if($jpgName!=NULL)
		  {
			if ( copy($_FILES["file"]["tmp_name"],$_FILES["file"]["name"])) {
			  unlink($_FILES["file"]["tmp_name"]);
		    }
		  }
		  
 		  mkdir("./pageArticle/".$id,0700);//建立資料夾存放
		  rename("./".$_FILES["file"]["name"],"./pageArticle/".$id."/".$id.".png");//強制壓縮

		  if (is_writeable($fileName)) {
		   // 開啟新增的檔案
		   $fp = fopen($fileName, "w+");
		   fwrite($fp, $_POST["Content"]);  // 寫入檔案內容
		   fputs($fp, $content, 15);
		   fclose($fp);  // 關閉檔案
		   rename($fileName,"./pageArticle/".$id."/".$fileName);//強制改位置存放
		  }
		 else {
		  echo ('<script language="JavaScript">
		  alert("檔案開啟錯誤");location.replace("forum.php");
		  </script>');
		 }

		  echo ('<script language="JavaScript">
		  alert("建立文章成功");location.replace("forum.php");
		  </script>');
		}
		else
		{
			echo ('<script language="JavaScript">
		   alert("完全沒文章!!預測資料表已損毀");location.replace("newArticle.php");
			</script>');
		}
		   // 關閉資料庫連接  
		mysqli_close($link);	
	}
	else
	{
		echo ('<script language="JavaScript">
	   alert("請先登入再進行建立文章操作");location.replace("login.php");
		</script>');
	}
}	

?>	
	<div id="content"><!--預計已id title username jpgName 欄位-->
		<form action = "newArticle.php" method="post" enctype="multipart/form-data">
		<table border=2>
		   <tr>
		   <td><label class="input" style="color: white;">文章名稱:</label></td>
			<td><input type="text" name="Title" size="15" maxlength="10" style="width:500px;height:20px;"  required/></td>
		   </tr>
		   <tr>
		    <td><label class="input" style="color: white;">上傳圖片:</label></td>
			<td><input type="file" name="file"/></td>
		   </tr>
		   <tr>
		    <td colspan="2">
				<fieldset style="text-align:center;width:90%;position:relative;left:20px">
					<legend>內文說明</legend><!--title作為檔案名稱，裡面存放該textarea 內容-->
					<textarea maxlength="1000" placeholder="上限僅限1000字以內"  name="Content"  style="resize:none;" required></textarea>
				</fieldset>
			</td>
		   </tr>
		   </table>
			<br>
			<input  type="submit" value="建立新文章" />
		</form>
 	</div>
 </div>
</body>
</html>
