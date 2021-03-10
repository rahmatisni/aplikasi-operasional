<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-default panel-widget">
                <div class="panel-body">
                <span class="panel-title  text-black"><i class="fa fa-fw fa-users"></i> Kartu Operasional</span>
                    
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">                
                <div class="pull-left mid" style="width:120px;margin-top:5px;"> 
                    <h4>Pilih Gerbang :</h4>
                </div>                    
                    <div class="pull-left" style="width:250px">                       
                        <select class="form-control" id="gerbang" name="gerbang" onchange="getDataPetugasByChange()">
                            <option selected value="default">Pilih Gerbang</option>
                            <option  value="41">SERPONG 5</option>
                            <option  value="42">SERPONG 7</option>
                            <option  value="43">SERPONG 4</option>
                            <option  value="44">SERPONG 6</option>
                            <option  value="45">PAMULANG</option>
                            <?php 
                                // if(count($GerbangOption)> 0)
                                // {
                                //     foreach ($GerbangOption as $row) 
                                //     {
                                //         echo '<option value='.$row->gerbang_id.'>'.ucfirst($row->gerbang_nama).' - '.$row->gerbang_id.'</option>';
                                //     }
                                // } 
                                // else
                                // {
                                //     echo'<option value="0">Data Not Found</option>';  
                                // }
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
                        <div class="col-xs-4">
                            <form id="form-tulis-kartu" name="form-tulis-kartu" method="POST">
                                <div class="form-group">
                                    <label for="kode">Kartu Operasional :  </label>
                                    <select class="form-control" id="kode" name="kode">
                                        <option value="2">PLT</option>
                                        <option selected value="1">KSPT</option>       
                                        <option value="3">Teknisi</option>                   
                                    </select>            
                                </div>
                                <div class="form-group">
                                    <label for="shift">Shift :</label>
                                    <select class="form-control" id="shift" name="shift">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>       
                                        <option value="3">3</option>                                                   
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Laporan :</label>
                                    <input type="text" class="form-control tgl" id="tgl_laporan" name="tgl_laporan" placeholder="Tanggal Laporan">             
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Kadaluarsa :</label>
                                    <input type="text" class="form-control tgl" id="tgl_kadaluarsa" name="tgl_kadaluarsa" placeholder="Tanggal Kadaluarsa">             
                                </div>
                                
                        </div>
                        <div class="col-xs-4">                                                          
                                <div class="form-group">
                                    <label for="">Nama KSPT :</label>                                  
                                    <select class="form-control" id="nama_kspt" name="nama_kspt" onchange="getDataKSPTByChange()">     
                                        <option selected value="0">*Silahkan Pilih Petugas</option>  
                                    </select>                
                                </div>
                                <div class="form-group">
                                    <label for="">NPP KSPT :</label>
                                    <input type="text" pattern="\d*" maxlength="6" class="form-control" id="npp_kspt" nama="npp_kspt"  placeholder="NPP Petugas KSPT Maksimal 6 Karakter" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Personil :</label>
                                    <select class="form-control" id="nama_plt" name="nama_plt" onchange="getDataPLTByChange()">     
                                        <option selected value="0">*Silahkan Pilih Petugas</option>  
                                    </select>                             
                                </div>
                                <div class="form-group">
                                    <label for="">NPP Personil :</label>
                                    <input type="text" pattern="\d*" maxlength="6" class="form-control" id="npp_plt" nama="npp_plt"  placeholder="NPP Petugas PLT Maksimal 6 Karakter" readonly>
                                </div>                               
                        </div>
                        <div class="col-xs-4">                                                          
                                <div class="form-group">
                                    <label for="">Penempatan Gardu 1 :</label>
                                    <input type="text" pattern="\d*" maxlength="3" value="0" class="form-control" id="gardu1" nama="gardu1" >
                                </div>
                                <div class="form-group">
                                    <label for="">Penempatan Gardu 2 :</label>
                                    <input type="text" pattern="\d*" maxlength="3" value="0" class="form-control" id="gardu2" nama="gardu2" >
                                </div>
                                <div class="form-group">
                                    <label for="">Penempatan Gardu 3 :</label>
                                    <input type="text" pattern="\d*" maxlength="3" value="0" class="form-control" id="gardu3" nama="gardu3" >
                                </div>
                                <div class="form-group">
                                    <label for="">Penempatan Gardu 4 :</label>
                                    <input type="text" pattern="\d*" maxlength="3" value="0" class="form-control" id="gardu4" nama="gardu4" >
                                </div>                                
                            </form>
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
                    <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-copyright"></i> Made by IoT Lab Jasamarga 2020</span>
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
            url: base_url+'main/showKSPTOption',
            method:"POST",
            dataType: 'json', 
            data : {gerbang : $('#gerbang').val()},       
            success:function(response)
            {                    
                $.each(response, function (i, item) {
                    $('#nama_kspt').append($('<option>', { 
                        value: item.npp_no+'|'+item.gerbang_id,
                        text : item.nama_pegawai
                    }));
                });
               
                $('#nama_kspt').select2({
                    theme: "bootstrap",
                    maximumSelectionSize: 6,                        
                });
                

            }
            
        });

        $.ajax({
            url: base_url+'main/showPLTOption',
            method:"POST",
            dataType: 'json', 
            data : {gerbang : $('#gerbang').val()},       
            success:function(response)
            {                    
                $.each(response, function (i, item) {
                    $('#nama_plt').append($('<option>', { 
                        value: item.npp_no+'|'+item.gerbang_id,
                        text : item.nama_pegawai
                    }));
                });
              
                $('#nama_plt').select2({
                    theme: "bootstrap",
                    maximumSelectionSize: 6,                        
                });
                

            }
            
        });


        $(".tgl").datetimepicker({
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
                url:"http://127.0.0.1:2929/read/operasional",
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
                    // var gerbang;
                    // if(response.data.no_gerbang=='4')
                    // {
                    //     gerbang='default';
                    // }
                    // else
                    // {
                    //     gerbang='0'+response.data.no_gerbang;
                    // }
                    // $("#gerbang").val(gerbang);
                    // console.log(gerbang);                 
                    // var npp_kspt_val=response.data.npp_kspt+'|0'+response.data.no_gerbang;
                    // var npp_plt_val=response.data.npp_plt+'|0'+response.data.no_gerbang;   
                    // $.ajax({
                    //     url: base_url+'main/showKSPTOption',
                    //     method:"POST",
                    //     dataType: 'json', 
                    //     data : {gerbang : gerbang},       
                    //     success:function(response)
                    //     {               
                    //         $("#nama_kspt").empty().trigger("change");     
                    //         $.each(response, function (i, item) {
                    //             $('#nama_kspt').append($('<option>', { 
                    //                 value: item.npp_no+'|'+item.gerbang_id,
                    //                 text : item.nama_pegawai
                    //             }));
                    //         });
                    //         $('#nama_kspt').select2({
                    //             theme: "bootstrap",
                                                    
                    //         });

                           
                            
                    //     }
                        
                    // });

                    // $('#nama_kspt').val(npp_kspt_val).trigger('change');
                    // console.log(npp_kspt_val);   

                    // $.ajax({
                    //     url: base_url+'main/showPLTOption',
                    //     method:"POST",
                    //     dataType: 'json', 
                    //     data : {gerbang : $('#gerbang').val()},       
                    //     success:function(response)
                    //     {              
                    //         $("#nama_plt").empty().trigger("change");      
                    //         $.each(response, function (i, item) {
                    //             $('#nama_plt').append($('<option>', { 
                    //                 value: item.npp_no+'|'+item.gerbang_id,
                    //                 text : item.nama_pegawai
                    //             }));
                    //         });

                    //         $('#nama_plt').select2({
                    //             theme: "bootstrap",
                    //             maximumSelectionSize: 6,                        
                    //         });
                            
                                          
                          
                            
                    //     }
                        
                    // });

                    //  $('#nama_plt').val(npp_plt_val).trigger('change');  
                    //  console.log(npp_plt_val);
                  
                                 
                    // $("#npp_kspt").val(response.data.npp_kspt);                   
                    // $("#npp_plt").val(response.data.npp_plt);
                    
                    // $("#shift").val(response.data.shift);
                    // $("#kode").val(response.data.kode_katu_ops);
                    // // $("#gardu1").val(response.data.no_gardu1);
                    // // $("#gardu2").val(response.data.no_gardu2);
                    // // $("#gardu3").val(response.data.no_gardu3);
                    // // $("#gardu4").val(response.data.no_gardu4);
                    // $("#tgl_laporan").val(formatDate(response.data.tanggal_laporan));
                    // console.log(response.data.tanggal_kadaluarsa);
                    // $("#tgl_kadaluarsa").val(formatDate(response.data.tanggal_kadaluarsa));
                    // //console.log($("#nama_plt option:selected").val());
                  

                    $.Toast.hideToast();
                    var hasil="========== DATA KARTU =========="+"\n\n";
                    hasil +="Kode Operasional : "+jabatanName(response.data.kode_katu_ops)+"\n";     
                    hasil +="Tanggal Laporan : "+response.data.tanggal_laporan+"\n";   
                    hasil +="Tanggal Kadaluarsa : "+response.data.tanggal_kadaluarsa+"\n";                 
                    hasil +="Nama KSPT : "+response.data.nama_kspt+"\n";      
                    hasil +="NPP KSPT : "+response.data.npp_kspt+"\n";  
                    hasil +="Nama Personil : "+response.data.nama_plt+"\n";
                    hasil +="NPP Personil : "+response.data.npp_plt+"\n";
                    hasil +="Gerbang : "+response.data.no_gerbang+"\n";   
                    hasil +="Shift : "+response.data.shift+"\n";
                    hasil +="Gardu 1 : "+response.data.no_gardu1+"\n";
                    hasil +="Gardu 2 : "+response.data.no_gardu2+"\n";
                    hasil +="Gardu 3 : "+response.data.no_gardu3+"\n";
                    hasil +="Gardu 4 : "+response.data.no_gardu4+"\n\n";
                    hasil +="=================================";
                    $('#response').attr('rows', 17);
                    $("#response").val(hasil);  
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
            location.href = base_url+"assets/file/service.zip";           
        });

        $("#btnReset").click(function(){
            $('#form-tulis-kartu').trigger("reset");
            $('#gerbang').val("default");
            // $("#nama_kspt").empty().trigger("change");          
            // $("#nama_plt").empty().trigger("change");          
            // $('#nama_kspt').append($("<option></option>").attr("value", 0).text('*Silahkan Pilih Petugas')); 
            // $('#nama_plt').append($("<option></option>").attr("value", 0).text('*Silahkan Pilih Petugas')); 
         
           

        });

        $("#btnTulis").click(function(){
          
            var formData = new FormData($("#form-tulis-kartu")[0]);	
            var kspt = $("#nama_kspt").select2('data');
            var plt = $("#nama_plt").select2('data');  
            var nama_kspt   = kspt[0].text;    
            var npp_kspt    = $("#npp_kspt").val();
            var nama_plt    = plt[0].text;
            //return false;
            var npp_plt     = $("#npp_plt").val();
            var no_gerbang  = $("#gerbang").val() == 'default' ? 4 : $("#gerbang").val();
            var no_shift    = $("#shift").val();
            var tgl_laporan     = $("#tgl_laporan").val();
            var tgl_kadaluarsa  = $("#tgl_kadaluarsa").val();
            var kode_kartu  = $("#kode").val();
            var gardu1      = $("#gardu1").val();
            var gardu2      = $("#gardu2").val();
            var gardu3      = $("#gardu3").val();
            var gardu4      = $("#gardu4").val();
            var gardu4      = $("#gardu4").val();
                    
            // Display the key/value pairs
            // for (var pair of formData.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]); 
            // }

            $.ajax({
                url:"http://127.0.0.1:2929/write/operasional",
                method:"POST",
                data : {
                    nama_kspt:nama_kspt,
                    no_kspt:npp_kspt,
                    nama_plt:nama_plt,                
                    no_plt:npp_plt,
                    no_gerbang:no_gerbang,
                    no_shift:no_shift,
                    kode_kartu:kode_kartu,
                    gardu1:gardu1,
                    gardu2:gardu2,
                    gardu3:gardu3,
                    gardu4:gardu4,
                    tgl_laporan : tgl_laporan,
                    tgl_kadaluarsa : tgl_kadaluarsa
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
                    //$('#form-tulis-kartu').trigger("reset");
                    $("#btnTulis").text('Tulis');
                    $("#btnTulis").prop('disabled', false);
                    $.Toast.hideToast();
                    Swal.fire(
                        'Berhasil!',
                        'Kartu Operasional Telah Ditulis',
                        'success'
                        );
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
        
        $('#nama_kspt').find('option:not(:first)').remove();  
        $('#nama_plt').find('option:not(:first)').remove();    
      
        $.ajax({
                url: base_url+'main/showKSPTOption',
                method:"POST",
                dataType: 'json', 
                data : {gerbang : 'default'},
                beforeSend: function() { 
                    $('#nama_kspt').prop('disabled', true);
                },       
                success:function(response)
                {             
                   //console.log(response);                  
                   $.each(response, function (i, item) {
                        $('#nama_kspt').append($('<option>', { 
                            value: item.npp_no+'|'+item.gerbang_id,
                            text : item.nama_pegawai
                        }));
                    });
                   
                    $('#nama_kspt').prop('disabled', false);
                }
                
            });

        $.ajax({
            url: base_url+'main/showPLTOption',
            method:"POST",
            dataType: 'json', 
            data : {gerbang : 'default'},
            beforeSend: function() { 
                $('#nama_plt').prop('disabled', true);
            },       
            success:function(response)
            {             
                //console.log(response);                  
                $.each(response, function (i, item) {
                    $('#nama_plt').append($('<option>', { 
                        value: item.npp_no+'|'+item.gerbang_id,
                        text : item.nama_pegawai
                    }));
                });
              
                $('#nama_plt').prop('disabled', false);
            }
            
        });

    }

    function getDataKSPTByChange()
    {
        
        var res=$('#nama_kspt').val().split('|');
        npp=res[0];
            
        $('#npp_kspt').val(npp);
           
    }

    function getDataPLTByChange()
    {
      
            var res=$('#nama_plt').val().split('|');
            npp=res[0];
            
            $('#npp_plt').val(npp);
            
    }
    
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [day,month,year].join('-');
    }

    function jabatanName(id)
    {
        switch(id)
        {
            case 1:
                return 'KSPT';
            break;
            case 2:
                return 'PLT';
            break;
            case 3:
                return 'TEKNISI';
            break;
            default :
                return 'UNKNOWN';
            break;
        }
    }

    </script>


