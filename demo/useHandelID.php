<?php
 use app\tatiye;
    $row=tatiye::useHandelID('demo','id',33);   
    echo $row['nama'];  
    echo "<br>";     
    echo $row['name'];       
?>