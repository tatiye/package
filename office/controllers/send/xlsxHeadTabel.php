<?php                                                                                     
  use app\tatiye;                                                                    
  $Text=tatiye::Text();                                                              
  $db=new tatiye();                                                                  
  $setId=$_SERVER["HTTP_KEY"];                                                       
  $from=json_decode($_SERVER["HTTP_FROM"], true);
  $setUId=$_SERVER["HTTP_USERID"];                                                   
  if (is_numeric($setId)) {                                                          
   $segmen="update";                                                                 
  } else {                                                                           
   $segmen="insert";                                                                 
  }                                                                                  
  #|-------------------------------------                                            
  #| Initializes SEGMENT INSERT                                                      
  #|-------------------------------------                                            
  #| Develover Tatiye.Net 2023                                                       
  #| @Date  Rabu 25 Oktober 2023, 11:23:16 AM                                        

foreach ($from as $key => $value) {
    if ($value !=='A1') {
        $asosiatif["$value"] =tatiye::val('text',$_POST["$key"] ,'2|Wajib diisi');
        $asosiatif2["$value"] =$_POST["$value"];

    }
 
}
  foreach ($asosiatif as $key => $value) {
     if ($value=='valid') {
       $val['sukses'][$key] = $value; 
     } else {
       $val['error'][$key] = $value; 
     }
  }







  if (empty($val["error"])) {                                                        
     $data = array(                                                                
       "time"     =>tatiye::tm(),                                                    
       "date"     =>tatiye::dt("EN"),                                                
       "bulan"    =>tatiye::dt("M"),                                                 
       "tahun"    =>tatiye::dt("Y"),                                                 
      );                                                                             
      $val["hasil"]    ="sukses";                                                                      
  } else {                                                                           
      $val["hasil"]    ="error";                                                     
   };                                                                                
      $val["data"]    =$from;                                                     
                                                                               
   echo json_encode($val);                                                           
