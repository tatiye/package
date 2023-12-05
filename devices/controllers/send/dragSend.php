<?php                                                                                   
 use app\tatiye; 
 $db=new tatiye();  
 $Text=tatiye::Text();  
 $variable=json_decode($_POST['order'], true);
 $tabel=$_POST['tabel'];
 // $query =tatiye::sqli("SELECT id  FROM $tabel");
 $COUNT=tatiye::fetch($tabel," COUNT(*) as count");
 if (!empty($_POST['order'])) {

       //while ($row = $query->fetch_array()) { 
		$number=$COUNT['count'];
		 foreach ($variable as $key => $value) {
		 		$number=$number+1;
		 	    $ID=explode('=',$value);
		 	    $num=$Text->sprintf($number,"%02s"); 
		        
			    $result=$db->que(array('ascId'=>$num))->update($tabel,"id ='".$ID[0]."'");
		

		
		}

	 }