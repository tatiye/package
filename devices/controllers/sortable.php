<?php
use app\tatiye;
      $tabel=$_POST['key'];
      $colom=$_POST['colom'];
     $query =tatiye::sqli("SELECT $colom,id,ascId,date,time FROM $tabel ORDER BY ascId LIMIT 120");
    ?>

<div class="unstyled">
<?php
$nomor=0;
 while ($row = $query->fetch_array()) { 
$nomor=$nomor+1;
  ?>
<li id="<?=$row['id'].'='.$tabel;?>" class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block">
                    <span class="avatar-initial rounded-circle bg-gray-600"><i class="picons-116"></i></span>
                  </div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0 text-uppercase"><?=$row[$colom]; ?></p>
                    <small class="tx-12 tx-color-03 mg-b-0">#<?=$row['id'];?> | #ascId <?=$row['ascId'];?> Date <?=$row['date'].', '.$row['time']; ?></small>
                  </div>
                </li>

<?php }?>

        </div>
    <script type="module">
        import tatiyeNet,{sorTable} from "{tatiye.es6}"; 
        sorTable({
          "atribut":".unstyled",
          "package":"{key}"
        })
    </script>