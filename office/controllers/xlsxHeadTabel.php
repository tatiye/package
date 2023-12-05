<?php                                                                                     
  use app\tatiye;                                                                    
  $Text=tatiye::Text();                                                              
  $db=new tatiye();                                                                  
  $setId=$_SERVER["HTTP_KEY"];                                                       
  $from=json_decode($_SERVER["HTTP_FROM"], true);
  $setUId=$_SERVER["HTTP_USERID"];                                                   


// $x = 1;
// while($x <= count($from)) {
//   echo "The number is: $x <br>";
//   $x++;
// }
                                                                                  
  #|-------------------------------------                                            
  #| Initializes SEGMENT INSERT                                                      
  #|-------------------------------------                                            
  #| Develover Tatiye.Net 2023                                                       
  #| @Date  Rabu 25 Oktober 2023, 11:23:16 AM                                        
$asosiatif=array();
$no=0;  
foreach ($from as $key => $value) {
  $no=$no+1;
  $name='A'.$no;
    if ($no !==1) {
        $asosiatif["$name"] =tatiye::val('text',$_POST["$name"] ,'2|Wajib diisi');
        $asosiatif2["A1"] ='NO';
        $asosiatif2["$name"] =$_POST["$name"];
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
      $Exp=array();
      foreach ($asosiatif2 as $key => $value) {
       $Exp[]=$value; 
      }   
       $result=$db->que(array("tableHead"=>json_encode($Exp)))->update("sisinfo","id ='".$setId."'");                                                                         
      $val["hasil"]    ="sukses";                                                                      
  } else {                                                                           
      $val["hasil"]    ="error";                                                     
   };   


      $val["data"]    =$asosiatif2;                                                     
                                                                               
   echo json_encode($val);                                                           
