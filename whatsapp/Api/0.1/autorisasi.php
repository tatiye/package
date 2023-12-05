<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJ3aGF0c2FwcFwvQXBpXC8wLjFcL2F1dG9yaXNhc2kucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="demo";
$keywords="fireid,nama,title,Provinsi,Kabupaten,Kecamatan,deskripsi,Desa,kode,archive,mapId,nama_file,imagePath,id,userid";
//$chart=tatiye::chart("demo","index");
//$chartMonth=tatiye::chartMonth("demo","index",$chart);
$COUNT=tatiye::fetch("demo"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        fireid,nama,title,Provinsi,Kabupaten,Kecamatan,deskripsi,Desa,kode,archive,mapId,nama_file,imagePath,id,userid 
        FROM demo
        WHERE row='1' $search ORDER BY id DESC ".$data["record"];
$record_num = ($val->limit * $val->page) - $val->limit;
$no=$record_num;
$products_arr["limit"]        =$val->limit;
$products_arr["page"]         =$val->page;
$products_arr["total_data"]   =$COUNT["count"];
$products_arr["keywords"]     =$val->page;
$products_arr["total_peging"] =$total_paging;
$products_arr["storage"]      =array();
$result=$db->query($QUERY);
 while($row=$result->fetch_assoc()){
  $no=$no+1;
  $Expuid=tatiye::fetchUserID($row["userid"]);
  $number=array("no"=>$no);
    $sub_array["fireid"] =$row["fireid"];        
    $sub_array["nama"] =$row["nama"];            
    $sub_array["title"] =$row["title"];          
    $sub_array["Provinsi"] =$row["Provinsi"];    
    $sub_array["Kabupaten"] =$row["Kabupaten"];  
    $sub_array["Kecamatan"] =$row["Kecamatan"];  
    $sub_array["deskripsi"] =$row["deskripsi"];  
    $sub_array["Desa"] =$row["Desa"];            
    $sub_array["kode"] =$row["kode"];            
    $sub_array["archive"] =$row["archive"];      
    $sub_array["mapId"] =$row["mapId"];          
    $sub_array["nama_file"] =$row["nama_file"];  
    $sub_array["imagePath"] =$row["imagePath"];  
    $sub_array["id"] =$row["id"];                
    $sub_array["userid"] =$row["userid"];        
  array_push($products_arr["storage"], array_merge($number,$sub_array,$Expuid));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
