<style>


.dataTable > thead > tr > th[class*="sort"]:before,
.dataTable > thead > tr > th[class*="sort"]:after {
content: "" !important;
}
div.dataTables_wrapper {
    width: 100%;
    margin: 0 auto;
    top:10px;

}

td:nth-child(1){
    color: white;
  }
  td:nth-child(2){
    color: white;
  }
  
th {    
    background-color:#1F2739;
    text-align: center;
    color: white;
}

td {
    width:auto;
    text-align: center;
    color:yellow;
    background-color: #323C50;

}


tr:hover {
    background-color: #464A52;
    -webkit-box-shadow: 0 6px 6px -6px #0E1119;
    -moz-box-shadow: 0 6px 6px -6px #0E1119;
    box-shadow: 0 6px 6px -6px #0E1119;
}

td:hover {
    background-color: #FFF842;
    color: #403E10;
    font-weight: bold;

    box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
    transform: translate3d(6px, -6px, 0);

    transition-delay: 0s;
    transition-duration: 0.4s;
    transition-property: all;
    transition-timing-function: line;
}

@media (max-width: 800px) {
.container td:nth-child(4),
.container th:nth-child(4) 
{
    display: none; 
}
}

</style>
<?php

    $arr_gerbang_id = array();
    $arr_asal_gerbang = array();
    $arr_gol1 = array();
    $arr_gol2 = array();
    $arr_gol3 = array();
    $arr_gol4 = array();
    $arr_gol5 = array();
    $tgl_berlaku = array();
    $id_dasar_tarif = array();

    $someObject = json_decode($fullgerbang);
    $elementCount  = count($someObject);

    for ($i=0; $i<$elementCount; $i++){
        // echo $someObject[$i]->gerbang_nama; // Access Object data
        $servername = $someObject[$i]->host;
        $username =  $someObject[$i]->user;
        $password =  $someObject[$i]->pass;
        $dbname =  $someObject[$i]->database;

        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            // die("Connection failed: " . $conn->connect_error);
            echo "<script type='text/javascript'>
            iziToast.error({
                title: 'HUBUNGI ADMIN!',
                message: 'DATABASE $nama BERMASALAH!',
            });
            </script>";
            continue;
        }

        $sql = "SELECT * FROM tbl_tarif_open t1 WHERE tgl_berlaku = (SELECT max(tgl_berlaku) from tbl_tarif_open WHERE gerbang_id = t1.gerbang_id)";
        $result = $conn->query($sql);
        
         if ($result->num_rows > 0) {
                // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo "Gerbang: " . $row["gerbang_id"]."<br>";
                array_push($arr_gerbang_id, $row["gerbang_id"]);
                array_push($tgl_berlaku, $row["tgl_berlaku"]);   
                array_push($id_dasar_tarif, $row["id_dasar_tarif"]);                
             
                array_push($arr_gol1, $row["gol1"]);                
                array_push($arr_gol2, $row["gol2"]);                
                array_push($arr_gol3, $row["gol3"]);                
                array_push($arr_gol4, $row["gol4"]);
                array_push($arr_gol5, $row["gol5"]);                
                

            }
        } else {
            echo "0 results";
        }
    }

    $conn->close();

    $someObject2 = json_decode($namanyagerbang);
    $listdatagerbang = json_decode(json_encode($someObject2), true);
    $arraygerbangid = array_values (array_unique($arr_gerbang_id));
    $arraygerbangasal = array_values (array_unique($arr_asal_gerbang));


    $new_array = array();
    for ($i = 0; $i <count($arr_gerbang_id); $i++) {
        for ($x = 0; $x < sizeof($listdatagerbang); $x++) {
            // print_r($listdatagerbang[$x]['gerbang_id'].'//');
            if ($arr_gerbang_id[$i] == $listdatagerbang[$x]['gerbang_id']){

                $gerbang_namas = $listdatagerbang[$x]['gerbang_nama'];
                $new_array[] = array("gerbang_nama"=>"$gerbang_namas","gerbang_id"=>"$arr_gerbang_id[$i]", "Gol1"=>"$arr_gol1[$i]", "Gol2"=>"$arr_gol2[$i]", "Gol3"=>"$arr_gol3[$i]", "Gol4"=>"$arr_gol4[$i]", "Gol5"=>"$arr_gol5[$i]", "tgl"=>"$tgl_berlaku[$i]","id_tarif"=>"$id_dasar_tarif[$i]" );   
                // print_r("true");
                // echo "<br>";

            }
            else {
            }
        }
    }

    // var_dump($new_array);
    $new_array = array_unique($new_array, SORT_REGULAR);
    $new_array  = array_values($new_array);

    array_multisort(array_column($new_array, 'tgl'), SORT_ASC, $new_array);

    

?>

<div class="container-fluid">

<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">
<h1 style="text-align:center";>Daftar Tarif Gerbang Open JKC</h1>

<div class="btn-group btn-group-sm pull-right" role="group">

<a href="<?=base_url('main/matriks_tarif_close')?>">
    <btn id="matriksclose" style="width:auto;" class="btn btn-default" href="#"><i class="fa fa-eye"></i> <span class="hidden-sm">Matriks Tarif Close</span> </btn>
</a>


<a href="<?=base_url('main/daftar_tarif')?>">
    <btn id="x" style="width:auto; margin-right:15px;" class="btn btn-default" href="#"><i class="fa fa-close"></i> <span class="hidden-sm"></span> </btn>
</a>
</div>
<div class="panel-body">



<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Gerbang</th>
                <th>Golongan 1</th>
                <th>Golongan 2</th>
                <th>Golongan 3</th>
                <th>Golongan 4</th>
                <th>Golongan 5</th>
            </tr>
        </thead>
        <tbody>
       
        <?php
        for ($i = 0; $i <count($new_array); $i++) {
            ?>
            <tr>
            <td><?php print_r($new_array[$i]['gerbang_nama'])?></td>
            <td><?php print_r($new_array[$i]['Gol1'])?></td>
            <td><?php print_r($new_array[$i]['Gol2'])?></td>
            <td><?php print_r($new_array[$i]['Gol3'])?></td>
            <td><?php print_r($new_array[$i]['Gol4'])?></td>
            <td><?php print_r($new_array[$i]['Gol5'])?></td>
        </tr>
        <?php
        }
        ?>
            
        </tbody>
    </table>
</div>
</div>
</div>

</div>
</div>
</div>


<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        "bFilter": false,
        "bInfo": false,   
        "aaSorting": [],
        "bSort" : false,
        
     
        // scrollY:        "800px",
        // scrollX:        true,
        // scrollCollapse: true,
        paging:         false,
    
} );

} );

</script>




