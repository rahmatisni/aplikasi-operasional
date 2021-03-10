<style>
    .dataTable>thead>tr>th[class*="sort"]:before,
    .dataTable>thead>tr>th[class*="sort"]:after {
        content: "" !important;
    }

    div.dataTables_wrapper {
        /* width: 85%; */
        margin: 0 auto;
        top: 10px;
    }

    td:nth-child(1) {
        color: white;
        position: relative;
        top: -12px;
        height: 40px;
    }

    td:nth-child(2) {
        color: white;
        position: relative;
        top: -12px;
        height: 40px;
    }

    th {
        background-color: #1F2739;
        text-align: center;
        color: white;
    }

    td {
        text-align: center;
        color: yellow;
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
        .container th:nth-child(4) {
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

    a {
        color: yellow;
    }

    /* CSS link color */
</style>



<?php
error_reporting(0);
ini_set('display_errors', 0);

$arr_gerbang_id = array();
$arr_asal_gerbang = array();
$arr_gol1 = array();
$arr_gol2 = array();
$arr_gol3 = array();
$arr_gol4 = array();
$arr_gol5 = array();
$arr_jenis = array();
$tgl_berlaku = array();
$tarif_inv = array();
$id_dasar_tarif = array();
$gerbang_id_count = array();
$gerbang_asal_count = array();


$someObject = json_decode($fullgerbang);
$elementCount  = count($someObject);
// var_dump($someObject);


$someObject2 = json_decode($namanyagerbang);
$listdatagerbang = json_decode(json_encode($someObject2), true);
// var_dump($listdatagerbang);

// $jmlentrance = array_values (array_unique($arr_asal_gerbang));

$fullgerbang3 = json_decode(json_encode($fullgerbang3), true);
// var_dump($fullgerbang3);

$namanyagerbang = json_decode(($namanyagerbang), true);
// var_dump($namanyagerbang);


$new_array = array();
for ($i = 0; $i < sizeof($fullgerbang3); $i++) {
    for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
        // print_r($namanyagerbang[$x]['gerbang_id'].'//');
        if ($fullgerbang3[$i]['gerbang_id'] == $namanyagerbang[$x]['gerbang_id']) {
            $gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];
            $arr_gerbang_id = $fullgerbang3[$i]['gerbang_id'];
            $arr_asal_gerbang = $fullgerbang3[$i]['asal_gerbang'];
            $arr_gol1 = $fullgerbang3[$i]['Gol1'];
            $arr_gol2 = $fullgerbang3[$i]['Gol2'];
            $arr_gol3 = $fullgerbang3[$i]['Gol3'];
            $arr_gol4 = $fullgerbang3[$i]['Gol4'];
            $arr_gol5 = $fullgerbang3[$i]['Gol5'];
            $arr_gol1d = $fullgerbang3[$i]['Gol1_d'];
            $arr_gol2d = $fullgerbang3[$i]['Gol2_d'];
            $arr_gol3d = $fullgerbang3[$i]['Gol3_d'];
            $arr_gol4d = $fullgerbang3[$i]['Gol4_d'];
            $arr_gol5d = $fullgerbang3[$i]['Gol5_d'];
            $arr_jenis = $fullgerbang3[$i]['jenis'];
            $id_dasar_tarif = $fullgerbang3[$i]['id_tarif'];
            $tgl_berlaku = $fullgerbang3[$i]['tgl'];
            $tarif_inv = $fullgerbang3[$i]['tarif_inv'];

            array_push($gerbang_id_count, $arr_gerbang_id);
            array_push($gerbang_asal_count, $arr_asal_gerbang);

            $new_array[] = array("gerbang_nama" => "$gerbang_namas", "jenis" => "$arr_jenis", "asal_gerbang" => "$arr_asal_gerbang", "gerbang_id" => "$arr_gerbang_id", "Gol1" => "$arr_gol1", "Gol2" => "$arr_gol2", "Gol3" => "$arr_gol3", "Gol4" => "$arr_gol4", "Gol5" => "$arr_gol5", "Gol1_d" => "$arr_gol1d", "Gol2_d" => "$arr_gol2d", "Gol3_d" => "$arr_gol3d", "Gol4_d" => "$arr_gol4d", "Gol5_d" => "$arr_gol5d", "tgl" => "$tgl_berlaku", "id_tarif" => "$id_dasar_tarif", "tarif_inv" => "$tarif_inv");
            // print_r("true");
            // echo "<br>";

        } else {
        }
    }
}
// $my_arrays = array_unique($new_array, SORT_REGULAR);
$myArray  = array_values($new_array);
// $arraygerbangid = array_values (array_unique($arr_gerbang_id));
$jmlexit = array_values(array_unique($gerbang_id_count));
$jmlentrance = array_values(array_unique($gerbang_asal_count));

// var_dump($new_array);
// print_r(sizeof($jmlexit));
// for ($i=0; $i < sizeof($jmlexit); $i++ ){
//     print($jmlexit[$i]);

// }
// var_dump($fullgerbang3);


// print_r(sizeof($arraygerbangid));

$span = sizeof($jmlentrance)-3;
// var_dump($jmlentrance);
// var_dump($arr_gerbang_id);

// var_dump($new_array);
// for ($i = 0; $i <count($myArray); $i++) {
//     print_r($myArray[$i]);    
//     echo "<br>";
// }

?>



<div class="container-fluid">

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 style="text-align:center" ;>Daftar Tarif Gerbang Close CSJ</h1>

                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a href="<?= base_url('main/matriks_tarif_open') ?>">
                            <btn id="matriksopen" style="width:auto;" class="btn btn-default" href="#"><span class="hidden-sm">Matriks Tarif Open</span> </btn>
                        </a>
                        <a href="<?= base_url('main/daftar_tarif') ?>">
                            <btn id="x" style="width:auto; margin-right:15px;" class="btn btn-default" href="#"><i class="fa fa-close"></i> <span class="hidden-sm"></span> </btn>
                        </a>
                    </div>

                    <div class="panel-body">

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Gerbang</th>
                                    <th></th>

                                    <th style="text-align:center;" colspan='<?php echo ($span + 1) ?>'>Asal</th>
                                </tr>
                                <tr>
                                    <th>Exit</th>
                                    <th>Golongan</th>

                                    <?php
                                    // var_dump($jmlexit);
                                    // var_dump($jmlentrance);


                                    for ($i = 0; $i < sizeof($jmlentrance); $i++) { // first loop
                                        // echo '<th>';
                                        for ($x = 0; $x < sizeof($listdatagerbang); $x++) { // first loop
                                            if ($jmlentrance[$i] != $listdatagerbang[$x]['gerbang_id']) {
                                                // print_r($jmlexit[$i]);
                                                // print_r($listdatagerbang[$i]['gerbang_id']);
                                            } else {
                                                echo '<th>';

                                                print_r($listdatagerbang[$x]['gerbang_nama']);
                                                print_r("-");
                                                print_r($listdatagerbang[$x]['gerbang_id']);
                                                echo '</th>';

                                            }
                                        }
                                        // echo '</th>';
                                    }
                                    ?>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                for ($row = 1; $row < sizeof($jmlexit) + 1; $row++) { // first loop
                                    // for ($col = 0; $col < sizeof($jmlentrance) + 1; $col++) { //2nd loop
                                    for ($col = 0; $col < sizeof($jmlentrance) + 1; $col++) { //2nd loop

                                        if ($row == 0 && $col == 0) {
                                            echo '<td> Asal Gerbang </td>';
                                            echo '<td> Golongan </td>';
                                        } else if ($row == 0 && $col != 0) {

                                            echo '<td>';
                                            // print_r(sizeof($listdatagerbang));
                                            for ($i = 0; $i < sizeof($listdatagerbang); $i++) {
                                                // print_r("x");
                                                if ($jmlentrance[$col - 1] != $listdatagerbang[$i]['gerbang_id']) {
                                                } else {
                                                    print_r($listdatagerbang[$i]['gerbang_nama']);
                                                    // print_r ("//");
                                                    // print_r($listdatagerbang[$i]['gerbang_id']);

                                                }
                                            }
                                            // print_r(" ".$jmlexit[$col-1]);
                                            echo '</td>';
                                        } else if ($row != 0 && $col == 0) {

                                            echo '<td>';
                                            for ($i = 0; $i < sizeof($listdatagerbang); $i++) {
                                                // print_r("x");
                                                if ($jmlexit[$row - 1] != $listdatagerbang[$i]['gerbang_id']) {
                                                } else {
                                                    print_r($listdatagerbang[$i]['gerbang_nama']);
                                                    print_r("=");
                                                    print_r($listdatagerbang[$i]['gerbang_id']);
                                                }
                                            }

                                            // print_r($jmlentrance[$row-1]);
                                            echo '</td>';
                                            echo '<td > Golongan 1</td>';
                                        } else {
                                            // $p = $col * $row; //computing values
                                            if ($jmlexit[$row - 1] == $jmlentrance[$col - 1]) {

                                                echo '<td style="background-color:#AC2929">';
                                                echo '<a href="#" class="passingID" data-gerbang="' . ($new_array[$i]['gerbang_nama']) . '"';

                                                $asal_trx = array();
                                                // var_dump($namanyagerbang);
                                                for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
                                                    // print_r($namanyagerbang[$x]['gerbang_id'].'//');
                                                    if ($new_array[$i]['asal_gerbang'] == $namanyagerbang[$x]['gerbang_id']) {
                                                        $asal_gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];

                                                        $asal_trx[] = array("asal_gerbang_nama" => "$asal_gerbang_namas");
                                                    } else {
                                                    }
                                                }
                                                echo 'data-gerbang-asal="' . ($asal_trx[0]['asal_gerbang_nama']) . '"';
                                                echo 'data-investor="' . ($new_array[$i]['tarif_inv']) . '"';
                                                echo 'data-gol1d="' . ($new_array[$i]['Gol1_d']) . '"';
                                                echo 'data-gol2d="' . ($new_array[$i]['Gol2_d']) . '"';
                                                echo 'data-gol3d="' . ($new_array[$i]['Gol3_d']) . '"';
                                                echo 'data-gol4d="' . ($new_array[$i]['Gol4_d']) . '"';
                                                echo 'data-gol5d="' . ($new_array[$i]['Gol5_d']) . '"';
                                                echo '>';
                                                $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'], 2, ',', '.');
                                                print_r($hasil_rupiah);
                                                // print_r($i);

                                                // print_r($new_array[0]['tarif_inv']);
                                                echo '</a>';
                                                echo '</td>';
                                            } else {

                                                for ($i = 0; $i < sizeof($myArray); $i++) {
                                                    // print_r("z");
                                                    if ($jmlexit[$row - 1] != $myArray[$i]['gerbang_id'] || $jmlentrance[$col - 1] != $myArray[$i]['asal_gerbang']) {
                                                    } else {
                                                        if ($myArray[$i]['jenis'] == 'ags') {
                                                            echo '<td style="background-color:#AC2929">';
                                                        } elseif ($myArray[$i]['jenis'] == 'khl') {
                                                            echo '<td style="background-color:#FFFF00">';
                                                        } else {
                                                            echo '<td style="background-color:GREEN">';
                                                        }
                                                        // echo '<td style="background-color:#AC2929">';
                                                        echo '<a href="#" class="passingID" data-gerbang="' . ($new_array[$i]['gerbang_nama']) . '"';

                                                        $asal_trx = array();
                                                        // var_dump($namanyagerbang);
                                                        for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
                                                            // print_r($namanyagerbang[$x]['gerbang_id'].'//');
                                                            if ($new_array[$i]['asal_gerbang'] == $namanyagerbang[$x]['gerbang_id']) {
                                                                $asal_gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];

                                                                $asal_trx[] = array("asal_gerbang_nama" => "$asal_gerbang_namas");
                                                            } else {
                                                            }
                                                        }
                                                        echo 'data-gerbang-asal="' . ($asal_trx[0]['asal_gerbang_nama']) . '"';
                                                        echo 'data-investor="' . ($new_array[$i]['tarif_inv']) . '"';
                                                        echo 'data-gol1d="' . ($new_array[$i]['Gol1_d']) . '"';
                                                        echo 'data-gol2d="' . ($new_array[$i]['Gol2_d']) . '"';
                                                        echo 'data-gol3d="' . ($new_array[$i]['Gol3_d']) . '"';
                                                        echo 'data-gol4d="' . ($new_array[$i]['Gol4_d']) . '"';
                                                        echo 'data-gol5d="' . ($new_array[$i]['Gol5_d']) . '"';
                                                        echo '>';
                                                        $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'], 2, ',', '.');
                                                        print_r($hasil_rupiah);
                                                        // print_r($i);

                                                        // print_r($new_array[0]['tarif_inv']);
                                                        echo '</a>';
                                                        echo '</td>';

                                                        // $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'],2,',','.');
                                                        // print_r($hasil_rupiah);
                                                        // echo '</td>';
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    echo '</tr>';

                                    for ($q = 2; $q <= 5; $q++) {
                                        echo '<tr>';
                                        echo '<td>&nbsp</td>';
                                        echo '<td> Golongan' . $q . '</td>';

                                        for ($col = 1; $col < sizeof($jmlentrance) + 1; $col++) { //2nd loop
                                            // echo '<td>';
                                            // print_r("ags");
                                            // echo '</td>';  
                                            if ($jmlexit[$row - 1] == $jmlentrance[$col - 1]) {
                                                echo '<td style="background-color:#AC2929">';
                                                echo '<a href="#" class="passingID" data-gerbang="' . ($new_array[$i]['gerbang_nama']) . '"';

                                                $asal_trx = array();
                                                // var_dump($namanyagerbang);
                                                for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
                                                    // print_r($namanyagerbang[$x]['gerbang_id'].'//');
                                                    if ($new_array[$i]['asal_gerbang'] == $namanyagerbang[$x]['gerbang_id']) {
                                                        $asal_gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];

                                                        $asal_trx[] = array("asal_gerbang_nama" => "$asal_gerbang_namas");
                                                    } else {
                                                    }
                                                }
                                                echo 'data-gerbang-asal="' . ($asal_trx[0]['asal_gerbang_nama']) . '"';
                                                echo 'data-investor="' . ($new_array[$i]['tarif_inv']) . '"';
                                                echo 'data-gol1d="' . ($new_array[$i]['Gol1_d']) . '"';
                                                echo 'data-gol2d="' . ($new_array[$i]['Gol2_d']) . '"';
                                                echo 'data-gol3d="' . ($new_array[$i]['Gol3_d']) . '"';
                                                echo 'data-gol4d="' . ($new_array[$i]['Gol4_d']) . '"';
                                                echo 'data-gol5d="' . ($new_array[$i]['Gol5_d']) . '"';
                                                echo '>';
                                                $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'], 2, ',', '.');
                                                print_r($hasil_rupiah);
                                                // print_r($i);

                                                // print_r($new_array[0]['tarif_inv']);
                                                echo '</a>';

                                                echo '</a>';
                                                echo '</td>';
                                            } else {
                                                for ($i = 0; $i < sizeof($myArray); $i++) {
                                                    // print_r("z");
                                                    if ($jmlexit[$row - 1] != $myArray[$i]['gerbang_id'] || $jmlentrance[$col - 1] != $myArray[$i]['asal_gerbang']) {
                                                    }
                                                    // eles if () {


                                                    // }
                                                    else {
                                                        if ($myArray[$i]['jenis'] == 'ags') {
                                                            echo '<td style="background-color:#AC2929">';
                                                        } elseif ($myArray[$i]['jenis'] == 'khl') {
                                                            echo '<td style="background-color:#FFFF00">';
                                                        } else {
                                                            echo '<td style="background-color:GREEN">';
                                                        }
                                                        // echo '<td style="background-color:#AC2929">';
                                                        echo '<a href="#" class="passingID" data-gerbang="' . ($new_array[$i]['gerbang_nama']) . '"';

                                                        $asal_trx = array();
                                                        // var_dump($namanyagerbang);
                                                        for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
                                                            // print_r($namanyagerbang[$x]['gerbang_id'].'//');
                                                            if ($new_array[$i]['asal_gerbang'] == $namanyagerbang[$x]['gerbang_id']) {
                                                                $asal_gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];

                                                                $asal_trx[] = array("asal_gerbang_nama" => "$asal_gerbang_namas");
                                                            } else {
                                                            }
                                                        }
                                                        echo 'data-gerbang-asal="' . ($asal_trx[0]['asal_gerbang_nama']) . '"';

                                                        echo 'data-investor="' . ($new_array[$i]['tarif_inv']) . '"';
                                                        echo 'data-gol1d="' . ($new_array[$i]['Gol1_d']) . '"';
                                                        echo 'data-gol2d="' . ($new_array[$i]['Gol2_d']) . '"';
                                                        echo 'data-gol3d="' . ($new_array[$i]['Gol3_d']) . '"';
                                                        echo 'data-gol4d="' . ($new_array[$i]['Gol4_d']) . '"';
                                                        echo 'data-gol5d="' . ($new_array[$i]['Gol5_d']) . '"';
                                                        echo '>';
                                                        $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol' . $q], 2, ',', '.');
                                                        print_r($hasil_rupiah);

                                                        echo '</a>';
                                                        echo '</td>';

                                                        // $hasil_rupiah = "Rp " . number_format($myArray[$i]['Gol1'],2,',','.');
                                                        // print_r($hasil_rupiah);
                                                        // echo '</td>';
                                                        break;
                                                    }
                                                }
                                            }
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
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-2" style="color: white">
                            <h4>Investor</h4>
                        </div>
                        <div class="col-sm-2" style="color: white">
                            <h4>Gol 1</h4>
                        </div>
                        <div class="col-sm-2" style="color: white">
                            <h4>Gol 2</h4>
                        </div>
                        <div class="col-sm-2" style="color: white">
                            <h4>Gol 3</h4>
                        </div>
                        <div class="col-sm-2" style="color: white">
                            <h4>Gol 4</h4>
                        </div>
                        <div class="col-sm-2" style="color: white">
                            <h4>Gol 5</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
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
                    <div class="row">
                        <div class="col-sm-2"><label id="investor6" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i6_gol1" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i6_gol2" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i6_gol3" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i6_gol4" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i6_gol5" style="color: white"></label></div>
                    </div>  
                    <!-- <div class="row">
                        <div class="col-sm-2"><label id="investor7" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i7_gol1" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i7_gol2" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i7_gol3" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i7_gol4" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i7_gol5" style="color: white"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><label id="investor8" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i8_gol1" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i8_gol2" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i8_gol3" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i8_gol4" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i8_gol5" style="color: white"></label></div>
                    </div>  
                    <div class="row">
                        <div class="col-sm-2"><label id="investor9" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i9_gol1" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i9_gol2" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i9_gol3" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i9_gol4" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i9_gol5" style="color: white"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><label id="investor10" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i10_gol1" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i10_gol2" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i10_gol3" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i10_gol4" style="color: white"></label></div>
                        <div class="col-sm-2"><label id="i10_gol5" style="color: white"></label></div>
                    </div> -->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "bFilter": false,
            "bInfo": false,
            "aaSorting": [],
            "bSort": false,
            scrollY: "800px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 2
            },
        });
    });
</script>

<script>
    $(".passingID").click(function() {
        var gerbangName = $(this).attr('data-gerbang');
        var gerbangNames = $(this).attr('data-gerbang-asal');



        var investor = $(this).attr('data-investor');
        var investor = investor.replace('[', '');
        var investor = investor.replace(']', '');
        var investor1 = investor.split(',');

        var gol1d = $(this).attr('data-gol1d');
        var gol1d = gol1d.replace('[', '');
        var gol1d = gol1d.replace(']', '');
        var gol1darr = gol1d.split(',');

        var gol2d = $(this).attr('data-gol2d');
        var gol2d = gol2d.replace('[', '');
        var gol2d = gol2d.replace(']', '');
        var gol2darr = gol2d.split(',');

        var gol3d = $(this).attr('data-gol3d');
        var gol3d = gol3d.replace('[', '');
        var gol3d = gol3d.replace(']', '');
        var gol3darr = gol3d.split(',');

        var gol4d = $(this).attr('data-gol4d');
        var gol4d = gol4d.replace('[', '');
        var gol4d = gol4d.replace(']', '');
        var gol4darr = gol4d.split(',');

        var gol5d = $(this).attr('data-gol5d');
        var gol5d = gol5d.replace('[', '');
        var gol5d = gol5d.replace(']', '');
        var gol5darr = gol5d.split(',');

        document.getElementById("judulgerbang").innerHTML = gerbangName;
        document.getElementById("judulgerbangasal").innerHTML = gerbangNames;
        // console.log(investor1[0]);

        document.getElementById("investor1").innerHTML = investor1[0];
        document.getElementById("investor2").innerHTML = investor1[1];
        document.getElementById("investor3").innerHTML = investor1[2];
        document.getElementById("investor4").innerHTML = investor1[3];
        document.getElementById("investor5").innerHTML = investor1[4];
        document.getElementById("investor6").innerHTML = investor1[5];
        // document.getElementById("investor7").innerHTML = investor1[6];
        // document.getElementById("investor8").innerHTML = investor1[7];
        // document.getElementById("investor9").innerHTML = investor1[8];
        // document.getElementById("investor10").innerHTML = investor1[9];


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

        document.getElementById("i6_gol1").innerHTML = gol1darr[5];
        document.getElementById("i6_gol2").innerHTML = gol2darr[5];
        document.getElementById("i6_gol3").innerHTML = gol3darr[5];
        document.getElementById("i6_gol4").innerHTML = gol4darr[5];
        document.getElementById("i6_gol5").innerHTML = gol5darr[5];

        // document.getElementById("i7_gol1").innerHTML = gol1darr[6];
        // document.getElementById("i7_gol2").innerHTML = gol2darr[6];
        // document.getElementById("i7_gol3").innerHTML = gol3darr[6];
        // document.getElementById("i7_gol4").innerHTML = gol4darr[6];
        // document.getElementById("i7_gol5").innerHTML = gol5darr[6];

        // document.getElementById("i8_gol1").innerHTML = gol1darr[7];
        // document.getElementById("i8_gol2").innerHTML = gol2darr[7];
        // document.getElementById("i8_gol3").innerHTML = gol3darr[7];
        // document.getElementById("i8_gol4").innerHTML = gol4darr[7];
        // document.getElementById("i8_gol5").innerHTML = gol5darr[7];

        // document.getElementById("i9_gol1").innerHTML = gol1darr[8];
        // document.getElementById("i9_gol2").innerHTML = gol2darr[8];
        // document.getElementById("i9_gol3").innerHTML = gol3darr[8];
        // document.getElementById("i9_gol4").innerHTML = gol4darr[8];
        // document.getElementById("i9_gol5").innerHTML = gol5darr[8];

        // document.getElementById("i8_gol1").innerHTML = gol1darr[9];
        // document.getElementById("i8_gol2").innerHTML = gol2darr[9];
        // document.getElementById("i8_gol3").innerHTML = gol3darr[9];
        // document.getElementById("i8_gol4").innerHTML = gol4darr[9];
        // document.getElementById("i8_gol5").innerHTML = gol5darr[9];

        // document.getElementById("i9_gol1").innerHTML = gol1darr[10];
        // document.getElementById("i9_gol2").innerHTML = gol2darr[10];
        // document.getElementById("i9_gol3").innerHTML = gol3darr[10];
        // document.getElementById("i9_gol4").innerHTML = gol4darr[10];
        // document.getElementById("i9_gol5").innerHTML = gol5darr[10];


        $('#myModal').modal('show');
    });
</script>