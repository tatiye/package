<?php
    use app\tatiye;
    $row= tatiye::fetch('demo','*',"id='".$_GET['tn']."'");
    // $row=tatiye::useHandelID('demo','id',$_GET['tn']);   
  
 ?>
<h1><?=$row['nama'];?></h1>
 ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, voluptatum deleniti iure ipsa fugit neque, itaque molestias saepe harum officiis voluptate, veniam accusantium, inventore culpa vel aliquam quisquam modi. Rem.