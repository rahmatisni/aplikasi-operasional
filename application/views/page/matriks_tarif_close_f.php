<style>
    .dataTable > thead > tr > th[class*="sort"]:before,
    .dataTable > thead > tr > th[class*="sort"]:after {
    content: "" !important;
    }
    div.dataTables_wrapper {
        /* width: 85%; */
        margin: 0 auto;
    }

    td:nth-child(1){
        color: white;
        position: relative;
        top: -12px;
        height: 40px;
    }
    td:nth-child(2){
        color: white;
        position: relative;
        top: -12px;
        height: 40px;
    }
    
    th {
        background-color:#1F2739;
        text-align: center;
        color: white;
    }

    td {
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
        background-color: yellow;
        color: white;
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

    .modal-body {
        background-color: #323C50;
        text-align: center;

    }
    .modal-title {
        text-align: center;
    }
    a { color: yellow; } /* CSS link color */

</style>


<?php
$var_value = $_POST['inputclose'];
// $var_value2 = $_POST['myinput'];


// echo($var_value."//");
// echo($meneng."//");

// echo($var_value2."//");


// var_dump($matriksclosef);

$arr_gerbang_id = array();
    $arr_asal_gerbang = array();
    $arr_gol1 = array();
    $arr_gol2 = array();
    $arr_gol3 = array();
    $arr_gol4 = array();
    $arr_gol5 = array();
    $arr_jenis = array();
    $tgl_berlaku = array();
    $id_dasar_tarif = array();
    $gerbang_id_count = array ();
    $gerbang_asal_count = array ();


    $someObject = json_decode($fullgerbang);
    $elementCount  = count($someObject);
    // var_dump($someObject);


    $someObject2 = json_decode($namanyagerbang);
    $listdatagerbang = json_decode(json_encode($someObject2), true);

    // $jmlentrance = array_values (array_unique($arr_asal_gerbang));
  
    $matriksclosef = json_decode(json_encode($matriksclosef), true);
    // var_dump($matriksclosef);
    // print_r($matriksclosef[0]);

    $namanyagerbang = json_decode(($namanyagerbang), true);
    // var_dump($namanyagerbang);

    $gerbanglistoption = array();
    for ($i = 0; $i <sizeof($listdatagerbang); $i++) {
        if($listdatagerbang[$i]['gerbang_id'] == $meneng){
            // echo($listdatagerbang[$i]['gerbang_nama']);
            // echo($listdatagerbang[$i]['jenis_gerbang']);
            $gerbangnama1= $listdatagerbang[$i]['gerbang_nama'];
            $jenisgerbang1= $listdatagerbang[$i]['jenis_gerbang'];
            $gerbang_id1= $listdatagerbang[$i]['gerbang_id'];
            $gerbanglistoption[] = array("gerbang_nama"=>"$gerbangnama1","jenis_gerbang"=>"$jenisgerbang1","gerbang_id"=>"$gerbang_id1");               
        }
    }

    $new_array = array();
    for ($i = 0; $i <sizeof($matriksclosef); $i++) {
        for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
            // print_r($namanyagerbang[$x]['gerbang_id'].'//');
            if ($matriksclosef[$i]['gerbang_id'] == $namanyagerbang[$x]['gerbang_id']){
                $gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];
                $arr_gerbang_id = $matriksclosef[$i]['gerbang_id'];
                $arr_asal_gerbang = $matriksclosef[$i]['asal_gerbang'];
                $arr_gol1 = $matriksclosef[$i]['gol1'];
                $arr_gol2 = $matriksclosef[$i]['gol2'];
                $arr_gol3 = $matriksclosef[$i]['gol3'];
                $arr_gol4 = $matriksclosef[$i]['gol4'];
                $arr_gol5 = $matriksclosef[$i]['gol5'];
                $arr_gol1_d = $matriksclosef[$i]['gol1_d'];
                $arr_gol2_d = $matriksclosef[$i]['gol2_d'];
                $arr_gol3_d = $matriksclosef[$i]['gol3_d'];
                $arr_gol4_d = $matriksclosef[$i]['gol4_d'];
                $arr_gol5_d = $matriksclosef[$i]['gol5_d'];
                $arr_jenis = $matriksclosef[$i]['jenis'];
                $id_dasar_tarif = $matriksclosef[$i]['id_dasar_tarif'];
                $tgl_berlaku = $matriksclosef[$i]['tgl_berlaku'];
                $tarif_inv = $matriksclosef[$i]['tarif_inv'];

                array_push($gerbang_id_count,$arr_gerbang_id);
                array_push($gerbang_asal_count,$arr_asal_gerbang);

                $new_array[] = array("gerbang_nama"=>"$gerbang_namas","jenis"=>"$arr_jenis","asal_gerbang"=>"$arr_asal_gerbang","gerbang_id"=>"$arr_gerbang_id", "Gol1"=>"$arr_gol1", "Gol2"=>"$arr_gol2", "Gol3"=>"$arr_gol3", "Gol4"=>"$arr_gol4", "Gol5"=>"$arr_gol5", "tgl"=>"$tgl_berlaku","id_tarif"=>"$id_dasar_tarif", "Gol1_d"=>"$arr_gol1_d", "Gol2_d"=>"$arr_gol2_d", "Gol3_d"=>"$arr_gol3_d", "Gol4_d"=>"$arr_gol4_d", "Gol5_d"=>"$arr_gol5_d","tgl"=>"$tgl_berlaku", "tarif_inv"=>"$tarif_inv" );   
                // print_r("true");
                // echo "<br>";

            }
            else {
            }
        }
    }
    
    $my_arrays = array_unique($new_array, SORT_REGULAR);
    $myArray  = array_values($my_arrays);

    // $arraygerbangid = array_values (array_unique($arr_gerbang_id));
    $jmlexit = array_values (array_unique($gerbang_id_count));
    $jmlentrance = array_values (array_unique($gerbang_asal_count));
    
    $span = sizeof($jmlentrance);
    // var_dump($myArray);

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <!-- <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="<?=base_url('main/matriks_tarif_open')?>">
                    <btn id="matriksopen" style="width:auto;" class="btn btn-default" href="#"><i class="fa fa-eye"></i> <span class="hidden-sm">Matriks Tarif Open</span> </btn>
                </a>
                <a href="<?=base_url('main/matriks_tarif_close')?>">
                    <btn id="matriksclose" style="width:auto;" class="btn btn-default" href="#"><i class="fa fa-eye"></i> <span class="hidden-sm">Matriks Tarif Close</span> </btn>
                </a>

                
                </div> -->
                
                    <div class="pull-left" style="width:250px">
                        <select class="form-control" id="gerbang" name="gerbang">
                            <!-- <option selected value="default">KANTOR OPERASIONAL</option> -->
                            <?php
                               if($gerbanglistoption == FALSE)
                               {
                            ?>
                                <option selected value="default">KANTOR OPERASIONAL</option>
                            <?php
                                }
                                else {
                            ?>
                                <option value="default">KANTOR OPERASIONAL</option>
                                <option hidden selected value="<?php echo($gerbanglistoption[0]['gerbang_id']);?>"><?php echo($gerbanglistoption[0]['gerbang_nama'] ." - (".$gerbanglistoption[0]['jenis_gerbang'].")"); ?></option>
                            <?php
                                }
                            ?>
                            <?php 
                                if(count($GerbangOption)> 0)
                                {

                                    foreach ($GerbangOption as $row) 
                                    {
                                        // kode ruas
                                        // if ($row->jenis_gerbang != '2' && $row->ruas_id == '40') {
                                        if ($row->jenis_gerbang != '2') {

                                            echo '<option value='.$row->gerbang_id.'>'.ucfirst($row->gerbang_nama).' - ('.$row->jenis_gerbang.')'.'</option>';
                                        }                                   
                                    }
                                } 
                                else
                                {
                                    echo'<option value="0">Data Not Found</option>';  
                                }
                            ?>
                        </select>               
                    </div>
                    <!-- <btn id="selectmtrks" style="margin-left:10px; width:100px;" class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn> -->
                    <!-- <div id="TestsDiv"> -->

                    <form method = "post" name="myform" id="myform" action="matriks_tarif_open_f">
                        <input type="hidden" name="inputopen" id="inputopen" value = "">
                        <button id="btnmatriksopenf" style="margin-left:10px; width:100px;" class="btn btn-primary pull-left" onclick="DoSubmit()"><span class="hidden-sm"> Pilih</span></button>
                    </form>
                    

                    <form method = "post" name="myform1" id="myform1" action="matriks_tarif_close_f">
                        <input type="hidden" name="inputclose" id="inputclose" value = "">
                        <button id="btnmatriksclosef"style="margin-left:10px; width:100px;" class="btn btn-primary pull-left" onclick="DoSubmit1()"><span class="hidden-sm"> Pilih</span></button>
                    </form>

                    
                    <form method = "post" name="myform2" id="myform2" action="daftar_tarif">
                        <input type="hidden" name="myinput2" id="myinput2" value = "">
                        <button id="tarif" style="margin-left:10px; width:100px;" class="btn btn-primary pull-left" onclick="DoSubmit2()"><i class="fa fa-table"></i><span class="hidden-sm">  Tabel</span></button>
                    </form>

                    <br>
                    <br>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <!-- <btn id="closematriks" button onclick="goBack()" style="width:auto;" class="btn btn-default" href="#"><i class="fa fa-arrow-circle-left"></i> <span class="hidden-sm">Back</span> </btn> -->
                        <!-- <btn id="refreshDaftarTarif" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
                        <btn id="btnAddDaftarTarif" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span> </btn> -->

                        <!-- <btn id="btnAddDaftarTarifClose" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span> </btn> -->

                    </div>
                    <!-- </div> -->

                    <div class="clearfix"></div>
                </div>

                <div id="Open">
                    <div class="panel-body table-responsive table-full" style="padding:10px;">
                        <table id="tabelDaftarTarif" class="table table-stripped table-hover table-bordered" style="width:100%">
                        </table>
                    </div>
                </div>
                <div id="Close">
                    <div class="panel-body table-responsive table-full" style="padding:10px;">
                        <table id="tabelDaftarTarifClose" class="table table-stripped table-hover table-bordered" style="width:100%">
                        </table>
                    </div>
                </div>
                <h1 style="text-align:center";>Daftar Tarif Gerbang Close JKC</h1>
                <div class="panel-body">


<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Gerbang</th>
                <th></th>

                <th style="text-align:center;" colspan='<?php echo($span+1)?>'>Asal</th>
            </tr>
            <tr>
            <th>Exit</th>
            <th>Golongan</th>

            <?php
            // var_dump($jmlexit);
            // var_dump($jmlentrance);


                for ($i = 0; $i<sizeof($jmlentrance); $i++) { // first loop
                echo '<th>'; 
                for ($x = 0; $x<sizeof($listdatagerbang); $x++) { // first loop
                    if ($jmlentrance[$i] != $listdatagerbang[$x]['gerbang_id']){
                        // print_r($jmlexit[$i]);
                        // print_r($listdatagerbang[$i]['gerbang_id']);
                    }
                    else {
                        print_r($listdatagerbang[$x]['gerbang_nama']);
                        // print_r("-");
                        // print_r($listdatagerbang[$x]['gerbang_id']);
                    }
                }
                echo '</th>';
                }
            ?>

            </tr>
        </thead>
        <tbody>

        <?php
        
    for ($row = 1; $row < sizeof($jmlexit)+1; $row++) { // first loop
        for ($col = 0; $col < sizeof($jmlentrance)+1; $col++) { //2nd loop
            if($row == 0 && $col == 0){
                echo '<td> Asal Gerbang </td>';
                echo '<td> Golongan </td>';
            }

            else if ($row == 0 && $col != 0)
            {
                
                echo '<td>';
                // print_r(sizeof($listdatagerbang));
                for ($i=0; $i<sizeof($listdatagerbang); $i++){
                    // print_r("x");
                    if ($jmlentrance[$col-1] != $listdatagerbang[$i]['gerbang_id']){
                    }
                    else {
                        print_r($listdatagerbang[$i]['gerbang_nama']);
                        // print_r ("//");
                        // print_r($listdatagerbang[$i]['gerbang_id']);

                    }


                }
                // print_r(" ".$jmlexit[$col-1]);
                echo '</td>';
            }

            else if ($row != 0 && $col == 0)
            {
                
                echo '<td>';
                for ($i=0; $i<sizeof($listdatagerbang); $i++){
                    // print_r("x");
                    if ($jmlexit[$row-1] != $listdatagerbang[$i]['gerbang_id']){
                        
                    }
                    else {
                        print_r($listdatagerbang[$i]['gerbang_nama']);
                        // print_r ("=");
                        // print_r($listdatagerbang[$i]['gerbang_id']);
                    }


                }

                // print_r($jmlentrance[$row-1]);
                echo '</td>';
                echo '<td > Golongan 1</td>';

            }

            else {
                // $p = $col * $row; //computing values

                // if ($jmlexit[$row-1] == $jmlentrance[$col-1]) {
                
                //     echo '<td style="background-color:#AC2929">';
                //     echo 'AGS';
                //     $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'],2,',','.');
                //     print_r($hasil_rupiah);
                //     echo '</td>';  
                // }
                // else {

                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($jmlexit[$row-1] != $myArray[$i]['gerbang_id'] || $jmlentrance[$col-1] != $myArray[$i]['asal_gerbang'])
                        {
                            

                        }
                        else{
                            if ($myArray[$i]['jenis']=='ags'){
                                echo '<td style="background-color:#AC2929">';
                            }
                            elseif ($myArray[$i]['jenis']=='khl') {
                                echo '<td style="background-color:#FFFF00">';
                            }
                            else {
                                echo '<td style="background-color:GREEN">';
                            }
                            // echo '<td style="background-color:#AC2929">';
                            echo '<a href="#" class="passingID" data-gerbang="'.($new_array[$i]['gerbang_nama']).'"';

                            $asal_trx = array();
                            // var_dump($namanyagerbang);
                            for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
                                // print_r($namanyagerbang[$x]['gerbang_id'].'//');
                                if ($new_array[$i]['asal_gerbang'] == $namanyagerbang[$x]['gerbang_id']){
                                    $asal_gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];
        
                                    $asal_trx[] = array("asal_gerbang_nama"=>"$asal_gerbang_namas");   
                                }
                                else {
                                }
                            }
                            echo 'data-gerbang-asal="'.($asal_trx[0]['asal_gerbang_nama']).'"';

                            echo 'data-investor="'.($new_array[$i]['tarif_inv']).'"';
                            echo 'data-gol1d="'.($new_array[$i]['Gol1_d']).'"';  
                            echo 'data-gol2d="'.($new_array[$i]['Gol2_d']).'"';  
                            echo 'data-gol3d="'.($new_array[$i]['Gol3_d']).'"';  
                            echo 'data-gol4d="'.($new_array[$i]['Gol4_d']).'"';  
                            echo 'data-gol5d="'.($new_array[$i]['Gol5_d']).'"';  
                            echo '>';
                            $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'],2,',','.');
                            print_r($hasil_rupiah);

                            echo '</a>';
                            echo '</td>';  
                            
                            // $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'],2,',','.');
                            // print_r($hasil_rupiah);
                            // echo '</td>';
                            break;
                        }
                    }
                        
                // }
            }
        }
        echo '</tr>';

        for ($q = 2; $q<=5; $q++) {
            echo '<tr>';
            echo '<td>&nbsp</td>';
            echo '<td> Golongan'.$q.'</td>';

            for ($col = 1; $col < sizeof($jmlentrance)+1; $col++) { //2nd loop
                // echo '<td>';
                // print_r("ags");
                // echo '</td>';  
                // if ($jmlexit[$row-1] == $jmlentrance[$col-1]) {
                //     echo '<td style="background-color:#AC2929">';
                //     // echo '<a href="#" class="passingID" data-gerbang="'.($new_array[$i]['gerbang_nama']).'"';

                //     // echo 'data-investor="'.($new_array[$i]['tarif_inv']).'"';
                //     // echo 'data-gol1d="'.($new_array[$i]['Gol1_d']).'"';  
                //     // echo 'data-gol2d="'.($new_array[$i]['Gol2_d']).'"';  
                //     // echo 'data-gol3d="'.($new_array[$i]['Gol3_d']).'"';  
                //     // echo 'data-gol4d="'.($new_array[$i]['Gol4_d']).'"';  
                //     // echo 'data-gol5d="'.($new_array[$i]['Gol5_d']).'"';  
                //     // echo '>';
                //     $hasil_rupiah = "Rp " . number_format($myArray[$i+1]['Gol'.$q],2,',','.');
                //     print_r($hasil_rupiah);
                //     // echo 'AGS';

                //     echo '</a>';
                //     echo '</td>';  
                // }
                // else {
                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($jmlexit[$row-1] != $myArray[$i]['gerbang_id'] || $jmlentrance[$col-1] != $myArray[$i]['asal_gerbang'])
                        {
    
                        }
                        // eles if () {


                        // }
                        else{
                            if ($myArray[$i]['jenis']=='ags'){
                                echo '<td style="background-color:#AC2929">';
                            }
                            elseif ($myArray[$i]['jenis']=='khl') {
                                echo '<td style="background-color:#FFFF00">';
                            }
                            else {
                                echo '<td style="background-color:GREEN">';
                            }
                            // echo '<td style="background-color:#AC2929">';
                            echo '<a href="#" class="passingID" data-gerbang="'.($new_array[$i]['gerbang_nama']).'"';

                            $asal_trx = array();
                            // var_dump($namanyagerbang);
                            for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
                                // print_r($namanyagerbang[$x]['gerbang_id'].'//');
                                if ($new_array[$i]['asal_gerbang'] == $namanyagerbang[$x]['gerbang_id']){
                                    $asal_gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];
        
                                    $asal_trx[] = array("asal_gerbang_nama"=>"$asal_gerbang_namas");   
                                }
                                else {
                                }
                            }
                            echo 'data-gerbang-asal="'.($asal_trx[0]['asal_gerbang_nama']).'"';

                            echo 'data-investor="'.($new_array[$i]['tarif_inv']).'"';
                            echo 'data-gol1d="'.($new_array[$i]['Gol1_d']).'"';  
                            echo 'data-gol2d="'.($new_array[$i]['Gol2_d']).'"';  
                            echo 'data-gol3d="'.($new_array[$i]['Gol3_d']).'"';  
                            echo 'data-gol4d="'.($new_array[$i]['Gol4_d']).'"';  
                            echo 'data-gol5d="'.($new_array[$i]['Gol5_d']).'"';  
                            echo '>';
                            $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol'.$q],2,',','.');
                            print_r($hasil_rupiah);

                            echo '</a>';
                            echo '</td>';  
                            
                            // $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'],2,',','.');
                            // print_r($hasil_rupiah);
                            // echo '</td>';
                            break;
                        }
                    }
                        
                // }
                
            }
         
        echo '</tr>';
        }
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Detail Investor</h3>
                <i class="fa fa-automobile" style="font-size:20px;"></i>
                <label id="judulgerbangasal"></label>
                <i class="fa fa-long-arrow-right"></i>
                <label id="judulgerbang"></label>

            </div>
                <div class="modal-body" >
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-2" style="color: white"><h4>Investor</h4></div>
                            <div class="col-sm-2" style="color: white"><h4>Gol 1</h4></div>
                            <div class="col-sm-2" style="color: white"><h4>Gol 2</h4></div>
                            <div class="col-sm-2" style="color: white"><h4>Gol 3</h4></div>
                            <div class="col-sm-2" style="color: white"><h4>Gol 4</h4></div>
                            <div class="col-sm-2" style="color: white"><h4>Gol 5</h4></div>
                        </div>
                    </div>
                </div>
                <div class="modal-body" >
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-2"><label id="investor1" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i1_gol1" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i1_gol2" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i1_gol3" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i1_gol4" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i1_gol5" style="color: white"></label></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"><label id="investor2" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i2_gol1" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i2_gol2" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i2_gol3" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i2_gol4" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i2_gol5" style="color: white"></label></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"><label id="investor3" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i3_gol1" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i3_gol2" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i3_gol3" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i3_gol4" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i3_gol5" style="color: white"></label></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"><label id="investor4" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i4_gol1" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i4_gol2" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i4_gol3" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i4_gol4" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i4_gol5" style="color: white"></label></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"><label id="investor5" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i5_gol1" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i5_gol2" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i5_gol3" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i5_gol4" style="color: white"></label></div>
                            <div class="col-sm-2"><label id="i5_gol5" style="color: white"></label></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<script>

gerbang=$("#gerbang option:selected").val();
g = $("#gerbang option:selected").text();
g = g.split('(').pop().split(')')[0]; // returns 'two'
console.log(g);

if (g == 0 || g == 4) {
    // console.log("betul");
    $('#btnmatriksopenf').show();
    $('#btnmatriksclosef').hide();

}

else if (g == 1 || g == 3) {
    // console.log("betul");
    $('#btnmatriksopenf').hide();
    $('#btnmatriksclosef').show();

}
else {
    $('#btnAddDaftarTarif').hide();
    $('#refreshDaftarTarif').hide();
    $('#btnmatriksclosef').hide();
    $('#btnmatriksopenf').hide();
}

function DoSubmit(){
    var gerbang=$("#gerbang option:selected").val();

    document.getElementById("inputopen").value = gerbang;

    return true;
}
function DoSubmit1(){
    var gerbang=$("#gerbang option:selected").val();

    document.getElementById("inputclose").value = gerbang;

    return true;
}
function DoSubmit2(){
    var gerbang=$("#gerbang option:selected").val();

    document.getElementById("myinput2").value = gerbang;

    return true;
}



document.getElementById("gerbang").onchange = function() {myFunction()};
function myFunction() {
    var x = document.getElementById("gerbang");
//   alert(x.value );
    gerbang=$("#gerbang option:selected").val();
    g = $("#gerbang option:selected").text();
    g = g.split('(').pop().split(')')[0]; // returns 'two'
    console.log(g);
    console.log(gerbang);

    if (g == 0 || g == 4) {
        // console.log("betul");
        $('#btnmatriksopenf').show();
        $('#btnmatriksclosef').hide();

    }

    else if (g == 1 || g == 3) {
        // console.log("betul");
        $('#btnmatriksopenf').hide();
        $('#btnmatriksclosef').show();

    }
    else {
        $('#btnAddDaftarTarif').hide();
        $('#refreshDaftarTarif').hide();
        $('#btnmatriksclosef').hide();
        $('#btnmatriksopenf').hide();
        $('#btnmatriksopenf').hide();

        location.replace("<?=base_url('main/daftar_tarif')?>")
    }
}
$(document).ready(function() {
    var table = $('#example').DataTable( {
        "bFilter": false,
        "bInfo": false,   
        "aaSorting": [],
        "bSort" : false,
        scrollY:        "800px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        },
    });
});
</script>

<script>
$(".passingID").click(function () {
    var gerbangName = $(this).attr('data-gerbang');
    var gerbangNames = $(this).attr('data-gerbang-asal');



    var investor = $(this).attr('data-investor');
    var investor = investor.replace('[','');
    var investor = investor.replace(']','');
    var investor1 = investor.split(',');

    var gol1d = $(this).attr('data-gol1d');
    var gol1d = gol1d.replace('[','');
    var gol1d = gol1d.replace(']','');
    var gol1darr = gol1d.split(',');

    var gol2d = $(this).attr('data-gol2d');
    var gol2d = gol2d.replace('[','');
    var gol2d = gol2d.replace(']','');
    var gol2darr = gol2d.split(',');

    var gol3d = $(this).attr('data-gol3d');
    var gol3d = gol3d.replace('[','');
    var gol3d = gol3d.replace(']','');
    var gol3darr = gol3d.split(',');

    var gol4d = $(this).attr('data-gol4d');
    var gol4d = gol4d.replace('[','');
    var gol4d = gol4d.replace(']','');
    var gol4darr = gol4d.split(',');

    var gol5d = $(this).attr('data-gol5d');
    var gol5d = gol5d.replace('[','');
    var gol5d = gol5d.replace(']','');
    var gol5darr = gol5d.split(',');

    document.getElementById("judulgerbang").innerHTML = gerbangName;
    document.getElementById("judulgerbangasal").innerHTML = gerbangNames;

    document.getElementById("investor1").innerHTML = investor1[0];
    document.getElementById("investor2").innerHTML = investor1[1];
    document.getElementById("investor3").innerHTML = investor1[2];
    document.getElementById("investor4").innerHTML = investor1[3];
    document.getElementById("investor5").innerHTML = investor1[4];

    document.getElementById("i1_gol1").innerHTML = gol1darr[0];
    document.getElementById("i1_gol2").innerHTML = gol2darr[0];
    document.getElementById("i1_gol3").innerHTML = gol3darr[0];
    document.getElementById("i1_gol4").innerHTML = gol4darr[0];
    document.getElementById("i1_gol5").innerHTML = gol5darr[0];

    document.getElementById("i2_gol1").innerHTML = gol1darr[1];
    document.getElementById("i2_gol2").innerHTML = gol2darr[1];
    document.getElementById("i2_gol3").innerHTML = gol3darr[1];
    document.getElementById("i2_gol4").innerHTML = gol4darr[1];
    document.getElementById("i2_gol5").innerHTML = gol5darr[1];
    
    document.getElementById("i3_gol1").innerHTML = gol1darr[2];
    document.getElementById("i3_gol2").innerHTML = gol2darr[2];
    document.getElementById("i3_gol3").innerHTML = gol3darr[2];
    document.getElementById("i3_gol4").innerHTML = gol4darr[2];
    document.getElementById("i3_gol5").innerHTML = gol5darr[2];

    document.getElementById("i4_gol1").innerHTML = gol1darr[3];
    document.getElementById("i4_gol2").innerHTML = gol2darr[3];
    document.getElementById("i4_gol3").innerHTML = gol3darr[3];
    document.getElementById("i4_gol4").innerHTML = gol4darr[3];
    document.getElementById("i4_gol5").innerHTML = gol5darr[3];

    document.getElementById("i5_gol1").innerHTML = gol1darr[4];
    document.getElementById("i5_gol2").innerHTML = gol2darr[4];
    document.getElementById("i5_gol3").innerHTML = gol3darr[4];
    document.getElementById("i5_gol4").innerHTML = gol4darr[4];
    document.getElementById("i5_gol5").innerHTML = gol5darr[4];


    $('#myModal').modal('show');
});
</script>



