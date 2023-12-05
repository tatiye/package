<?php
use app\tatiye;
      $tabel=$_POST['key'];
      $colom=$_POST['colom'];
      $colomtabel=$_POST['tabel'];
      $id=$_POST['id'];
      $query =tatiye::sqli("SELECT id,ascId,date,time,filename FROM $tabel WHERE keyid='".$id."' AND nmtabel='".$colomtabel."'   ORDER BY ascId LIMIT 10");
    ?>

<div style="width:100%;" class="unstyled">
<?php
$nomor=0;
 while ($row = $query->fetch_array()) { 
$nomor=$nomor+1;
  ?>
<div style="width:100%;" id="<?=$row['id'].'='.$tabel;?>" class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block">
                    <img src="<?=tatiye::resizeTabelImage('300x215',$row['filename']);?>" class="rounded-circle" alt="">
                  </div>
                  <div  class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0 text-uppercase"><?=$row['date'].', '.$row['time']; ?></p>
                    <small class="tx-12 tx-color-03 mg-b-0"> <?=$row['filename'];?> </small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                       <a  onclick="deletedAppfile(['delete','<?=$row['id'];?>','<?=$row['filename'];?>']);" href="javascript:void(0);" class="nav-link d-none d-sm-block"><i class="feat feat-trash-2 feat-scale-18 mr-10px"></i></a>
                    </nav>
                  </div>
                </div>

<?php }?>

        </div>
    <script type="module">
        import tatiyeNet,{sorTable,setModal} from "{tatiye.es6}"; 
        sorTable({
          "atribut":".unstyled",
          "package":"{key}"
        })
        window.deletedAppfile=function(property,titel) {
           setModal({
                       'titel':property[2],
                       'width':'300px',
                       'key'  :property[1],
                       'model':property[2],
                       'route':false,
                       'package':'setPackage',
                       'footer'  :'public', //public,privacy 
                       'tabel':'appfile',
                       'content':'delete',
                       'page'   :1,
                       'setdata' :'public',
                      });
     }
    </script>