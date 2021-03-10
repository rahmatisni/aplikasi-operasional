<?php

$var_value = $_POST['inputopen'];

// echo($meneng);

// var_dump($GerbangOption);
?>

<?php
    $someObject = json_decode($fullgerbang);
    $elementCount  = count($someObject);

    $someObject2 = json_decode($namanyagerbang);
    $listdatagerbang = json_decode(json_encode($someObject2), true);

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
    // var_dump($gerbanglistoption);

    // echo($gerbanglistoption[0]['gerbang_nama']);

    // var_dump($matriksopenf);
    // var_dump($arr_gerbang_id);
    // var_dump($listdatagerbang);

    $matriksopenf = json_decode(json_encode($matriksopenf), true);
    $new_array = array();
    for ($i = 0; $i <sizeof($matriksopenf); $i++) {
        for ($x = 0; $x < sizeof($listdatagerbang); $x++) {
            if ($matriksopenf[$i]['gerbang_id'] == $listdatagerbang[$x]['gerbang_id']){
                // print_r($listdatagerbang[$x]['gerbang_id'].'//'.$matriksopenf[$i]['gerbang_id']);
                $gerbang_namas = $listdatagerbang[$x]['gerbang_nama'];
                $arr_gerbang_id = $matriksopenf[$i]['gerbang_id'];
                $arr_gol1 = $matriksopenf[$i]['gol1'];
                $arr_gol2 = $matriksopenf[$i]['gol2'];
                $arr_gol3 = $matriksopenf[$i]['gol3'];
                $arr_gol4 = $matriksopenf[$i]['gol4'];
                $arr_gol5 = $matriksopenf[$i]['gol5'];
                $arr_gol1_d = $matriksopenf[$i]['gol1_d'];
                $arr_gol2_d = $matriksopenf[$i]['gol2_d'];
                $arr_gol3_d = $matriksopenf[$i]['gol3_d'];
                $arr_gol4_d = $matriksopenf[$i]['gol4_d'];
                $arr_gol5_d = $matriksopenf[$i]['gol5_d'];

                $tgl_berlaku = $matriksopenf[$i]['tgl_berlaku'];
                $id_dasar_tarif = $matriksopenf[$i]['id_dasar_tarif'];
                $tarif_inv = $matriksopenf[$i]['tarif_inv'];

                $new_array[] = array("gerbang_nama"=>"$gerbang_namas","gerbang_id"=>"$arr_gerbang_id", "Gol1"=>"$arr_gol1", "Gol2"=>"$arr_gol2", "Gol3"=>"$arr_gol3", "Gol4"=>"$arr_gol4", "Gol5"=>"$arr_gol5", "tgl"=>"$tgl_berlaku","id_tarif"=>"$id_dasar_tarif","Gol1_d"=>"$arr_gol1_d", "Gol2_d"=>"$arr_gol2_d", "Gol3_d"=>"$arr_gol3_d", "Gol4_d"=>"$arr_gol4_d", "Gol5_d"=>"$arr_gol5_d","tarif_inv"=>"$tarif_inv");   
                // print_r("true");
                // echo "<br>";

            }
            else {
            }
        }

    }


    // var_dump($new_array);
    // $new_array = array_unique($new_array, SORT_REGULAR);
    // $new_array  = array_values($new_array);

    // array_multisort(array_column($new_array, 'tgl'), SORT_ASC, $new_array);

?>

<style>
.dataTable > thead > tr > th[class*="sort"]:before,
.dataTable > thead > tr > th[class*="sort"]:after {
content: "" !important;
}

div.dataTables_wrapper {
    width: 90%;
    margin: 0 auto;
    top:10px;

}

td:nth-child(1){
    color: white;
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


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a href="<?=base_url('main/matriks_tarif_open')?>">
                            <btn id="matriksopen" style="width:auto;" class="btn btn-default" href="#"><i class="fa fa-eye"></i> <span class="hidden-sm">Matriks Tarif Open</span> </btn>
                        </a>
                        <a href="<?=base_url('main/matriks_tarif_close')?>">
                            <btn id="matriksclose" style="width:auto;" class="btn btn-default" href="#"><i class="fa fa-eye"></i> <span class="hidden-sm">Matriks Tarif Close</span> </btn>
                        </a>
                    </div>
                
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
                                        if ($row->jenis_gerbang != '2' && $row->ruas_id == '40') {
                                    // kode ruas
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
                    </div>

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
                <h1 style="text-align:center";>Daftar Tarif Gerbang Open JKC</h1>
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
                                <?php
                                            for ($z = 1; $z<=5; $z++) {
                                            ?>
                                                <td><a href="#" class="passingID" 
                                                    data-gerbang="<?php print_r($new_array[$i]['gerbang_nama'])?>"  
                                                    data-investor="<?php print_r($new_array[$i]['tarif_inv'])?>"  
                                                    data-gol1d="<?php print_r($new_array[$i]['Gol1_d'])?>"  
                                                    data-gol2d="<?php print_r($new_array[$i]['Gol2_d'])?>"  
                                                    data-gol3d="<?php print_r($new_array[$i]['Gol3_d'])?>"  
                                                    data-gol4d="<?php print_r($new_array[$i]['Gol4_d'])?>"  
                                                    data-gol5d="<?php print_r($new_array[$i]['Gol5_d'])?>"
                                                    ><?php 
                                                        $hasil_rupiah = "Rp " . number_format($new_array[$i]['Gol'.$z],2,',','.');
                                                        print_r($hasil_rupiah);
                                                        // print_r($new_array[$i]['Gol'.$z])
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

                <div class="panel-footer">
                    <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> last edited at 02/01/2016 18:00</span>
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
        location.replace("<?=base_url('main/daftar_tarif')?>")

    }
}

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

$('#example').show();
$('#matriksopen').hide();
$('#matriksclose').hide();

function goBack() {
  window.history.back();
}

</script>
<script>
$(".passingID").click(function () {
    var gerbangName = $(this).attr('data-gerbang');


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




