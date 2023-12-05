<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\models\Package;
use app\models\storage;
use app\tatiyeNetAuthorization AS Authorization;
$db=new tatiye();
$NEWTOKEN="eyJkaXIiOiJvZmZpY2VcL0FwaVwvMC4xXC9xdWVyeS5waHAiLCJ1aWQiOjF9";
Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "POST") {
$setUId=$_SESSION["user_id"];   
$val=json_decode(file_get_contents("php://input"));
     $doc=json_encode($val); 
     $red=json_decode($doc, true);
     // $row=tatiye::getWJT($val->token);
     $READ=tatiye::fetch("appoffice","*","id='".tatiye::uidSSLKey($val->token)."'");
     $redQuery=json_decode($READ['setProperty'], true);

      if(empty($READ['id'])) {
          $response = new Response();
          $response->setHttpStatusCode(400);
          $response->setSuccess(false);
          $response->addMessage("token tidak sesuai");
          $response->send();
          exit;
        }
       if(empty($val->query)) {
          $response = new Response();
          $response->setHttpStatusCode(400);
          $response->setSuccess(false);
          $response->addMessage("Syntax query SQL  boleh kosong");
          $response->send();
          exit;
        }

         $IDFROM=explode('FROM',$val->query);
         $IDWHERE=explode('WHERE',$val->query);
         $IDFROM1=explode(' ',$IDFROM[1]);
      $newToken=tatiye::WJT([
         'key'   =>$READ['id'], 
       ]);
     $data = array(                                                                  
       "nmtabel"     =>$IDFROM1[1],
       "setWhere"    =>$IDWHERE[1],
       "filename"    =>$red['fromAction']['segment'],
       "keyid"       =>$red['chart']['group'],
       "setToken"    =>$val->token,
       "setTabel"    =>$val->query,
       "newToken"    =>$newToken,
       "setQuery"    =>json_encode($val),
       "setProperty" =>json_encode($val->property),                                               
       "setChart"    =>json_encode($val->chart)                                               
      );                                                                             
      $result=$db->que($data)->update("appoffice","id='".tatiye::uidSSLKey($val->token)."'");        

http_response_code(200);
echo json_encode($redQuery);
} else {
  return tatiye::index();
}
?>
