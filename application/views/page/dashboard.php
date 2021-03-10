<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<div class="panel panel-default panel-widget">
					<div class="panel-body">
						<h4>APLIKASI OPERASIONAL</h4>
						<div class="break-5">Aplikasi ini berfungsi untuk melakukan kegiatan Operasional Gerbang seperti pengelolaan Petugas, Pengelolaan Tarif, Pengelolaan Kartu Operasional, Dinas dan lain-lain</div>
					</div>
				</div>
			</div>	
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12">
					<div id="mapid" style="height: 600px;width: 100%;"></div>	
			</div>	
		</div>	
</div>

<script>
    var lokasi=<?php echo json_encode($GerbangLokasi) ?>; 

    //console.log(lokasi[0].latitude);
    var map = L.map('mapid').setView([-6.2272,106.7746], 12);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox/streets-v10',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYXNocnVsa2hhaXIiLCJhIjoiY2tnc3k0YjZhMDV6aTJzcGV4dDZkM3dvcSJ9.v-1MLW0o1FcvbjM92RhQUQ'
    }).addTo(map);

  
   $.each(lokasi, function(key, value) {
        var marker = L.marker([value.longitude,value.latitude]).addTo(map);
        marker.bindPopup("<b>"+value.nama_gerbang+"</b><br>"+value.provinsi+", "+value.kota+"");
    });


    

    

</script>