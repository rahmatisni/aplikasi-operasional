<div class="container-fluid">
 
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">      
                <div class="pull-left mid" style="width:120px;margin-top:5px;"> 
                    <h4>Pilih Gerbang :</h4>
                </div>                    
                    <div class="pull-left" style="width:200px">                       
                        <select class="form-control" id="gerbang" name="gerbang" onchange="getDataPetugasByChange()">
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
                      <div class="btn-group btn-group-sm pull-right" role="group">
                        <btn id="btnStatus" class="btn btn-default" href="#"><i class="fa fa-fw fa-plug"></i> <span class="hidden-sm">status</span></btn>
                        <btn id="btnRead" class="btn btn-default" href="#"><i class="fa fa-fw fa-eye"></i> <span class="hidden-sm">Read</span></btn>
                        <btn id="btnService" class="btn btn-default" href="#"><i class="fa fa-fw fa-download"></i> <span class="hidden-sm">Service</span></btn>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form id="form-tulis-kartu" name="form-tulis-kartu" method="POST">                
                                <div class="form-group">
                                    <label for="kode">Nama Lengkap :  </label>
                                    <select class="form-control" id="nama" name="nama" onchange="getDataKTPByChange()">     
                                        <option selected value="0">*Silahkan Pilih Petugas</option>  
                                    </select>         
                                </div>
                                <div class="form-group">
                                    <label for="noktp">UID Kartu:</label>
                                    <input type="text" class="form-control" id="uid" name="uid" placeholder="UID Kartu" readonly>             
                                </div>
                                <div class="form-group">
                                    <label for="noktp">Nomor KTP :</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No Registrasi" readonly>             
                                </div>
                                <div class="form-group">
                                    <label for="shift">Kode Ruas :</label>
                                    <select class="form-control" id="ruas" name="ruas" readonly>
                                        <option selected value="AA01">PT. Marga Trans Nusantara (MTN)</option>                                                                                 
                                    </select>   
                                </div>
                                
                                <div class="form-group">
                                    <label for="shift"> Tipe KTP :</label>
                                    <select class="form-control" id="tipe" name="tipe" readonly>
                                        <option selected value="0">Pilih Jenis KTP</option>
                                        <option value="3431">KTP OPERASIONAL</option>
                                        <option value="3432">KTP KARYAWAN</option>       
                                        <option value="3433">KTP MITRA</option>                                                   
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Masa Berlaku :</label>
                                    <input type="text" class="form-control" id="tgl" name="tgl" placeholder="Tanggal Berlaku" readonly>             
                                </div>
                        </div>
                    </div>
                    <div class="row" style="margin:20px 0px;">
                        <div class="col-xs-4">  
                        </div>
                        <div class="col-xs-2">   
                            <button id="btnTulis" type="submit" class="btn btn-block btn-primary">Tulis Kartu</button>
                        </div>
                        <div class="col-xs-2"> 
                            <button id="btnReset" type="button" class="btn btn-block btn-danger">Reset</button>
                        </div>
                        <div class="col-xs-4">  
                        </div>
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> last edited at 02/01/2016 18:00</span>
                </div>
                
            </div>
        </div>
       
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="kartuOperasionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="petugas-modal-tittle" class="modal-title">Tambah jadwal</h3>
			</div>
			<div class="modal-body">
				<form id="form-kartu-operasional">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Response :</label>
                        <textarea class="form-control" id="response" rows="8" readonly></textarea>
                    </div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
				
			</div>
			</div>
			
		</div>
	</div>
    <script>
    $( document ).ready(function() {
      
        $.ajax({
                url: base_url+'main/showNamaOption',
                method:"POST",
                dataType: 'json', 
                data : {gerbang : $('#gerbang').val()},       
                success:function(response)
                {                    
                   $.each(response, function (i, item) {
                        $('#nama').append($('<option>', { 
                            value: item.ktp_id+'|'+item.ktp_jenis_id+'|'+item.tgl_kadaluarsa+'|'+item.no_registrasi+'|'+item.ktp_id,
                            text : item.nama 
                        }));
                    });
                    $('#nama').select2({
                        theme: "bootstrap",
                        maximumSelectionSize: 6,                        
                    });
                    

                }
                
            });


        $("#tgl").datetimepicker({
            format:'d-m-Y',
            timepicker:false,
            theme:'white'
        });

        $("#btnStatus").click(function(){
            $("#petugas-modal-tittle").html('Status Reader');   
            $.ajax({
                url:"http://localhost:2929/status",
                method:"GET",
                beforeSend: function() { 
                    $.Toast.showToast({                       
                        "title":"Mohon Tunggu, Proses Sedang Berlangsung",                       
                        "icon":"loading",
                        "duration": 5000                      
                    });
                },
                success:function(response)
                {                    
                    $.Toast.hideToast();
                    $('#response').attr('rows', 4);
                    $("#response").val(JSON.stringify(response.data));  
                    $("#kartuOperasionalModal").modal('show');
                },
                error: function (error) {
                    $.Toast.hideToast();
                    $.Toast.showToast({                       
                        "title":"Terdapat Kesalahan, Reader Tidak Terhubung",                       
                        "icon":"error",                        
                        "duration": 5000                      
                    });
                }
            });              
           
        });

        $("#btnRead").click(function(){
            $("#petugas-modal-tittle").html('Info Kartu');   
            $.ajax({
                url:"http://127.0.0.1:2929/read/ktp",
                method:"GET",
                beforeSend: function() { 
                    $.Toast.showToast({                       
                        "title":"Mohon Tunggu, Proses Sedang Berlangsung",                       
                        "icon":"loading",
                        "duration": 5000                      
                    });
                },
                success:function(response)
                {   
                    $.Toast.hideToast();
                    var hasil="========== DATA KARTU =========="+"\n\n";
                    hasil +="No KTP : "+response.data.no_ktp+"\n";     
                    hasil +="Ruas : "+response.data.ruas+"\n";                   
                    hasil +="Tipe : "+response.data.tipe+"\n";      
                    hasil +="UID : "+response.data.signature+"\n";  
                    hasil +="Tgl Kadaluarsa : "+response.data.expired_date+"\n\n";                   
                    hasil +="=================================";
                    $('#response').attr('rows', 10);
                    $("#response").val(hasil);  

                 
                    $("#no_ktp").val(response.data.no_ktp);
                    $("#ruas").val(response.data.tipe);
                    $("#tipe").val(response.data.ruas);
                    $("#tgl").val(response.data.expired_date);                  

                    $("#kartuOperasionalModal").modal('show');
                },
                error: function (error) {
                    $.Toast.hideToast();
                    $.Toast.showToast({                       
                        "title":"Terdapat Kesalahan, Reader Tidak Terhubung",                       
                        "icon":"error",                        
                        "duration": 5000                      
                    });
                }
            }); 
        });

        $("#btnService").click(function(){         
            location.href = base_url+"assets/file/service.rar";           
        });

        $("#btnReset").click(function(){
            $('#form-tulis-kartu').trigger("reset");
           
        });

        $("#btnTulis").click(function(){
            var formData = new FormData($("#form-tulis-kartu")[0]);	

            var no_ktp   = $("#no_ktp").val();
            var ruas     = $("#ruas").val();
            var tipe     = $("#tipe").val();
            var tgl      = $("#tgl").val();
                    
            $.ajax({
                url:"http://127.0.0.1:2929/write/ktp",
                method:"POST",
                data : {              
                    no_ktp:no_ktp,
                    ruas:ruas,
                    tipe:tipe,
                    tgl:tgl
                },
                beforeSend: function() { 
                    $("#btnTulis").text('Loading ...');
                    $("#btnTulis").prop('disabled', true);
                    
                    $.Toast.showToast({                       
                        "title":"Mohon Tunggu, Proses Sedang Berlangsung",                       
                        "icon":"loading",
                        "duration": 5000                      
                    });
                },
                success:function(response)
                {                       
                    //console.log(response);
                    $('#form-tulis-kartu').trigger("reset");
                    $("#btnTulis").text('Tulis');
                    $("#btnTulis").prop('disabled', false);
                    $.Toast.hideToast();
                    iziToast.success({
                        title: 'OK',
                        position: 'bottomRight',
                        message: 'Proses Tulis Kartu Berhasil',
                    });
                },
                error: function (error) {
                    $.Toast.hideToast();
                    $.Toast.showToast({                       
                        "title":"Terdapat Kesalahan, Reader Tidak Terhubung",                       
                        "icon":"error",                        
                        "duration": 5000                      
                    });
                    $("#btnTulis").text('Tulis');
                    $("#btnTulis").prop('disabled', false);
                }
            }); 

        });



    });


    function getDataPetugasByChange()
    {
       
        $('#nama').find('option:not(:first)').remove();     
        $.ajax({
                url: base_url+'main/showNamaOption',
                method:"POST",
                dataType: 'json', 
                data : {gerbang : $('#gerbang').val()},
                beforeSend: function() { 
                    $('#nama').prop('disabled', true);
                },       
                success:function(response)
                {             
                   //console.log(response);                  
                   $.each(response, function (i, item) {
                        $('#nama').append($('<option>', { 
                            value: item.ktp_id+'|'+item.ktp_jenis_id+'|'+item.tgl_kadaluarsa+'|'+item.no_registrasi+'|'+item.ktp_id,
                            text : item.nama,
                        }));
                    });

                    $('#nama').prop('disabled', false);
                }
                
            });

    }

    function getDataKTPByChange()
    {
        //$('#tipe').val('3433');
        var res=$('#nama').val().split('|');
        id=res[1];
        tgl=res[2];
        registrasi=res[3];
        uid=res[4];
      
        $('#tgl').val(tgl);
        $('#no_ktp').val(registrasi);
        $('#uid').val(uid);
        switch(id)
        {
            case '1' :
                $('#tipe').val('3431');
                break;
            case '2' :
                $('#tipe').val('3432');
                break;
            case '3' :
                $('#tipe').val('3433');
                break;
            default :
                $('#tipe').val('0');
                break;
        }
       
    }


    </script>


