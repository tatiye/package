<?php
 use app\tatiye;
 $row=tatiye::fetch("biling","order_id","id='".$_POST['key']."'");
 ?>
<iframe style="border:none;"width="100%" height="450px" src="https://tatiye.net/payment/?tn=<?=$row['order_id'];?>" ></iframe>
<style type="text/css">
    .setModal-body{
        padding: 0px;
    }
</style>