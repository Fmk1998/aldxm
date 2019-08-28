<?php
    @session_start();//开启会话
?>
<?php
function uploadFile($filename,$path,$typelist=null){
	//获取上传文件名字
	$upname = $_FILES[$filename];
	if(empty($typelist)){
		$typelist = array("application/x-zip-compressed","application/octet-stream","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document");//允许上传的文件类型
	}

	$result=array("error" => false);//存放返回的结果
	if($upname["error"] > 0){
		switch ($upname["error"]) {
			case '1':
				$result["info"]="上传文件的大小超出约定值!";
				break;

			case '2':
				$result["info"]="上传文件的大小超出表单的约定值!";
				break;

			case '3':
				$result["info"]="文件部分上传!";
				break;

			case '4':
				$result["info"]="没有上传任何文件!";
				break;
			
			default:
				$result["info"]="未知错误!";
				break;
			}
			return $result;
	}

	if ($upname["size"]>11000000) {
		$result["info"]="上传文件过大";
		return $result;
	}

	if (!in_array($upname["type"], $typelist)) {
		$result["info"]="上传文件类型不符合！".$upname["type"];
		return $result;
	}

	//为文件产生一个随机名字
	$fileinfo = pathinfo($upname["name"]);
	do{
		$newfile = $_SESSION["login"]["id"].date("mdHi").rand(10,99).".".$fileinfo["extension"];
	}while(file_exists($newfile));

	if(is_uploaded_file($upname["tmp_name"])){
		if (move_uploaded_file($upname["tmp_name"], $path."/".$newfile)) {
			$result["info"]=$newfile;
			$result["error"]=true;
			return $result;
		}
		else{
			$result["info"]="上传失败";
		}
	}
	else{
		$result["info"]="不是一个上传的文件";
	}
	return $result;
}