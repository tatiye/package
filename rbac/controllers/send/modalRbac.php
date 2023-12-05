<?php                                                                                          
  use app\tatiye;  
  use app\tatiye AS tatiyeNet; 
  use app\models\Package;
  $rbac =Package::Public();                                                                      
  $Text=tatiye::Text();                                                                   
  $db=new tatiye();                                                                       
  $setId=$_SERVER["HTTP_KEY"];                                                            
  $setUId=$_SERVER["HTTP_USERID"];  
  $IDuser= tatiyeNet::fetch('appuserprofil','*',"id='".$setId."' ORDER BY id DESC");
  $Cek= tatiyeNet::fetch('appuserpackage','*',"userid='".$IDuser['userid']."' AND namaBase='".$rbac[$_POST["a1"]][0]."'");                                                      
  if (is_numeric($setId)) {                                                               
   $segmen="update";                                                                      
  } else {                                                                                
   $segmen="insert";                                                                      
  }                                                                                       
  #|-------------------------------------                                                 
  #| Initializes SEGMENT INSERT                                                           
  #|-------------------------------------                                                 
  #| Develover Tatiye.Net 2023                                                            
  #| @Date  Rabu 30 Agustus 2023, 02:48:10 PM                                             
  if($segmen  == "update") {                                                        
    $val=tatiye::validation([                                                             
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"1|Wajib diisi"),                           
   ]);                                                                                    
  if (empty($val["error"])) {                                                             
      if (!empty($Cek['namaBase'])) {

    } else {
     $data = array(                                                                       
       "namaBase"    =>$rbac[$_POST["a1"]][0],
       "packageid"   =>$_POST["a1"],                                                      
       "nama"       =>$IDuser['nama'],                                                      
       "userid"     =>$IDuser['userid'],                                                                         
      );     
    
          $result=$db->que($data)->insert("appuserpackage");                                  
       }
                                                                                                                                                                
      // $result=$db->que($data)->update("appuserpackage","id =$setId AND userid=$setUId");  

      $val["hasil"]    ="sukses";                                                         
  } else {                                                                                
      $val["hasil"]    ="error";                                                          
   };                                                                                     
  }                                                                                       
   echo json_encode($val);                                                                
