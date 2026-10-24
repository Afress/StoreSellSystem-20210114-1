<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>謝謝你的留言</title>
</head>
<body>
<?php
	if ( isset($_POST["name"]) )
		$name = "姓名:".$_POST["name"]."\n";
	
	if ( isset($_POST["sex"]) )//單選紐
		$gender = $_POST["sex"];
	switch ($gender) {
	   case "man":
		  $gender="性別：男\n"; break;
	   case "female":
		  $gender="性別：女\n"; break;
	} 
	
	if ( isset($_POST["job"]) )//下拉式
		$job = $_POST["job"];
	switch ($job) {
	   case "work":
		  $job="身分：上班族\n"; break;
	   case "student":
		  $job="身分：學生\n"; break;
	   case "retire":
		  $job="身分：退休\n"; break;
	} 
	if ( isset($_POST["email"]) )
		$email = "電子信箱:".$_POST["email"]."\n";
	
	if ( isset($_POST["error1"]) )//checkbox
		$error = "問題回報：文字錯誤\n";
	if ( isset($_POST["error2"]) )//checkbox
		$error .= "問題回報：文字錯誤\n";
	if ( isset($_POST["error3"]) )//checkbox
		$error .= "問題回報：文字錯誤\n";	
	if ( isset($_POST["error4"]) )//checkbox
		$error .= "問題回報:其他:".$_POST["errorOther"]."\n";		
	if ( isset($_POST["field"]) )
		$field = "詳細資料:\n".$_POST["field"];
	
	$fileName =$_POST["name"].".txt";  // 檔案名稱
	$fp = fopen($fileName, "w+");//預建立
	fclose($fp);  // 關閉檔案
	
	$fileName="./report/".date("Y-m-d")."/";
	if(!file_exists($fileName)){
		mkdir($fileName,0700);//建立資料夾存放
	}
	$fileName=$_POST["name"].".txt";
	if (is_writeable($fileName)) {
		// 開啟新增的檔案
		$fp = fopen($fileName, "w+");
		fwrite($fp, $name);  // 寫入檔案內容
		fwrite($fp, $gender);  // 寫入檔案內容
		fwrite($fp, $job);  // 寫入檔案內容
		fwrite($fp, $email);  // 寫入檔案內容
		fwrite($fp, $error);  // 寫入檔案內容
		fwrite($fp, $field);  // 寫入檔案內容
		fclose($fp);  // 關閉檔案
		rename($fileName,"./report/".date("Y-m-d")."/".$fileName);//強制改位置存放
	}
	else {
		echo ('<script language="JavaScript">
		alert("檔案開啟錯誤");location.replace("contact.html");
		</script>');
	}
	echo ('<script language="JavaScript">
	alert("感謝你的回報");location.replace("contact.html");
	</script>');
?>
</body>
</html>
