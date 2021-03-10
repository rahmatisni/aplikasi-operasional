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
                <div class="row">
                        <div class="col-xs-3">
                            <form id="form-tulis-kartu" name="form-tulis-kartu" method="POST">
                                <div class="form-group">
                                    <label for="kode">Pilih Gerbang :  </label>
                                    <select class="form-control" id="gerbang" name="gerbang" onchange="getDataPetugasByChange()">
                                        <option selected value="default">Silahkan Pilih</option>
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
                        </div>
                        <div class="col-xs-1">                                                          
                                <div class="form-group">
                                    <label for="tahun">Tahun :</label>
                                    <select class="form-control" id="tahun" name="tahun" onchange="getDataPetugasByChange()">
                                        <option selected value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>       
                                        <option value="2023">2023</option> 
                                        <option value="2024">2024</option>       
                                        <option value="2025">2025</option>                                                   
                                    </select>   
                                </div>                     
                        </div>
                        <div class="col-xs-1">                                                          
                                <div class="form-group">
                                    <label for="bulan">Bulan :</label>
                                    <select class="form-control" id="bulan" name="bulan" onchange="getDataPetugasByChange()">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>       
                                        <option value="3">3</option> 
                                        <option value="4">4</option>       
                                        <option value="5">5</option>  
                                        <option value="6">6</option>       
                                        <option value="7">7</option> 
                                        <option value="8">8</option>       
                                        <option value="9">9</option>   
                                        <option value="10">10</option>       
                                        <option value="11">11</option> 
                                        <option value="12">12</option>                         
                                    </select>   
                                </div>                           
                        </div>
                        <div class="col-xs-2">                                                          
                        <div class="form-group">
                                    <label for="jenis">Jenis Petugas :</label>
                                    <select class="form-control" id="jenis" name="jenis" onchange="getDataPetugasByChange()">
                                        <option selected value="3">PLT</option>
                                        <option value="2">KSPT</option>  
                                    </select>   
                                </div>                                        
                        </div>
                        <div class="col-xs-5">                                                          
                                <div class="form-group">
                                    <label for="">Nama Petugas:</label>
                                    <select class="form-control" id="nama" name="nama" >
                                        <option selected value="0">Silahkan Pilih Petugas</option>                                       
                                    </select>
                                </div>                                                        
                            </form>
                        </div>                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div style="padding:10px 30px;" id='calendar'></div>   
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
<div class="modal fade" id="draftRencanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="rencana-modal-tittle" class="modal-title">Tambah jadwal</h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-edit-rencana" id="form-tambah-edit-rencana">
                   
                    <div class="form-group">
                        <input type="hidden" name="mgerbang" id="mgerbang"/>
                        <input type="hidden" name="mjenis" id="mjenis"/>						
						<input type="hidden" name="id" id="id"/>
						<label for="exampleInputEmail1">NPP Petugas :</label>
						<input type="text" class="form-control"  name="mnpp" id="mnpp" aria-describedby="petugas" placeholder="Nama Petugas" readonly>
					</div>

                    <div class="form-group">						
					    <label for="exampleInputEmail1">Nama Petugas :</label>
						<input type="text" class="form-control"   name="mnama" id="mnama" aria-describedby="petugas" placeholder="Nama Petugas" readonly>
					</div>

                    <div class="form-group">				
					    <label for="exampleInputEmail1">Tanggal :</label>
						<input type="text" class="form-control"   name="mtgl" id="mtgl" aria-describedby="petugas" placeholder="Nama Petugas" readonly>
					</div>

                     <div class="form-group">						
						<label for="exampleInputEmail1">Shift :</label>
                        <select class="form-control" style="width:100%;" name="mshift" id="mshift">
                        <?php 
                                if(count($ShiftOption)> 0)
                                {
                                    foreach ($ShiftOption as $row) 
                                    {
                                        echo '<option value='.$row->id_shift.'>'.$row->nm_shift.'</option>';
                                    }
                                } 
                                else
                                {
                                    echo'<option value="999">Data Not Found</option>';  
                                }
                            ?>
                        </select>
					</div>
				
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnHapus" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
			</div>
			</form>
		</div>
	</div>
    <script>
    var calendar;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var url= base_url+'main/loadRencanaPetugas';
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',          
            eventSources: [   
                {
                    url: url,
                    method: 'POST',
                    extraParams: {
                        gerbang: $('#gerbang').val(),
                        tahun: $('#tahun').val(),
                        bulan: $('#bulan').val(),
                        jenis: $('#jenis').val(),
                        npp: $('#nama').val()
                    },
                    failure: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: 'green',   // a non-ajax option
                    textColor: 'white' // a non-ajax option
                }
            ],
            dateClick: function(info) {
                if(gerbang=='default')
                {
                    Swal.fire(
                        'Mohon Perhatian',
                        'Silahkan Pilih Gerbang',
                        'warning'
                    );
                }  
            }          
        });

        calendar.render();       
    });

    
    $( document ).ready(function() {
        
        $(".tgl").datepicker( {
            format: "mm-yyyy",
            startView: "months", 
            minViewMode: "months"
        });

        $('#nama').select2({
            theme: "bootstrap",
            maximumSelectionSize: 6,                        
        });

        $('#nama').on('change', function (){
            $('body').loading();
            var calendarEl = document.getElementById('calendar');
            var url= base_url+'main/loadRencanaPetugas';

            var gerbang = $('#gerbang').val();
            var tahun   = $('#tahun').val();
            var bulan   = $('#bulan').val();
            var jenis   = $('#jenis').val();
            var npp     = $('#nama').val();           
           
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',          
                eventSources: [   
                    {
                        url: url,
                        method: 'POST',
                        extraParams: {
                            gerbang: gerbang,
                            tahun: tahun,
                            bulan: bulan,
                            jenis: jenis,
                            npp: npp
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        },
                        color: 'green',   // a non-ajax option
                        textColor: 'white' // a non-ajax option
                    }
                ],
                dateClick: function(info) {
                    //alert('Clicked on: ' + info.dateStr); 
                    var data = $('#nama').select2('data');
                    var tgl  = info.dateStr;
                    var npp  = data[0].id;  
                    var nama = data[0].text;                 
                    var jenis = $('#jenis').val(); 
                    var gerbang = $('#gerbang').val(); 

                    $('#mnama').val(nama);
                    $('#mnpp').val(npp);
                    $('#mtgl').val(tgl);
                    $('#id').val('0');
                    $('#mjenis').val(jenis);
                    $('#mgerbang').val(gerbang);
                    $("#btnHapus").hide(); 
                    $('#draftRencanaModal').modal('show');
                },
                eventClick: function(info) {
                    var tgl=convert(info.event.start);
                    var shift=info.event.title;                    
                    var data = $('#nama').select2('data');                   
                    var npp  = data[0].id;  
                    var nama = data[0].text;                 
                    var jenis = $('#jenis').val(); 
                    var gerbang = $('#gerbang').val(); 
                    
                    $('#mnama').val(nama);
                    $('#mnpp').val(npp);
                    $('#mtgl').val(tgl);
                    $('#id').val(shift);
                    $('#mjenis').val(jenis);
                    $('#mshift').val(shift);
                    $('#mgerbang').val(gerbang);
                    $("#rencana-modal-tittle").html('Edit Petugas');    
                    $("#btnHapus").show().html('Hapus');         
                    $('#draftRencanaModal').modal('show');
                   
                }      
            });
            var d = new Date(tahun,bulan-1,01);
            calendar.render();   
            calendar.changeView('dayGridMonth', d );
            $('body').loading('stop');
        });

        
        $("#form-tambah-edit-rencana").submit(function(e){
            e.preventDefault();
            var url=base_url+'/main/addEditRencanaPetugas';
            var formData = new FormData($("#form-tambah-edit-rencana")[0]);	
        
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {

                    if (!$(".loader").hasClass("is-active")) {
                        $("#draftRencanaModal").modal('hide');
                        $(".loader").addClass("is-active");
                    }
                },
                success: function (response) {
                    console.log(response);          
                    Swal.fire(
                        'Berhasil',
                        'Petugas berhasil di jadwalkan',
                        'success'
                    );      
                    $(".loader").removeClass("is-active");
                    calendar.refetchEvents();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });

        });

        $( "#btnHapus" ).click(function() {
            
            //alert('hapus');
            var tgl=convert(info.event.start);
            var shift=info.event.title;                    
            var data = $('#nama').select2('data');                   
            var npp  = data[0].id;  
            var nama = data[0].text;                 
            var jenis = $('#jenis').val(); 
            var gerbang = $('#gerbang').val(); 

            var url=base_url+'/main/deleteRencanaPetugas';

            $.ajax({
                url: url,
                type: "POST",
                data: {tgl:tgl,shift:shift,npp:npp,gerbang:gerbang,jenis:jenis},
                processData: false,
                contentType: false,
                beforeSend: function() {

                    if (!$(".loader").hasClass("is-active")) {
                        $("#draftRencanaModal").modal('hide');
                        $(".loader").addClass("is-active");
                    }
                },
                success: function (response) {
                    console.log(response);          
                    Swal.fire(
                        'Berhasil',
                        'Petugas berhasil dihapus',
                        'success'
                    );      
                    $(".loader").removeClass("is-active");
                    calendar.refetchEvents();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });

        });

    });

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

    function getDataPetugasByChange()
    {
        var gerbang= $('#gerbang').val();
        var tahun = $('#tahun').val();
        var bulan= $('#bulan').val();
        var jenis = $('#jenis').val();

        if(gerbang=='default')
        {
            Swal.fire(
                'Mohon Perhatian',
                'Silahkan Pilih Gerbang',
                'warning'
            );
            return false;
        }

        //console.log(gerbang+' '+tahun+' '+bulan+' '+jenis);
        $('#nama').find('option:not(:first)').remove();     
        $.ajax({
                url: base_url+'main/showNamaPetugasRencana',
                method:"POST",
                dataType: 'json', 
                data : {gerbang : gerbang,tahun:tahun,bulan:bulan,jenis:jenis},
                beforeSend: function() { 
                    $('#nama').prop('disabled', true);
                    $('body').loading();
                },       
                success:function(response)
                {                 
                    $('body').loading('stop');        
                    //console.log(response);                  
                    $.each(response, function (i, item) {
                        $('#nama').append($('<option>', { 
                            value: item.npp,
                            text : item.nama+' ['+item.npp+']',
                        }));
                    });

                    $('#nama').prop('disabled', false);
                }
                
        });
    }

    function convert(str) {
        var date = new Date(str),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);
        return [date.getFullYear(), mnth, day].join("-");
    }

    </script>


