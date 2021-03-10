<?php
    // var_dump($namagerbang);
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default panel-widget">
                <div class="panel-body">
                <span class="panel-title  text-black"><i class="fa fa-fw fa-users"></i> Daftar Tarif Gerbang</span>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">                
                    <div class="pull-left" style="width:200px">
                        <select class="form-control" id="gerbang" name="gerbang">
                            <option selected value="default">Pilih Database</option>
                            <?php 
                                if(count($GerbangExit)> 0)
                                {
                                    foreach ($GerbangExit as $row) 
                                    {
                                        echo '<option value='.$row->gerbang_id.'>'.ucfirst($row->gerbang_nama).' - '.$row->gerbang_id.'</option>';
                                    }
                                } 
                                else
                                {
                                    echo'<option value="0">Data Not Found</option>';  
                                }
                            ?>
                        </select>      



         
                    </div>
                    <btn id="btnDaftarTarif" style="margin-left:10px; width:100px;"  class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <btn id="refreshDaftarTarif" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
                        <btn id="btnAddDaftarTarif" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></btn>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full" style="padding:10px;">
                    <table id="tabelDaftarTarif" class="table table-stripped table-hover table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-center text-nowrap">Nama Gerbang</th>
                                <th class="text-center text-nowrap">Asal Gerbang</th>
                                <th class="text-center text-nowrap">Jenis Transaksi</th>
                                <th class="text-center text-nowrap">Dasar Tarif</th>
                                <th class="text-center text-nowrap">Golongan 1</th>
                                <th class="text-center text-nowrap">Golongan 2</th>
                                <th class="text-center text-nowrap">Golongan 3</th>
                                <th class="text-center text-nowrap">Golongan 4</th>
                                <th class="text-center text-nowrap">Golongan 5</th>
                                <th class="text-center text-nowrap">Waktu Berlaku</th>
                                <th class="text-center text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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


<!-- Modal-->
<div class="modal fade" id="DaftarTarifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document"  style="width:1250px;">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="DaftarTarif-modal-tittle" class="modal-title">Tambah</h3>
			</div>

			<div class="modal-body">
				<form id="form-tambah-edit-DaftarTarif" id="form-tambah-edit-DaftarTarif">
                
                <div class="container-fluid">
                <div class="row">
                <div class="col-8 col-sm-6">


                    <div class="form-group">						
						<label for="exampleInputEmail1">Nama Gerbang :</label>
                        <select class="form-control" id="gerbangmodal" name="gerbangmodal" readonly="readonly"> 
                        </select>
					</div>
                    <div class="form-group">						
						<input type="hidden" name="id" id="id"/>
					</div>

                    <div class="form-group">						
						<label for="exampleInputEmail1">Asal Gerbang :</label>
                        <select class="form-control" id="asal_gerbang" name="asal_gerbang" required> 
                        <?php
                        foreach ($GerbangOption as $row) 
                            {
                                echo '<option value='.$row->gerbang_id.'>'.ucfirst($row->gerbang_nama).' - '.$row->gerbang_id.'</option>';
                            }
                        ?>
                        </select>
					</div>
					<div class="form-group">						
						<label for="exampleInputEmail1">Dasar Tarif :</label>
                        <select class="form-control" id="dasartarifmodal" name="dasartarifmodal" required> 
                       
                        </select>
					</div>
                    

                    <div class="form-group">						
						<label for="exampleInputEmail1">Jenis Transaksi :</label>
                        <select class="form-control" id="jenis" name="jenis" required> 
                            <option value="3">NORMAL</option>
                            <option value="1">KHL</option>
                            <option value="2">AGS</option>
                        </select>
					</div>

                 

                    <div class="form-group">						
						<label for="exampleInputEmail1">Waktu Berlaku :</label>
						<input type="text" class="form-control" name="waktu" id="waktu" aria-describedby="waktu" placeholder="Waktu Berlaku" required>
					</div>	                  
					</div>	                  



                    <div class="col-4 col-sm-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Daftar Tarif  :</label>
                        <ul class="nav nav-tabs mb-3">
                            <li class="active"><a data-toggle="tab" href="#gol1">Golongan 1</a></li>
                            <li><a data-toggle="tab" href="#gol2">Golongan 2</a></li>
                            <li><a data-toggle="tab" href="#gol3">Golongan 3</a></li>
                            <li><a data-toggle="tab" href="#gol4">Golongan 4</a></li>
                            <li><a data-toggle="tab" href="#gol5">Golongan 5</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="gol1" class="tab-pane bounce in active">
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MTN Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mtngol1" id="mtngol1"  onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Janger Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jangergol1" id="jangergol1"  onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MMS Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mmsgol1" id="mmsgol1"  onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">BSD Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="bsdgol1" id="bsdgol1"  onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">CSJ Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="csjgol1" id="csjgol1"  onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">JKC Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jkcgol1" id="jkcgol1"  onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Total Gol 1 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="totalgol1" id="totalgol1" aria-describedby="waktu" placeholder="" readonly >
                                    </div>                               
                                </div>	                                
                            </div>
                            <div id="gol2" class="tab-pane fade">
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MTN Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mtngol2" id="mtngol2" onkeyup="sum_gol(2)" aria-describedby="mtngol2" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Janger Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jangergol2" id="jangergol2" onkeyup="sum_gol(2)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MMS Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mmsgol2" id="mmsgol2"  onkeyup="sum_gol(2)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">BSD Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="bsdgol2" id="bsdgol2" onkeyup="sum_gol(2)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">CSJ Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="csjgol2" id="csjgol2" onkeyup="sum_gol(2)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">JKC Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jkcgol2" id="jkcgol2" onkeyup="sum_gol(2)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Total Gol 2 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="totalgol2" id="totalgol2" aria-describedby="waktu" placeholder="" readonly>
                                    </div>                               
                                </div>	        
                            </div>
                            <div id="gol3" class="tab-pane fade">
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MTN Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mtngol3" id="mtngol3" onkeyup="sum_gol(3)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Janger Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jangergol3" id="jangergol3" onkeyup="sum_gol(3)" aria-describedby="waktu" placeholder="" required> 
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MMS Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mmsgol3" id="mmsgol3" onkeyup="sum_gol(3)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">BSD Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="bsdgol3" id="bsdgol3" onkeyup="sum_gol(3)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">CSJ Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="csjgol3" id="csjgol3" onkeyup="sum_gol(3)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">JKC Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jkcgol3" id="jkcgol3" onkeyup="sum_gol(3)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Total Gol 3 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="totalgol3" id="totalgol3" aria-describedby="waktu" placeholder="" readonly>
                                    </div>                               
                                </div>	
                            </div>
                            <div id="gol4" class="tab-pane fade">
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MTN Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mtngol4" id="mtngol4" onkeyup="sum_gol(4)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Janger Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jangergol4" id="jangergol4" onkeyup="sum_gol(4)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MMS Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mmsgol4" id="mmsgol4" onkeyup="sum_gol(4)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">BSD Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="bsdgol4" id="bsdgol4" onkeyup="sum_gol(4)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">CSJ Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="csjgol4" id="csjgol4" onkeyup="sum_gol(4)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">JKC Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jkcgol4" id="jkcgol4" onkeyup="sum_gol(4)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Total Gol 4 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="totalgol4" id="totalgol4" aria-describedby="waktu" placeholder="" readonly>
                                    </div>                               
                                </div>
                            </div>
                            <div id="gol5" class="tab-pane fade">
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MTN Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mtngol5" id="mtngol5" onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Janger Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jangergol5" id="jangergol5" onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">MMS Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="mmsgol5" id="mmsgol5" onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">BSD Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="bsdgol5" id="bsdgol5"  onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">CSJ Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="csjgol5" id="csjgol5" onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>	
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">JKC Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="jkcgol5" id="jkcgol5"  onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
                                    </div>                               
                                </div>
                                <div class="form-group">						
                                    <label class="col-sm-3" for="exampleInputEmail1">Total Gol 5 :</label>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" name="totalgol5" id="totalgol5" aria-describedby="waktu" placeholder="" readonly>
                                    </div>                               
                                </div>
                            </div>
                        </div>        
                    </div>  
                </div>             			
			</div>
			<div class="modal-footer" style="margin-top:30px;">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
            </div>


        </form>	
	</div>
</div>

    <script>
 var tabelDaftarTarif;
$( document ).ready(function() {
    
    tabelDaftarTarif = $('#tabelDaftarTarif').DataTable({
			"processing": true, 	 
			"serverSide": true,
			// "order": [],
			"oLanguage": {
				sZeroRecords: "<center>Data tidak ditemukan</center>",
				sLengthMenu: "Tampilkan _MENU_ data   ",
				sSearch: "Cari data:",
				sInfo: "Menampilkan: _START_ - _END_ dari total : _TOTAL_ data",
				sProcessing: '<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>',
				oPaginate: {
					sFirst: "Awal", "sPrevious": "Sebelumnya",
					sNext: "Selanjutnya", "sLast": "Akhir"
				},
			},
            "fnDrawCallback": function () {
				$('#loading-body').hide();
			},	
			"ajax": {
				"url": base_url+"main/ajax_list_daftartarifclose",
				"type": "POST",
				"data": function (data) {						
						data.gerbang = $('#gerbang').val();						
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                    iziToast.error({
                        title: 'Error',
                        message: 'Koneksi Database Bermasalah',
                    });
                }
			},"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            
            'columnDefs':  [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9], //first column / numbering column
                    "className": 'text-center text-nowrap',
					// "orderable": false, //set not orderable
				},
			],
            columns: [0,
                {data: 1},
                {"data": 2},
                {"data": 3},
                {"data": 4},
                {"data": 5},
                {"data": 6},
                {"data": 7},
                {"data": 8},
                {"data": 9},
                {"data": 10},
                {"data": 11},
                
                
            ]
            ,

	});
    
    $('.total1').on('change', function(){
        $('#nominal_pembayaran').val($(this).val())
    })

    $('#btnDaftarTarif').click(function(){ 		
		tabelDaftarTarif.ajax.reload(null,false);
	});

    $("#waktu").datetimepicker({
        format:'Y-m-d H:i:s',
        theme:'white'
    });

    $('#btnAddDaftarTarif').click(function(){ 	
        var option='';
        var gerbang=$("#gerbang").val();
        var url=base_url+'/main/showDasarTarifOption';

        $('#gerbangmodal').find('option').remove().end();
        $('#dasartarifmodal').find('option').remove().end();
        $("#form-tambah-edit-DaftarTarif").trigger('reset');

        $.ajax({
            url:url,
            async: false,
            method:"POST",
            data : {gerbang:gerbang},
            dataType :"JSON",
            success:function(response)
            {
                //console.log(response);
               
                $.each(response, function(i, item) {
                    
                    option+='<option value="'+response[i].id_dasar_tarif+'"  >'+response[i].dasar_tarif+'</option>'
                    //console.log(option);
                    //console.log(response[i].dasar_tarif);
                });       
            }

        });
        
       
      
        $("#gerbangmodal").val($("#gerbang").val());
        $("#id").val(0);
        var optionValue=$("#gerbang option:selected").val();
        var optionText=$("#gerbang option:selected").text();
        $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
        $('#dasartarifmodal').append(option);
        $("#DaftarTarif-modal-tittle").html('Tambah Tarif Closed');       
        $("#DaftarTarifModal").modal('show');
	});

    $('#refreshDaftarTarif').click(function(){ 		
        tabelDaftarTarif.ajax.reload(null,false);
	});

    $("#form-tambah-edit-DaftarTarif").submit(function(e){
        e.preventDefault()
        var url=base_url+'/main/addEditDaftarTarifClose';
		var formData = new FormData($("#form-tambah-edit-DaftarTarif")[0]);	
    
        $.ajax({
            url:url,
            method:"POST",
            data : formData,
            contentType:false,
            cache:false,
            processData:false,
            success:function(response)
            {
              
               $("#DaftarTarifModal").modal('hide');
                $("#form-tambah-edit-DaftarTarif").trigger('reset');
                tabelDaftarTarif.ajax.reload(null, false);
                iziToast.success({
                    title: 'OK',
                    message: 'DaftarTarif Berhasil disimpan !',
                });
            }

            //});

        });

    });

});

function sum_gol(id)
{
    switch(id)
    {
        case 1 :
            var mtn = $('#mtngol1').val() =='' ?  0 : $('#mtngol1').val();       
            var jm = $('#jangergol1').val() =='' ?  0 : $('#jangergol1').val(); 
            var mms = $('#mmsgol1').val() =='' ?  0 : $('#mmsgol1').val();
            var bsd = $('#bsdgol1').val() =='' ?  0 : $('#bsdgol1').val(); 
            var csj = $('#csjgol1').val() =='' ?  0 : $('#csjgol1').val();
            var jkc = $('#jkcgol1').val() =='' ?  0 : $('#jkcgol1').val(); 

            var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
            if (!isNaN(result)) {
                $('#totalgol1').val(result);
            }
        break;
        case 2 :
            var mtn = $('#mtngol2').val() =='' ?  0 : $('#mtngol2').val();       
            var jm = $('#jangergol2').val() =='' ?  0 : $('#jangergol2').val(); 
            var mms = $('#mmsgol2').val() =='' ?  0 : $('#mmsgol2').val();
            var bsd = $('#bsdgol2').val() =='' ?  0 : $('#bsdgol2').val(); 
            var csj = $('#csjgol2').val() =='' ?  0 : $('#csjgol2').val();
            var jkc = $('#jkcgol2').val() =='' ?  0 : $('#jkcgol2').val(); 

            var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
            if (!isNaN(result)) {
                $('#totalgol2').val(result);
            }
        break;
        case 3 :
            var mtn = $('#mtngol3').val() =='' ?  0 : $('#mtngol3').val();       
            var jm = $('#jangergol3').val() =='' ?  0 : $('#jangergol3').val(); 
            var mms = $('#mmsgol3').val() =='' ?  0 : $('#mmsgol3').val();
            var bsd = $('#bsdgol3').val() =='' ?  0 : $('#bsdgol3').val(); 
            var csj = $('#csjgol3').val() =='' ?  0 : $('#csjgol3').val();
            var jkc = $('#jkcgol3').val() =='' ?  0 : $('#jkcgol3').val(); 

            var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
            if (!isNaN(result)) {
                $('#totalgol3').val(result);
            }
        break;
        case 4 :
            var mtn = $('#mtngol4').val() =='' ?  0 : $('#mtngol4').val();       
            var jm = $('#jangergol4').val() =='' ?  0 : $('#jangergol4').val(); 
            var mms = $('#mmsgol4').val() =='' ?  0 : $('#mmsgol4').val();
            var bsd = $('#bsdgol4').val() =='' ?  0 : $('#bsdgol4').val(); 
            var csj = $('#csjgol4').val() =='' ?  0 : $('#csjgol4').val();
            var jkc = $('#jkcgol4').val() =='' ?  0 : $('#jkcgol4').val(); 

            var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
            if (!isNaN(result)) {
                $('#totalgol4').val(result);
            }
        break;
        case 5 :
            var mtn = $('#mtngol5').val() =='' ?  0 : $('#mtngol5').val();       
            var jm = $('#jangergol5').val() =='' ?  0 : $('#jangergol5').val(); 
            var mms = $('#mmsgol5').val() =='' ?  0 : $('#mmsgol5').val();
            var bsd = $('#bsdgol5').val() =='' ?  0 : $('#bsdgol5').val(); 
            var csj = $('#csjgol5').val() =='' ?  0 : $('#csjgol5').val();
            var jkc = $('#jkcgol5').val() =='' ?  0 : $('#jkcgol5').val(); 

            var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
            if (!isNaN(result)) {
                $('#totalgol5').val(result);
            }
        break;
    }
    
}

function btnEditDaftarTarifModal(id)
{    
    //alert(id);
    var url=base_url+'/main/showDaftarTarifClose'; 
    var gerbang=$("#gerbang option:selected").val();

    $.ajax({

        url:url,
        method:"POST",
        async: false,
        data : {id:id,gerbang:gerbang},
        dataType :"JSON",
        success:function(response)
        {
            $("#id").val(response[0].id);
            $('#dasartarifmodal').find('option').remove().end();
            $('#gerbangmodal').find('option').remove().end();
            //console.log(response[0].id_dasar_tarif);

            var option='';
            var gerbang=$("#gerbang").val();
            var url=base_url+'/main/showDasarTarifOption';
            $.ajax({
            url:url,
            async: false,
            method:"POST",
            data : {gerbang:gerbang},
            dataType :"JSON",
            success:function(data)
                {
                    //console.log(data);
                    //console.log(data[0].id_daftar_tarif_close);
                        $.each(data, function(i, item) {
                        
                            //console.log(data[i].id_dasar_tarif);
                            var selected='';
                            if(response[0].id_dasar_tarif==data[i].id_dasar_tarif)
                            {
                                selected="selected";
                            }

                            option+='<option value="'+data[i].id_dasar_tarif+'" '+selected+'>'+data[i].dasar_tarif+'</option>'
                          
                        });       
                }

            });
            
            $('#dasartarifmodal').append(option);
            var optionValue=$("#gerbang option:selected").val();
            var optionText=$("#gerbang option:selected").text();
            $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`); 
            $("#waktu").val(response[0].tgl_berlaku);      
            $("#mtngol1").val(JSON.parse(response[0].gol1_d)[0]);
            $("#jangergol1").val(JSON.parse(response[0].gol1_d)[1]);
            $("#mmsgol1").val(JSON.parse(response[0].gol1_d)[2]);
            $("#bsdgol1").val(JSON.parse(response[0].gol1_d)[3]);
            $("#csjgol1").val(JSON.parse(response[0].gol1_d)[4]);
            $("#jkcgol1").val(JSON.parse(response[0].gol1_d)[5]);

            $("#totalgol1").val(response[0].gol1)
    
            $("#mtngol2").val(JSON.parse(response[0].gol2_d)[0]);
            $("#jangergol2").val(JSON.parse(response[0].gol2_d)[1]);
            $("#mmsgol2").val(JSON.parse(response[0].gol2_d)[2]);
            $("#bsdgol2").val(JSON.parse(response[0].gol2_d)[3]);
            $("#csjgol2").val(JSON.parse(response[0].gol2_d)[4]);
            $("#jkcgol2").val(JSON.parse(response[0].gol2_d)[5]);
            $("#totalgol2").val(response[0].gol2)

            $("#mtngol3").val(JSON.parse(response[0].gol3_d)[0]);
            $("#jangergol3").val(JSON.parse(response[0].gol3_d)[1]);
            $("#mmsgol3").val(JSON.parse(response[0].gol3_d)[2]);
            $("#bsdgol3").val(JSON.parse(response[0].gol3_d)[3]);
            $("#csjgol3").val(JSON.parse(response[0].gol3_d)[4]);
            $("#jkcgol3").val(JSON.parse(response[0].gol3_d)[5]);
            $("#totalgol3").val(response[0].gol1)

            $("#mtngol4").val(JSON.parse(response[0].gol4_d)[0]);
            $("#jangergol4").val(JSON.parse(response[0].gol4_d)[1]);
            $("#mmsgol4").val(JSON.parse(response[0].gol4_d)[2]);
            $("#bsdgol4").val(JSON.parse(response[0].gol4_d)[3]);
            $("#csjgol4").val(JSON.parse(response[0].gol4_d)[4]);
            $("#jkcgol4").val(JSON.parse(response[0].gol4_d)[5]);
            $("#totalgol4").val(response[0].gol4)

            $("#mtngol5").val(JSON.parse(response[0].gol5_d)[0]);
            $("#jangergol5").val(JSON.parse(response[0].gol5_d)[1]);
            $("#mmsgol5").val(JSON.parse(response[0].gol5_d)[2]);
            $("#bsdgol5").val(JSON.parse(response[0].gol5_d)[3]);
            $("#csjgol5").val(JSON.parse(response[0].gol5_d)[4]);
            $("#jkcgol5").val(JSON.parse(response[0].gol5_d)[5]);
            $("#totalgol5").val(response[0].gol5)
        
            $("#DaftarTarif-modal-tittle").html('Edit Daftar Tarif');       
            $("#DaftarTarifModal").modal('show');
        }

    });		
}



function btnDeleteDaftarTarif(id)
{
    iziToast.question({
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Hey',
        message: 'Are you sure want to delete ID = '+id+'?',
        position: 'center',
        buttons: [
            ['<button><b>YES</b></button>', function (instance, toast) {
    
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                var url=base_url+'/main/deleteDaftarTarifClose'; 
                var gerbang=$("#gerbang option:selected").val();
                //console.log(gerbang);
                $.ajax({                   
                    url:url,
                    method:"POST",
                    data : {id:id,gerbang:gerbang},
                    dataType :"JSON",
                    success: function (data) { //jika sukses
                    //console.log(data);
                        tabelDaftarTarif.ajax.reload(null, false);
                        iziToast.success({
                            title: 'OK',
                            message: 'Data has been deleted !',
                        });
                    }
                });
                                                    
            }, true],
            ['<button>NO</button>', function (instance, toast) {			
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ]
    });
}

</script>