<div class="container-fluid">

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">   
                            
                    <div class="pull-left" style="width:250px">
                        <select class="form-control" id="gerbang" name="gerbang" readonly>
                            <option selected value="default">KANTOR OPERASIONAL</option>                            
                        </select>               
                    </div>
                    <div class="pull-left" style="width:200px; margin-left:5px;">
                        <select class="form-control" id="jabatan" name="jabatan">
                            <option selected value="0">ALL</option> 
                            <option value="1">KBT</option>  
                            <option value="2">KSPT</option> 
                            <option value="3">PLT</option>    
                            <option value="4">MA</option>               
                                     
                        </select>               
                    </div> 
                    <btn id="btnPetugas" style="margin-left:10px; width:100px;"  class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <btn id="refreshPetugas" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
                        <btn id="syncPetugas" class="btn btn-default" href="#"><i class="fa fa-fw fa-check-square-o"></i> <span class="hidden-sm">sync data</span></btn>
                        <btn id="btnAddPetugas" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></btn>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full" style="padding:10px;">
                    <table id="tabelPetugas" class="table table-stripped table-hover table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:5%" class="text-center text-nowrap">No</th>
                                <th style="width:10%" class="text-center text-nowrap">NPP Petugas</th>
                                <th style="width:15%" class="text-center text-nowrap">Nama Petugas</th>
                                <th style="width:10%" class="text-center text-nowrap">Gerbang</th>
                                <th style="width:10%" class="text-center text-nowrap">Jabatan</th>
                                <th style="width:10%" class="text-center text-nowrap">Kode Tugas</th>
                                <th style="width:30%" class="text-center text-nowrap">Penempatan</th>
                                <th style="width:10%" class="text-center text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                   
                </div>
                <div class="panel-footer">
                    <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> Made by IoT Lab 2020</span>
                </div>
                
            </div>
        </div>
       
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="petugasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="loader loader-clock"></div>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="petugas-modal-tittle" class="modal-title">Tambah jadwal</h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-edit-petugas" id="form-tambah-edit-petugas">
                    <div class="form-group">						
						<label for="exampleInputEmail1">Gerbang :</label>
                        <select class="form-control" id="gerbangmodal" name="gerbangmodal" readonly="readonly"></select>
					</div>
                     <div class="form-group">						
						<label for="exampleInputEmail1">Gerbang Penempatan :</label>
                        <input style="margin-left:340px;" type="checkbox" id="checkbox" > Select All
                        <select class="form-control gerbang_penempatan" style="width:100%;" name="penempatan[]" multiple>
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
   
					<div class="form-group">						
						<input type="hidden" name="id" id="id"/>
						<label for="exampleInputEmail1">Nama Petugas (Max 15 Karakter):</label>
						<input type="text" class="form-control" maxlength="15"  name="petugas" id="petugas" aria-describedby="petugas" placeholder="Nama Petugas" required>
					</div>
                    <div class="nppdiv form-group">						
						<label for="exampleInputEmail1">NPP :</label>
						<input type="number" class="form-control" name="npp" id="npp" aria-describedby="npp" placeholder="NPP" required>
                       
					</div>					
					<div class="form-group">
						<label for="exampleFormControlSelect1">Jabatan :</label>
						<select class="form-control" name="jabatanModal" id="jabatanModal" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="4">Teknisi</option>
							<option value="0">MA</option>
							<option value="1">KBT</option>	
                            <option value="2">KSPT</option>
							<option value="3">PLT</option>				
						</select>
					</div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Inisial Petugas (Max 15 Karakter) :</label>
						<input type="text" class="form-control" name="kode_tugas"  maxlength="3"  id="kode_tugas" aria-describedby="kode_tugas" placeholder="Kode Tugas" required>
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
var tabelPetugas;
$( document ).ready(function() {

   
    $('.gerbang_penempatan').select2({
                    theme: "bootstrap",
                    maximumSelectionSize: 3,
                    placeholder: "Pilih",
                    containerCssClass: ':all:'                        
    });
    
    $("#checkbox").click(function(){
        if($("#checkbox").is(':checked') ){
            $(".gerbang_penempatan > option").prop("selected","selected");
            $(".gerbang_penempatan").trigger("change");

        }else{
            $(".gerbang_penempatan > option").prop("selected",false);
            $(".gerbang_penempatan").trigger("change");            
        }
    });

   

    tabelPetugas = $('#tabelPetugas').DataTable({
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
				"url": base_url+"main/ajax_list_petugas",
				"type": "POST",
				"data": function (data) {						
						data.gerbang = $('#gerbang').val();	
                        data.jabatan = $('#jabatan').val();									
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                    Swal.fire(
                        'Database Tidak Terkoneksi!',
                        'Mohon Periksa Kembali Koneksi Gerbang',
                        'error'
                    );
                }
			},
			"columnDefs": [
				{
					"targets": [ 0,1,2,3,4,5,6,7], //first column / numbering column
                    "className": 'text-center text-nowrap',
					"orderable": false, //set not orderable
				},
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],

	});

    $('#btnPetugas').click(function(){ 		
		tabelPetugas.ajax.reload(null,false);
	});

    $('#btnAddPetugas').click(function(){ 		
        $(".nppdiv").removeClass("has-error");
        $(".help-block").remove();
        $(".gerbang_penempatan").val(null).trigger("change"); 		
        $('#gerbangmodal').find('option').remove().end();
        $("#form-tambah-edit-petugas").trigger('reset');
        $("#id").val(0);
        $("#gerbangmodal").val($("#gerbang").val());
        var optionValue='default';
        var optionText='KANTOR OPERASIONAL';
        $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
        $("#petugas-modal-tittle").html('Tambah Petugas');       
        $("#petugasModal").modal('show');


        $('.gerbang_penempatan').change(function(){
    
           
            if($(".gerbang_penempatan").val() === "")
            {
                console.log($(".gerbang_penempatan").val());
            }
            
            
        });

	});

    $('#refreshPetugas').click(function(){ 		
        tabelPetugas.ajax.reload(null,false);
	});

    $('#syncPetugas').click(function(){ 		
       
        Swal.fire({
            title: 'Sinkronisasi Petugas ?',
            text: "Data Petugas akan di-Sinkronisasi pada seluruh gerbang.",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                //alert('ok');
                var url=base_url+'/main/syncPetugas';     
                var gerbang =<?php echo json_encode($GerbangOption); ?>;           
                $.ajax({                   
                    url:url,
                    method:"POST",
                    data : {gerbang:gerbang},
                    dataType :"JSON",
                    beforeSend: function() {
                        $('body').loading();
                        $("#petugasModal").modal('hide');
                        
                    },
                    success: function (data) { //jika sukses
                        //console.log(data);
                        $('body').loading('stop');
                        tabelPetugas.ajax.reload(null, false);
                        Swal.fire(
                        'Sinkronisasi Berhasil!',
                        'Seluruh Petugas Telah di tempatkan.',
                        'success'
                        );
                    }
                });                       
            
            }
        });

	});

    $("#form-tambah-edit-petugas").submit(function(e){
        e.preventDefault()  
        var npp=$('#npp').val();    
        var id=$('#id').val();    
        var urls=base_url+'/main/petugasExist';       
        var url=base_url+'/main/addEditPetugas';
		var formData = new FormData($("#form-tambah-edit-petugas")[0]);	

        $.ajax({
            url: urls,
            type: "POST",
            data: {npp:npp},
            beforeSend: function() {

                if (!$(".loader").hasClass("is-active")) {
                    $("#petugasModal").modal('hide');
                    $(".loader").addClass("is-active");
                }
            },
            success: function (response) {

                if(id==0)
                {
                    if(response>0){
                        if (!$(".nppdiv").hasClass("has-error")) {
                            $(".nppdiv").addClass("has-error").append('<span class="help-block">NPP Petugas Sudah ada di database, Silahkan Masukkan NPP yang lain.</span>');
                        }
                    }
                    else
                    {
                        $.ajax({
                            url:url,
                            method:"POST",
                            data : formData,
                            contentType:false,
                            cache:false,
                            processData:false,                        
                            success:function(response)
                            {
                                //console.log() 
                                $(".loader").removeClass("is-active");                                                           
                                $("#form-tambah-edit-petugas").trigger('reset');
                                tabelPetugas.ajax.reload(null, false);
                                Swal.fire(
                                    'Berhasil!',
                                    'Petugas Berhasil ditambahkan',
                                    'success'
                                );
                            }

                        });            
                    }
                }else
                {
                    $.ajax({
                            url:url,
                            method:"POST",
                            data : formData,
                            contentType:false,
                            cache:false,
                            processData:false,                        
                            success:function(response)
                            {
                                //console.log()
                                $(".loader").removeClass("is-active");                              
                                $("#form-tambah-edit-petugas").trigger('reset');
                                tabelPetugas.ajax.reload(null, false);
                                Swal.fire(
                                    'Berhasil!',
                                    'Petugas Berhasil di update',
                                    'success'
                                );
                            }

                        });
                }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }

        });
     
    });
    
});

function btnEditPetugasModal(id)
{
    //alert(id);
    var url=base_url+'/main/showPetugas'; 
    var gerbang=$("#gerbang option:selected").val();

    $.ajax({

        url:url,
        method:"POST",
        data : {id:id,gerbang:gerbang},
        dataType :"JSON",
        success:function(response)
        {
            $('#gerbangmodal').find('option').remove().end();
            $("#id").val(response[0].npp_no);
            //console.log(response);
            var optionValue=$("#gerbang option:selected").val();
            var optionText=$("#gerbang option:selected").text();           
            $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);                
           
            var penempatan;
           if(response[0].penempatan_gerbang===null)
           {
                penempatan='';
           }else
           {
             penempatan = response[0].penempatan_gerbang.split(',');
           }
            
           // console.log(penempatan);
            $(".gerbang_penempatan").val(penempatan).trigger("change"); 
            $("#petugas").val(response[0].nama_pegawai);
            $("#npp").val(response[0].npp_no);
            $("#npp").attr('readonly', true);
            $("#jabatanModal").val(response[0].jabatan_id);
            $("#kode_tugas").val(response[0].kode_tugas);
            $("#petugas-modal-tittle").html('Edit Petugas');       
            $("#petugasModal").modal('show');
        }

    });		
}

function btnDeletePetugas(id)
{
    Swal.fire({
        title: 'Delete Petugas ?',
		text: "Petugas akan dihapus di seluruh gerbang penempatan.",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
	}).then((result) => {
		if (result.value) {
			//alert('ok');
            var url=base_url+'/main/deletePetugas'; 
            var gerbang=$("#gerbang option:selected").val();
             $.ajax({                   
                url:url,
                method:"POST",
                data : {id:id,gerbang:gerbang},
                dataType :"JSON",
                success: function (data) { //jika sukses
                    console.log(data);
                    tabelPetugas.ajax.reload(null, false);
                    Swal.fire(
                    'Deleted!',
                    'Petugas telah di delete.',
                    'success'
                    );
                }
            });                       
           
		}
    });
}

</script>