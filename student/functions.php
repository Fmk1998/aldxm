<?php
    @session_start();//�����Ự
?>
<?php
function uploadFile($filename,$path,$typelist=null){
	//��ȡ�ϴ��ļ�����
	$upname = $_FILES[$filename];
	if(empty($typelist)){
		$typelist = array("application/x-zip-compressed","application/octet-stream","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document");//�����ϴ����ļ�����
	}

	$result=array("error" => false);//��ŷ��صĽ��
	if($upname["error"] > 0){
		switch ($upname["error"]) {
			case '1':
				$result["info"]="�ϴ��ļ��Ĵ�С����Լ��ֵ!";
				break;

			case '2':
				$result["info"]="�ϴ��ļ��Ĵ�С��������Լ��ֵ!";
				break;

			case '3':
				$result["info"]="�ļ������ϴ�!";
				break;

			case '4':
				$result["info"]="û���ϴ��κ��ļ�!";
				break;
			
			default:
				$result["info"]="δ֪����!";
				break;
			}
			return $result;
	}

	if ($upname["size"]>11000000) {
		$result["info"]="�ϴ��ļ�����";
		return $result;
	}

	if (!in_array($upname["type"], $typelist)) {
		$result["info"]="�ϴ��ļ����Ͳ����ϣ�".$upname["type"];
		return $result;
	}

	//Ϊ�ļ�����һ���������
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
			$result["info"]="�ϴ�ʧ��";
		}
	}
	else{
		$result["info"]="����һ���ϴ����ļ�";
	}
	return $result;
}