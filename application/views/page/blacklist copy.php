<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <div class="panel panel-default panel-widget">
                <div class="panel-body">
                <span class="panel-title  text-black"><i class="fa fa-fw fa-users"></i> Daftar Blacklist Gerbang</span>
                    
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
                    </div>
                    <btn id="btnblacklist" style="margin-left:10px; width:100px;"  class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <btn id="refreshblacklist" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
                        <btn id="btnAddblacklist" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></btn>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full" style="padding:10px;">
                    <table id="tabelBlacklist" class="table table-stripped table-hover table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-nowrap">No</th>
                                <th class="text-center text-nowrap">UUID</th>
                                <th class="text-center text-nowrap">Info</th>
                                <th class="text-center text-nowrap">Tick</th>
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
<div class="modal fade" id="blacklistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="blacklist-modal-tittle" class="modal-title">Tambah</h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-edit-blacklist" id="form-tambah-edit-blacklist">
                    <div class="form-group">						
						<label for="exampleInputEmail1">Gerbang :</label>
                        <select class="form-control" id="gerbangmodal" name="gerbangmodal" readonly="readonly"> 
                        </select>
					</div>
					<div class="form-group">						
						<input type="hidden" name="id" id="id"/>
						<label for="exampleInputEmail1">UUID :</label>
						<input type="text" class="form-control" name="uuid" id="uuid" aria-describedby="blacklist" placeholder="UUID">
					</div>
                    <div class="form-group">						
						<label for="exampleInputEmail1">Info :</label>
						<input type="text" class="form-control" name="info" id="info" aria-describedby="info" placeholder="Info Blacklist">
					</div>
                    <div class="form-group">						
						<label for="exampleInputEmail1">Tick :</label>
						<input type="text" class="form-control" name="tick" id="tick" aria-describedby="tick" placeholder="Tick Blacklist">
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
 var tabelBlacklist;
$( document ).ready(function() {
    
    tabelBlacklist = $('#tabelBlacklist').DataTable({
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
				"url": base_url+"main/ajax_list_blacklist",
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
					"targets": [0,1,2,3,4], //first column / numbering column
                    "className": 'text-center text-nowrap',
					"orderable": false, //set not orderable
				},
			],

	});

    $('#btnblacklist').click(function(){ 		
		tabelBlacklist.ajax.reload(null,false);
	});

    $('#btnAddblacklist').click(function(){ 		
        $('#gerbangmodal').find('option').remove().end();
        $("#form-tambah-edit-blacklist").trigger('reset');
        $("#gerbangmodal").val($("#gerbang").val());
        $("#id").val(0);
        var optionValue=$("#gerbang option:selected").val();
        var optionText=$("#gerbang option:selected").text();
        $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
        $("#blacklist-modal-tittle").html('Tambah blacklist');       
        $("#blacklistModal").modal('show');
	});

    $('#refreshblacklist').click(function(){ 		
        tabelBlacklist.ajax.reload(null,false);
	});

    $("#form-tambah-edit-blacklist").submit(function(e){
        e.preventDefault()
        var url=base_url+'/main/addEditBlacklist';
		var formData = new FormData($("#form-tambah-edit-blacklist")[0]);	

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
               $("#blacklistModal").modal('hide');
                $("#form-tambah-edit-blacklist").trigger('reset');
                tabelBlacklist.ajax.reload(null, false);
                iziToast.success({
                    title: 'OK',
                    message: 'blacklist Berhasil disimpan !',
                });
            }

        });

    });

});

function btnEditblacklistModal(id)
{
    //alert(id);
    var url=base_url+'/main/showBlacklist'; 
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
            $("#uuid").val(response[0].uuid);
            $("#tick").val(response[0].tick);
            $("#info").val(response[0].info);
            $("#blacklist-modal-tittle").html('Edit blacklist');       
            $("#blacklistModal").modal('show');
        }

    });		
}

function btnDeleteblacklist(id)
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
                var url=base_url+'/main/deleteBlacklist'; 
                var gerbang=$("#gerbang option:selected").val();
                //console.log(gerbang);
                $.ajax({                   
                    url:url,
                    method:"POST",
                    data : {id:id,gerbang:gerbang},
                    dataType :"JSON",
                    success: function (data) { //jika sukses
                    //console.log(data);
                        tabelBlacklist.ajax.reload(null, false);
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