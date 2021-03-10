<div class="container-fluid">

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">                
                    <div class="pull-left" style="width:200px; margin-right:5px;">
                        <select class="form-control" id="kategori" name="kategori">
                            <option selected value="0">All Kategori</option>
                            <option  value="1">Petugas</option>
                            <option  value="2">Tarif</option>
                            <option  value="3">Kartu Dinas</option>
                            <option  value="4">Kartu PassPull</option>
                            <option  value="5">Blacklist</option>
                        </select>               
                    </div>
                    <!-- <div class="pull-left" style="width:200px">
                        <select class="form-control" id="gerbang" name="gerbang">
                            <option selected value="default">MIS</option>
                            <?php 
                                if(count($GerbangOption)> 0)
                                {
                                    foreach ($GerbangOption as $row) 
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
                    </div> -->
                    <btn id="btnLog" style="margin-left:10px; width:100px;"  class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <btn id="refreshLog" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
                        <!-- <btn id="btnAddLog" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></btn> -->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full" style="padding:10px;">
                    <table id="tabelLog" class="table table-stripped table-hover table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-center text-nowrap">NPP</th>
                                <th class="text-center text-nowrap">Nama</th>
                                <th class="text-center text-nowrap">Jabatan</th>
                                <th class="text-center text-nowrap">Gerbang</th>
                                <th class="text-center text-nowrap">Waktu</th>
                                <th class="text-center text-nowrap">Kategori</th>
                                <th class="text-center text-nowrap">Event</th>
                                <th class="text-center text-nowrap">Keterangan</th>
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
<div class="modal fade" id="LogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="Log-modal-tittle" class="modal-title">Tambah</h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-edit-Log" id="form-tambah-edit-Log">
                    <div class="form-group">						
						<label for="exampleInputEmail1">Gerbang :</label>
                        <select class="form-control" id="gerbangmodal" name="gerbangmodal" readonly="readonly"> 
                        </select>
					</div>
					<div class="form-group">						
						<input type="hidden" name="id" id="id"/>
						<label for="exampleInputEmail1">Versi :</label>
						<input type="text" class="form-control" name="versi" id="versi" aria-describedby="versi" placeholder="Versi Tarif">
					</div>
                    <div class="form-group">						
						<label for="exampleInputEmail1">Surat Keputusan :</label>
						<textarea type="text" class="form-control" name="sk" id="sk" placeholder="Surat Keputusan" rows="4"></textarea>
					</div>
                    <div class="form-group">						
						<label for="exampleInputEmail1">Waktu Berlaku :</label>
						<input type="text" class="form-control" name="waktu" id="waktu" aria-describedby="waktu" placeholder="Waktu Berlaku">
					</div>						
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</div>
			</form>
		</div>
	</div>

    <script>
 var tabelLog;
$( document ).ready(function() {
    
    tabelLog = $('#tabelLog').DataTable({
			"processing": true, 	 
			"serverSide": true,
			"order": [],
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
				"url": base_url+"main/ajax_list_Log",
				"type": "POST",
				"data": function (data) {						
						data.gerbang = 'default';	
                        data.kategori = $('#kategori').val();						
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                    iziToast.error({
                        title: 'Error',
                        message: 'Koneksi Database Bermasalah',
                    });
                }
			},
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8], //first column / numbering column
                    "className": 'text-center text-nowrap',
					"orderable": false, //set not orderable
				},
			],
            "lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],

	});

    $('#btnLog').click(function(){ 		
		tabelLog.ajax.reload(null,false);
	});

    $("#waktu").datetimepicker({
        format:'Y-m-d H:i:s',
        theme:'white'
    });

    $('#btnAddLog').click(function(){ 		
        $('#gerbangmodal').find('option').remove().end();
        $("#form-tambah-edit-Log").trigger('reset');
        $("#gerbangmodal").val($("#gerbang").val());
        $("#id").val(0);
        var optionValue=$("#gerbang option:selected").val();
        var optionText=$("#gerbang option:selected").text();
        $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
        $("#Log-modal-tittle").html('Tambah Log');       
        $("#LogModal").modal('show');
	});

    $('#refreshLog').click(function(){ 		
        tabelLog.ajax.reload(null,false);
	});

    $("#form-tambah-edit-Log").submit(function(e){
        e.preventDefault()
        var url=base_url+'/main/addEditLog';
		var formData = new FormData($("#form-tambah-edit-Log")[0]);	

        $.ajax({
            url:url,
            method:"POST",
            data : formData,
            contentType:false,
            cache:false,
            processData:false,
            success:function(response)
            {
               //console.log(response);
               $("#LogModal").modal('hide');
                $("#form-tambah-edit-Log").trigger('reset');
                tabelLog.ajax.reload(null, false);
                iziToast.success({
                    title: 'OK',
                    message: 'Log Berhasil disimpan !',
                });
            }

        });

    });

});

function btnEditLogModal(id)
{
    //alert(id);
    var url=base_url+'/main/showLog'; 
    var gerbang=$("#gerbang option:selected").val();

    $.ajax({

        url:url,
        method:"POST",
        data : {id:id,gerbang:gerbang},
        dataType :"JSON",
        success:function(response)
        {
            $('#gerbangmodal').find('option').remove().end();
            $("#id").val(response[0].id_dasar_tarif);
            //console.log(response[0].gerbang_id);
            var optionValue=$("#gerbang option:selected").val();
            var optionText=$("#gerbang option:selected").text();
            $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);            
            $("#versi").val(response[0].versi_tarif);
            $("#sk").val(response[0].dasar_tarif);
            $("#waktu").val(response[0].mulai_berlaku);
            $("#Log-modal-tittle").html('Edit Dasar Tarif');       
            $("#LogModal").modal('show');
        }

    });		
}

function btnDeleteLog(id)
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
                var url=base_url+'/main/deleteLog'; 
                var gerbang=$("#gerbang option:selected").val();
                //console.log(gerbang);
                $.ajax({                   
                    url:url,
                    method:"POST",
                    data : {id:id,gerbang:gerbang},
                    dataType :"JSON",
                    success: function (data) { //jika sukses
                    //console.log(data);
                        tabelLog.ajax.reload(null, false);
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