
<html>
<head>
	<title>图片上传</title>
</head>
<body>
<!--enctype="multipart/from-data"用来确保匿名上传图片的正确编码-->
<form action="" enctype="multipart/form-data" method="post" 
name="uploadfile">上传文件：<input type="file" name="upfile" /><br> 
<input type="submit" value="上传" /></form> 

<?php
	if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
	$upfile=$_FILES["upfile"];

	$name=$upfile["name"];
	$type=$upfile["type"];
	$size=$upfile["size"];
	$tmp_name=$upfile["tmp_name"]; //文件上传的临时存放地点


	//判断上传文件是否为图片
	switch ($type) {
		case 'image/jpg':
			$okType=true;
			break;
		case 'image/png':
			$okType=true;
			break;
		case 'image/jpeg':
			$okType=true;
			break;
		case 'image/gif':
			$okType=true;
			break;
	}

	//确定上传的文件是图片后，进行判定上传是否符合规则
	if($okType){
		$error=$upfile["error"]; //上传后系统返回的值
		echo "<b>-----------------<br>";

		echo "<b>上传图片的名称是：".$name."<br>";
		echo "<b>上传图片的类型是：".$type."<br>";
		echo "<b>上传图片的大小是：".$size."<br>";
		echo "<b>上传后系统返回的值：".$error."<br>";
		echo "<b>文件上欻临时存放的地址：".$tmp_name."<br>";

		echo "<b>开始上传文件<br>";
		echo "<b>-----------------<br>";

		//把上传的临时文件移动到up目录下
		move_uploaded_file($tmp_name, 'up/'.$name);
		$destination="up/".$name;


		echo "上传信息<br>";

		//如果图片上传没有异常
		if($error==0){
			echo "图片预览<br>";
			echo "<img src=".$destination.">";
		}else if($error==1){
			echo "图片大小超过预定大小，在php.ini中设置";
		}else if($error==2){
			echo "图片大小超过列MAX_FILE_SIZE的预定值";
		}else if($error==3){
			echo "图片上传不完整";
		}else if($error==4){
			echo "图片上传失败";
		}else{
			echo "没有选定图片上传";
		}



	}else{
		echo "选择指定格式的图片上传";
	}
}
?>
</body>
</html>
