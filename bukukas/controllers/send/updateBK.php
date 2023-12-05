<?php                                                                                   
  use app\tatiye;                                                                  
  $Text=tatiye::Text();                                                            
  $db=new tatiye();                                                                
  $setId=$_SERVER["HTTP_KEY"];                                                     
  $setUId=$_SERVER["HTTP_USERID"];                                                 
  if (is_numeric($setId)) {                                                        
   $segmen="update";                                                               
  } else {                                                                         
   $segmen="insert";                                                               
  }      

   if ($_POST['bk1']=='Pengeluaran') {
      $kas=$_POST['bk3'];
      $saldo=0;
  } else {
      $kas=0;
      $saldo=$_POST['bk3'];
  }                                                                              
  #|-------------------------------------                                          
  #| Initializes SEGMENT INSERT                                                    
  #|-------------------------------------                                          
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Senin 23 Oktober 2023, 04:13:20 PM                                     
  if ($segmen == "update") {                                                 
    $val=tatiye::validation([                                                      
     "bk1"=>tatiye::val("text",$_POST["bk1"]   ,"1|Wajib diisi"),                  
     "bk2"=>tatiye::val("text",$_POST["bk2"]   ,"1|Wajib diisi"),                  
     "bk3"=>tatiye::val("text",$_POST["bk3"]   ,"1|Wajib diisi"),                  
     "bk4"=>tatiye::val("text",$_POST["bk4"]   ,"1|Wajib diisi"),                  
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "aktifitas"    =>$_POST["bk1"],                                             
       "tanggal"      =>$_POST["bk2"],                                               
       "kas"          =>$kas,
       "saldo"        =>$saldo,                                                   
       "keterangan"   =>$_POST["bk4"],                                            
       "time"         =>tatiye::tm(),                                                  
       "date"         =>tatiye::dt("EN"),                                              
       "bulan"        =>tatiye::Ft('M',$_POST["bk2"]),                                                 
       "tahun"        =>tatiye::Ft('Y',$_POST["bk2"]),                                               
      );                                                                           
      $result=$db->que($data)->update("bukukas","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  } 

$queryUpdate="SELECT saldo,kas,id FROM bukukas ORDER BY tanggal ASC";
$result=$db->query($queryUpdate);
$saldo=0;
while($row=$result->fetch_assoc()){   
if ($row['saldo']==0) { 
  $saldo=$saldo+$row['saldo']-$row['kas'] ;
} else{
  $saldo=$saldo+$row['saldo'];
}
$dataArray = array(                                         
  'total'         =>$saldo,         
);
$result1=$db->que($dataArray)->update('bukukas',"id='".$row['id']."'");
}                                                                              
   echo json_encode($val);                                                         
