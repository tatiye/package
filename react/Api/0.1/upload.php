<?php 
use wolf05\helper\tatiyeNet;
$db=new tatiyeNet();
$conn=$db->PDO();
$Text=tatiyeNet::Text();
$data = json_decode(file_get_contents("php://input"));
$row= tatiyeNet::fetch('app_user','*',"id='".$data->user_id."'");
$tabel=tatiyeNet::tn(3);
$arry=array();
        $fileType  = pathinfo($data->imagePath, PATHINFO_EXTENSION);
        $folderPath =tatiyeNet::etcFolder('drive/foto/');
        $image_parts = $data->nama_file;
        $image_base64 = base64_decode($image_parts);
        $Namefile =tatiyeNet::tm(). '.'.$fileType;
        $file = $folderPath . $Namefile;
        file_put_contents($file, $image_base64);
if (!empty($row['id'])) {
	foreach ($data as $key => $value) {
       if ($key !=='nama_file') {
      	 $arry[$key]=$value;
        } 
	}
	$date=array(
		'nama_file'=>$Namefile,
		'date'=>tatiyeNet::dt('EN'),
		'time'=>tatiyeNet::tm(),
	);
	$result=$db->que(array_merge($arry,$date))->insert($tabel);

	$val['status']='sukses';
} else {
	$val['status']='errors';
}

 http_response_code(200);
 echo json_encode($val);