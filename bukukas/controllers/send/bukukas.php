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
  #| @Date  Senin 23 Oktober 2023, 01:34:22 PM                                     
  if($segmen == "insert") {                                                        
  $val=tatiye::validation([                                                        
     "bk1"=>tatiye::val("text",$_POST["bk1"]   ,"1|Wajib diisi"),                  
     "bk2"=>tatiye::val("text",$_POST["bk2"]   ,"1|Wajib diisi"),                  
     "bk3"=>tatiye::val("text",$_POST["bk3"]   ,"1|Wajib diisi"),                  
     "bk4"=>tatiye::val("text",$_POST["bk4"]   ,"1|Wajib diisi"),                  
     "bk5"=>tatiye::val("text",$_POST["bk5"]   ,"1|Wajib diisi"),                  
  ]);                                                                              
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "aktifitas"    =>$_POST["bk1"],                                             
       "tanggal"      =>$_POST["bk2"],                                               
       "kas"          =>$kas,
       "saldo"        =>$saldo,                                               
       "sumber"       =>$_POST["bk4"],                                                
       "keterangan"   =>$_POST["bk5"],                                            
       "time"         =>tatiye::tm(),                                                    
       "date"         =>tatiye::dt("EN"),                                                
       "bulan"        =>tatiye::Ft('M',$_POST["bk2"]),                                                 
       "tahun"        =>tatiye::Ft('Y',$_POST["bk2"]),                                                 
       "userid"       =>$setUId,                                                         
      );                                                                           
      $result=$db->que($data)->insert("bukukas");                                  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  #|-----------------------------------------------                                
  #| Initializes  SEGMENT UPDATE                                                   
  #|-----------------------------------------------                                
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Senin 23 Oktober 2023, 01:34:22 PM                                     
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
