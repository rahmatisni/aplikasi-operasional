<style>
    .dataTable>thead>tr>th[class*="sort"]:before,
    .dataTable>thead>tr>th[class*="sort"]:after {
        content: "" !important;
    }

    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
        top: 10px;

    }

    td:nth-child(1) {
        color: white;
    }

    /* td:nth-child(2){
color: white;
} */

    th {
        background-color: #1F2739;
        text-align: center;
        color: white;
    }

    td {
        width: auto;
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
</style>
<?php

$someObject2 = json_decode($namanyagerbang);
$namanyagerbang = json_decode(json_encode($someObject2), true);
$new_array = array();
for ($i = 0; $i < count($fullgerbang2); $i++) {
    for ($x = 0; $x < sizeof($namanyagerbang); $x++) {
        // print_r($listdatagerbang[$x]['gerbang_id'].'//');
        if ($fullgerbang2[$i]['gerbang_id'] == $namanyagerbang[$x]['gerbang_id']) {
            $gerbang_namas = $namanyagerbang[$x]['gerbang_nama'];
            $arr_gerbang_id = $fullgerbang2[$i]['gerbang_id'];
            $arr_gol1 = $fullgerbang2[$i]['Gol1'];
            $arr_gol1_d = $fullgerbang2[$i]['Gol1_d'];
            $arr_gol2 = $fullgerbang2[$i]['Gol2'];
            $arr_gol2_d = $fullgerbang2[$i]['Gol2_d'];
            $arr_gol3 = $fullgerbang2[$i]['Gol3'];
            $arr_gol3_d = $fullgerbang2[$i]['Gol3_d'];
            $arr_gol4 = $fullgerbang2[$i]['Gol4'];
            $arr_gol4_d = $fullgerbang2[$i]['Gol4_d'];
            $arr_gol5 = $fullgerbang2[$i]['Gol5'];
            $arr_gol5_d = $fullgerbang2[$i]['Gol5_d'];

            $id_dasar_tarif = $fullgerbang2[$i]['id_tarif'];
            $tgl_berlaku = $fullgerbang2[$i]['tgl'];
            $tarif_inv = $fullgerbang2[$i]['tarif_inv'];


            $new_array[] = array(
                "gerbang_nama" => "$gerbang_namas", "gerbang_id" => "$arr_gerbang_id", "Gol1" => "$arr_gol1", "Gol2" => "$arr_gol2", "Gol3" => "$arr_gol3", "Gol4" => "$arr_gol4", "Gol5" => "$arr_gol5", "Gol1_d" => "$arr_gol1_d", "Gol2_d" => "$arr_gol2_d", "Gol3_d" => "$arr_gol3_d", "Gol4_d" => "$arr_gol4_d", "Gol5_d" => "$arr_gol5_d", "tgl" => "$tgl_berlaku", "id_tarif" => "$id_dasar_tarif", "tarif_inv" => "$tarif_inv",

            );
        } else {
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
                    <h1 style="text-align:center" ;>Daftar Tarif Gerbang Open JKC</h1>

                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a href="<?= base_url('main/matriks_tarif_close') ?>">
                            <btn id="matriksclose" style="width:auto;" class="btn btn-default" href="#"><span class="hidden-sm">Matriks Tarif Close</span> </btn>
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
                                    <th>Golongan 1</th>
                                    <th>Golongan 2</th>
                                    <th>Golongan 3</th>
                                    <th>Golongan 4</th>
                                    <th>Golongan 5</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($new_array); $i++) { ?>
                                    <tr>
                                        <td><?php print_r($new_array[$i]['gerbang_nama']) ?></td>
                                        <?php
                                        for ($z = 1; $z <= 5; $z++) {
                                        ?>
                                            <td><a href="#" class="passingID" data-gerbang="<?php print_r($new_array[$i]['gerbang_nama']) ?>" data-investor="<?php print_r($new_array[$i]['tarif_inv']) ?>" data-gol1d="<?php print_r($new_array[$i]['Gol1_d']) ?>" data-gol2d="<?php print_r($new_array[$i]['Gol2_d']) ?>" data-gol3d="<?php print_r($new_array[$i]['Gol3_d']) ?>" data-gol4d="<?php print_r($new_array[$i]['Gol4_d']) ?>" data-gol5d="<?php print_r($new_array[$i]['Gol5_d']) ?>">
                                                    <?php
                                                    $hasil_rupiah = "Rp " . number_format($new_array[$i]['Gol' . $z], 2, ',', '.');
                                                    print_r($hasil_rupiah);
                                                    ?></a>
                                            </td>
                                        <?php
                                        }
                                        ?>
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



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Detail Investor</h3>
                <i class="fa fa-automobile" style="font-size:20px;"></i>
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


            // scrollY:        "800px",
            // scrollX:        true,
            // scrollCollapse: true,
            paging: false

        });
    });
    $(".passingID").click(function() {
        var gerbangName = $(this).attr('data-gerbang');


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