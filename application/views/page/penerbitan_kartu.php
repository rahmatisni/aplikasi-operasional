<div class="container-fluid">

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">                
                    <div class="pull-left" style="width:250px">
                        <select class="form-control" id="gerbang" name="gerbang">
                            <option selected value="default">Default</option>
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
                    </div>
                    <btn id="btnPenerbitanKartu" style="margin-left:10px; width:100px;"  class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <btn id="refreshPenerbitanKartu" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
                        <btn id="btnAddPenerbitanKartu" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></btn>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full" style="padding:10px;">
                    <table id="tabelPenerbitanKartu" class="table table-stripped table-hover table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-center text-nowrap">Nama</th>
                                <th class="text-center text-nowrap">KTP ID</th>
                                <th class="text-center text-nowrap">No Registrasi</th>
                                <th class="text-center text-nowrap">Jenis</th>
                                <th class="text-center text-nowrap">Tgl Terbit</th>
                                <th class="text-center text-nowrap">Tgl Kadaluarsa</th>
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
<div class="modal fade" id="PenerbitanKartuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="PenerbitanKartu-modal-tittle" class="modal-title">Tambah jadwal</h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-edit-penerbitan-kartu" id="form-tambah-edit-penerbitan-kartu">
                    <div class="form-group">						
						<label for="exampleInputEmail1">Gerbang :</label>
                        <select class="form-control" id="gerbangmodal" name="gerbangmodal" readonly="readonly"> 
                                
    
                        </select>
					</div>
					<div class="form-group">						
						<input type="hidden" name="id" id="id"/>
						<label for="exampleInputEmail1">Nama :</label>
						<input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Nama Lengkap" required>
					</div>
                                
                    <div class="form-group">						
						<label for="exampleInputEmail1">Nomor Registrasi :</label>
						<input type="text" class="form-control" name="noregistrasi" id="noregistrasi" aria-describedby="noregistrasi" placeholder="No Registrasi" required>
					</div>				
					<div class="form-group">
						<label for="exampleFormControlSelect1">Jenis KTP :</label>
						<select class="form-control" name="jenis_ktp" id="jenis_ktp" required>                          
		                    <option value="1">KTP OPERASIONAL</option>	
                            <option value="2">KTP MITRA</option>
							<option value="3">KTP KARYAWAN</option>				
						</select>
					</div>
                    <div class="form-group">						
						<label for="exampleInputEmail1">Tanggal Terbit :</label>
						<input type="text" class="form-control tgl" name="tglterbit" id="tglterbit" aria-describedby="tglterbit" required>
					</div>
                    <div class="form-group">						
						<label for="exampleInputEmail1">Tanggal Kadaluarsa :</label>
						<input type="text" class="form-control tgl" name="tglkadaluarsa" id="tglkadaluarsa" aria-describedby="tglkadaluarsa" required>
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
var tabelPenerbitanKartu;
$( document ).ready(function() {

    $(".tgl").datetimepicker({
            format:'Y-m-d',
            timepicker:false,
            theme:'white'
        });
    
    tabelPenerbitanKartu = $('#tabelPenerbitanKartu').DataTable({
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
				"url": base_url+"main/ajax_list_penerbitan_kartu",
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
			},
			"columnDefs": [
				{
					"targets": [ 0,1,2,3,4,5,6,7], //first column / numbering column
                    "className": 'text-center text-nowrap',
					"orderable": false, //set not orderable
				},
			],

	});

    $('#btnPenerbitanKartu').click(function(){ 		
		tabelPenerbitanKartu.ajax.reload(null,false);
	});

    $('#btnAddPenerbitanKartu').click(function(){ 		
        $('#gerbangmodal').find('option').remove().end();
        $("#form-tambah-edit-PenerbitanKartu").trigger('reset');
        $("#id").val(0);
        $("#gerbangmodal").val($("#gerbang").val());
        var optionValue=$("#gerbang option:selected").val();
        var optionText=$("#gerbang option:selected").text();
        $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
        $("#PenerbitanKartu-modal-tittle").html('Tambah Kartu');       
        $("#PenerbitanKartuModal").modal('show');
	});

    $('#refreshPenerbitanKartu').click(function(){ 		
        tabelPenerbitanKartu.ajax.reload(null,false);
	});

    $("#form-tambah-edit-penerbitan-kartu").submit(function(e){
        e.preventDefault()
        var url=base_url+'/main/addEditPenerbitanKartu';
		var formData = new FormData($("#form-tambah-edit-penerbitan-kartu")[0]);	
      
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
               $("#PenerbitanKartuModal").modal('hide');
                $("#form-tambah-edit-penerbitan-kartu").trigger('reset');
                tabelPenerbitanKartu.ajax.reload(null, false);
                iziToast.success({
                    title: 'OK',
                    message: 'Kartu Berhasil disimpan !',
                });
            }

        });

    });

});

function btnEditPenerbitanKartuModal(id)
{
    //alert(id);
    var url=base_url+'/main/showPenerbitanKartu'; 
    var gerbang=$("#gerbang option:selected").val();

    $.ajax({

        url:url,
        method:"POST",
        data : {id:id,gerbang:gerbang},
        dataType :"JSON",
        success:function(response)
        {
            $('#gerbangmodal').find('option').remove().end();
            $("#id").val(response[0].id);
            //console.log(response[0].gerbang_id);
            var optionValue=$("#gerbang option:selected").val();
            var optionText=$("#gerbang option:selected").text();
            $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);            
            $("#nama").val(response[0].nama);           
            $("#noregistrasi").val(response[0].no_registrasi);
            $("#tglterbit").val(response[0].tgl_terbit);
            $("#jenis_ktp").val(response[0].ktp_jenis_id);
            $("#tglkadaluarsa").val(response[0].tgl_kadaluarsa);
            $("#PenerbitanKartu-modal-tittle").html('Edit Kartu');       
            $("#PenerbitanKartuModal").modal('show');
        }

    });		
}

function btnDeletePenerbitanKartu(id)
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
                var url=base_url+'/main/deletePenerbitanKartu'; 
                var gerbang=$("#gerbang option:selected").val();
                //console.log(gerbang);
                $.ajax({                   
                    url:url,
                    method:"POST",
                    data : {id:id,gerbang:gerbang},
                    dataType :"JSON",
                    success: function (data) { //jika sukses
                    //console.log(data);
                        tabelPenerbitanKartu.ajax.reload(null, false);
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