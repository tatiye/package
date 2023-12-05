<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$Text=tatiye::Text();
$NEWTOKEN="eyJkaXIiOiJwYXltZW50XC9BcGlcLzAuMVwvY2hlY2tvdXQucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$row=tatiye::sum("SELECT SUM(harga) AS TOTAL,userid FROM biling WHERE status='Unpaid' AND order_id='".$val->oder_id."'"); 
$Expuid=tatiye::fetchUserID($row['userid']);
$transaction_details = array(
    'order_id' =>rand(),
    'gross_amount' => $row['TOTAL'], // no decimal allowed for creditcard
    'total_amount' =>$Text->numberFormat([($row["TOTAL"]),0]), // no decimal allowed for creditcard
);
// Optional
   $item_details=array();
   $no=0;
   $variable=tatiye::QY("SELECT *  FROM biling WHERE status='Unpaid' AND   order_id='".$val->oder_id."'  "); 
   while ($row = $variable->fetch()) {  
   $no=$no+1;
            $item_details[]=array(
                  'id'       =>$no,
                  'price'    =>$row['harga'],
                  'quantity' =>$row['jumlah'],
                  'haraga'    =>$Text->numberFormat([($row["harga"]),0]),
                  'name'     =>$row['categori']
              );
        
    } 


$billing_address = array(
    'address'       => "ID",
    'city'          => $val->oder_id
);


// Optional
$customer_details = array(
     'first_name'          =>$Expuid['name'],
     'last_name'           =>"",
     'email'               =>$Expuid['email'],
     'phone'               =>$Expuid['telepon'],
     'billing_address'  => $billing_address,
     'shipping_address' => '',
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
    'user_order' => $Expuid,
);


echo json_encode($transaction);
} else {
  return tatiye::index();
}
