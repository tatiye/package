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
  #| @Date  Senin 13 November 2023, 03:34:41 PM                                    
  if($segmen == "insert") {                                                        
  $val=tatiye::validation([                                                        
     "post1"=>tatiye::val("text",$_POST["post1"]   ,"1|Wajib diisi"),              
     "post2"=>tatiye::val("text",$_POST["post2"]   ,"1|Wajib diisi"),              
     "post3"=>tatiye::val("text",$_POST["post3"]   ,"1|Wajib diisi"),              
     "post4"=>tatiye::val("text",$_POST["post4"]   ,"1|Wajib diisi"),              
  ]);                                                                              
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "title"          =>$_POST["post1"],                                               
       "categori"       =>$_POST["post2"],                                            
       "pubDate"        =>tatiye::Ft('HTGL',$_POST["post3"]),                                             
       "detail"         =>$_POST["post4"],                                              
       "description"    =>strip_tags($Text->shorten([$_POST["post4"],'250'])),                                              
       "link"           =>tatiye::dt("EN").'/'.$Text->replace([$_POST["post1"],'-']),                
       "segment"        =>'Tatiye',                                                    
       "time"   =>tatiye::tm(),                                                    
       "date"   =>tatiye::dt("EN"),                                                
       "bulan"  =>tatiye::dt("M"),                                                 
       "tahun"  =>tatiye::dt("Y"),                                                 
       "userid" =>$setUId,                                                         
      );                                                                           
      $result=$db->que($data)->insert("appnews");                                  
      $val["hasil"]    ="sukses";                                                  
      tatiye::apphistory([                                                         
        "autoload"     =>false,                                                    
        "categori"     =>"insert",                                                 
         "title"        =>$_POST["post1"],                                         
        "description"  =>"description",                                            
        "PrimaryKey"   =>0,                                                        
        "package"      =>"postingan",                                              
        "tabel"        =>"appnews",                                                
      ]);                                                                          
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  #|-----------------------------------------------                                
  #| Initializes  SEGMENT UPDATE                                                   
  #|-----------------------------------------------                                
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Senin 13 November 2023, 03:34:41 PM                                    
  } elseif ($segmen == "update") {                                                 
    $val=tatiye::validation([                                                      
     "post1"=>tatiye::val("text",$_POST["post1"]   ,"1|Wajib diisi"),              
     "post2"=>tatiye::val("text",$_POST["post2"]   ,"1|Wajib diisi"),              
     "post3"=>tatiye::val("text",$_POST["post3"]   ,"1|Wajib diisi"),              
     "post4"=>tatiye::val("text",$_POST["post4"]   ,"1|Wajib diisi"),              
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "title"          =>$_POST["post1"],                                               
       "categori"       =>$_POST["post2"],                                            
       "pubDate"        =>tatiye::Ft('HTGL',$_POST["post3"]),                                             
       "detail"         =>$_POST["post4"],                                              
       "description"    =>strip_tags($Text->shorten([$_POST["post4"],'250'])),                                              
       "link"           =>tatiye::dt("EN").'/'.$Text->replace([$_POST["post1"],'-']),   
       "segment"        =>'Tatiye',   
       "time"     =>tatiye::tm(),                                                  
       "date"     =>tatiye::dt("EN"),                                              
       "bulan"    =>tatiye::dt("M"),                                               
       "tahun"    =>tatiye::dt("Y"),                                               
      );                                                                           
      $result=$db->que($data)->update("appnews","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                  
      tatiye::apphistory([                                                         
        "autoload"     =>false,                                                    
        "categori"     =>"update",                                                 
        "title"        =>$_POST["post1"],                                          
        "description"  =>"description",                                            
        "package"      =>"postingan",                                              
        "PrimaryKey"   =>$setId,                                                   
        "tabel"        =>"appnews",                                                
      ]);                                                                          
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  }                                                                                
   echo json_encode($val);                                                         
