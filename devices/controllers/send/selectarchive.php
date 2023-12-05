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
  #|-------------------------------------                                             
  #| Initializes SEGMENT INSERT                                                       
  #|-------------------------------------                                             
  #| Develover Tatiye.Net 2023                                                        
  #| @Date  Jumat 27 Oktober 2023, 10:08:36 PM                                        
  if($segmen == "insert") {                                                           
  $val=tatiye::validation([                                                           
     "doc1"=>tatiye::val("text",$_POST["doc1"]   ,"2|Wajib diisi"),                   
  ]);                                                                                 
  if (empty($val["error"])) {                                                         
     $data = array(                                                                   
       "nama"    =>$_POST["doc1"],                                                    
       "time"   =>tatiye::tm(),                                                       
       "date"   =>tatiye::dt("EN"),                                                   
       "bulan"  =>tatiye::dt("M"),                                                    
       "tahun"  =>tatiye::dt("Y"),                                                    
       "userid" =>$setUId,                                                            
      );                                                                              
      $result=$db->que($data)->insert("apparchive");                                  
      $val["hasil"]    ="sukses";                                                     
      tatiye::apphistory([                                                            
        "autoload"     =>false,                                                       
        "categori"     =>"insert",                                                    
         "title"        =>$_POST["doc1"],                                             
        "description"  =>"description",                                               
        "PrimaryKey"   =>0,                                                           
        "package"      =>"devices",                                                   
        "tabel"        =>"apparchive",                                                
      ]);                                                                             
  } else {                                                                            
      $val["hasil"]    ="error";                                                      
   };                                                                                 
  #|-----------------------------------------------                                   
  #| Initializes  SEGMENT UPDATE                                                      
  #|-----------------------------------------------                                   
  #| Develover Tatiye.Net 2023                                                        
  #| @Date  Jumat 27 Oktober 2023, 10:08:36 PM                                        
  } elseif ($segmen == "update") {                                                    
    $val=tatiye::validation([                                                         
     "doc1"=>tatiye::val("text",$_POST["doc1"]   ,"2|Wajib diisi"),                   
   ]);                                                                                
  if (empty($val["error"])) {                                                         
     $data = array(                                                                   
       "nama"    =>$_POST["doc1"],                                                    
       "time"     =>tatiye::tm(),                                                     
       "date"     =>tatiye::dt("EN"),                                                 
       "bulan"    =>tatiye::dt("M"),                                                  
       "tahun"    =>tatiye::dt("Y"),                                                  
      );                                                                              
      $result=$db->que($data)->update("apparchive","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                     
      tatiye::apphistory([                                                            
        "autoload"     =>false,                                                       
        "categori"     =>"update",                                                    
        "title"        =>$_POST["doc1"],                                              
        "description"  =>"description",                                               
        "package"      =>"devices",                                                   
        "PrimaryKey"   =>$setId,                                                      
        "tabel"        =>"apparchive",                                                
      ]);                                                                             
  } else {                                                                            
      $val["hasil"]    ="error";                                                      
   };                                                                                 
  }                                                                                   
   echo json_encode($val);                                                            
