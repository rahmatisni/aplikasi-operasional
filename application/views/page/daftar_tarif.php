<style>
	.filter-white {
		filter: brightness(0) invert(1);
	}

	.btn no-bold {
		font-weight: 0px;
	}
</style>

<?php
// var_dump($GerbangOption);

if (isset($_POST['myinput2'])) {
	$input2 = $_POST['myinput2'];
	// echo ($input2);
	// echo ("//");

	$gerbanglistoption = array();
	foreach ($GerbangOption as $row) {
		if ($row->gerbang_id == $input2) {
			// echo($row->gerbang_id ."||". $row->gerbang_nama."||".$row->jenis_gerbang);
			$gerbang_nama = $row->gerbang_nama;
			$jenis_gerbang = $row->jenis_gerbang;
			$gerbang_id = $row->gerbang_id;
			$gerbanglistoption[] = array("gerbang_nama" => "$gerbang_nama", "jenis_gerbang" => "$jenis_gerbang", "gerbang_id" => "$gerbang_id");
		}
	}
	// var_dump($gerbanglistoption);
} else {
	// echo ("Gerbang kosong");
}
// var_dump ($GerbangOption);

?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="btn-group btn-group-sm pull-right" role="group">

					</div>
					<div class="pull-left" style="width:250px">
						<select class="form-control" id="gerbang" name="gerbang">
							<?php
							if ($input2 == FALSE) {
							?>
								<option selected value="default">KANTOR OPERASIONAL</option>
							<?php
							} else if ($input2 == 'default') {
							?>
								<option selected value="default">KANTOR OPERASIONAL</option>
							<?php
							} else {
							?>
								<option value="default">KANTOR OPERASIONAL</option>
								<option hidden selected value="<?php echo ($gerbanglistoption[0]['gerbang_id']); ?>"><?php echo ($gerbanglistoption[0]['gerbang_nama'] . " - (" . $gerbanglistoption[0]['jenis_gerbang'] . ")"); ?></option>
							<?php
							}
							?>
							<?php
							if (count($GerbangOption) > 0) {
								foreach ($GerbangOption as $row) {
									// kode ruas
									if ($row->jenis_gerbang != '2' && $row->ruas_id == '40') {
										echo '<option value=' . $row->gerbang_id . '>' . ucfirst($row->gerbang_nama) . ' - (' . $row->jenis_gerbang . ')' . '</option>';
									}
								}
							} else {
								echo '<option value="0">Data Not Found</option>';
							}
							?>
						</select>
					</div>
					<btn id="btnDaftarTarif" style="margin-left:10px; width:100px;" class="btn btn-primary pull-left " href="#"> <span class="hidden-sm">Pilih</span></btn>
					<!-- <div id="TestsDiv"> -->

					<form method="post" name="myform" id="myform" action="matriks_tarif_open_f">

						<input type="hidden" name="inputopen" id="inputopen" value="">
						<button id="btnmatriksopenf" style="margin-left:10px; width:auto;" class="btn btn-primary pull-left" onclick="DoSubmit()"><i class="fa fa-fw fa-eye"></i><span class="hidden-sm"> Matriks Open</span></button>

					</form>

					<form method="post" name="myform2" id="myform2" action="matriks_tarif_close_f">

						<input type="hidden" name="inputclose" id="inputclose" value="">
						<button id="btnmatriksclosef" style="margin-left:10px; width:auto;" class="btn btn-primary pull-left" onclick="DoSubmit2()"><i class="fa fa-fw fa-eye"></i><span class="hidden-sm"> Matriks Close</span></button>

					</form>

					<br>
					<br>
					<div class="btn-group btn-group-sm pull-right" role="group">
						<btn id="refreshDaftarTarif" class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></btn>
						<btn id="btnAddDaftarTarif" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span> </btn>

						<!-- <btn id="btnAddDaftarTarifClose" class="btn btn-default" href="#"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span> </btn> -->

					</div>
					<!-- </div> -->

					<div class="clearfix"></div>
				</div>


				<div id="utama">
					<div class="panel-body" style="text-align: center;">
						<a href="<?= base_url('main/matriks_tarif_open') ?>">
							<btn id="matriksopen" style="width:500px;height:500px;font-size:50px;text-align:center;display:table-cell;vertical-align:middle;" class="btn btn-primary" href="#"><span class="hidden-sm">Tarif Open </span>
								<br>
								<i>
									<img src="<?= base_url('assets/admin/plugins/fontawesome/door-open-solid.svg') ?>" height="87" width="100" class="filter-white" />
								</i>
							</btn>
						</a>
						<a href="<?= base_url('main/matriks_tarif_close') ?>">
							<btn id="matriksclose" style="width:500px; height:500px;font-size:50px;text-align: center;display:table-cell;vertical-align:middle;" class="btn btn-primary" href="#"><span class="hidden-sm">Tarif Close</span>
								<br>
								<i><img src="<?= base_url('assets/admin/plugins/fontawesome/door-closed-solid.svg') ?>" height="87" width="100" class="filter-white" />
								</i>
							</btn>
						</a>
					</div>
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

				<div class="panel-footer">
					<span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> Developed By @JMIoTLaboratory</span>
				</div>

			</div>
		</div>

	</div>
</div>



<div class="modal fade" id="DaftarTarifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="width:1250px;">
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
									<input type="hidden" name="id" id="id" />
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1" id="asd1">Asal Gerbang :</label>
									<select class="form-control" id="asal_gerbang" name="asal_gerbang" required>
										<?php
										foreach ($GerbangOption as $row) {
											echo '<option value=' . $row->gerbang_id . '>' . ucfirst($row->gerbang_nama) . ' (' . $row->jenis_gerbang . ')' . '</option>';
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1" id="asq">Asal Gerbang :</label>
									<select class="form-control" id="asal_gerbang_update" name="asal_gerbang_update">
									</select>
								</div>


								<div class="form-group">
									<label for="exampleInputEmail1">Dasar Tarif :</label>
									<select class="form-control" id="dasartarifmodal" name="dasartarifmodal" required>

									</select>
								</div>


								<div class="form-group">
									<label for="exampleInputEmail1" id="asd2">Jenis Transaksi :</label>
									<select class="form-control" id="jenis" name="jenis" required>
										<!-- <option value="3">NORMAL</option>
										<option value="1">KHL</option>
										<option value="2">AGS</option> -->
									</select>
								</div>



								<div class="form-group">
									<label for="exampleInputEmail1">Waktu Berlaku :</label>
									<input type="text" class="form-control" name="waktu" id="waktu" aria-describedby="waktu" placeholder="Waktu Berlaku" required>
								</div>
							</div>



							<div class="col-4 col-sm-6">

								<div class="form-group">
									<label for="exampleInputEmail1">Daftar Tarif :</label>
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
													<input type="text" class="form-control" name="mtngol1" id="mtngol1" onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3" for="exampleInputEmail1">Janger Gol 1 :</label>
												<div class="form-group col-sm-9">
													<input type="text" class="form-control" name="jangergol1" id="jangergol1" onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3" for="exampleInputEmail1">MMS Gol 1 :</label>
												<div class="form-group col-sm-9">
													<input type="text" class="form-control" name="mmsgol1" id="mmsgol1" onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3" for="exampleInputEmail1">BSD Gol 1 :</label>
												<div class="form-group col-sm-9">
													<input type="text" class="form-control" name="bsdgol1" id="bsdgol1" onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3" for="exampleInputEmail1">CSJ Gol 1 :</label>
												<div class="form-group col-sm-9">
													<input type="text" class="form-control" name="csjgol1" id="csjgol1" onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3" for="exampleInputEmail1">JKC Gol 1 :</label>
												<div class="form-group col-sm-9">
													<input type="text" class="form-control" name="jkcgol1" id="jkcgol1" onkeyup="sum_gol(1)" aria-describedby="waktu" placeholder="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3" for="exampleInputEmail1">Total Gol 1 :</label>
												<div class="form-group col-sm-9">
													<input type="text" class="form-control" name="totalgol1" id="totalgol1" aria-describedby="waktu" placeholder="" readonly>
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
													<input type="text" class="form-control" name="mmsgol2" id="mmsgol2" onkeyup="sum_gol(2)" aria-describedby="waktu" placeholder="" required>
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
													<input type="text" class="form-control" name="bsdgol5" id="bsdgol5" onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
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
													<input type="text" class="form-control" name="jkcgol5" id="jkcgol5" onkeyup="sum_gol(5)" aria-describedby="waktu" placeholder="" required>
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
	</div>
</div>


<div class="modal fade" id="DetailTarifModalClose" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<h3 class="modal-title" style="text-align:center;">Detail Investor</h3>
			<div class="modal-header">
				<i class="fa fa-automobile" style="font-size:20px;"></i>
				<label id="judulgerbangasal" style="margin-left:10px;"></label>

				<i class="fa fa-long-arrow-right"></i>
				<label id="judulgerbang"></label>


				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>
			<div class="modal-body" style="background-color: black;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-2" style="color: white">
							<h4>Investor</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 1</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 2</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 3</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 4</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 5</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body" style="background-color: black;">
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
					<div class="row">
						<div class="col-sm-2"><label id="investor6" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol1" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol2" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol3" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol4" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol5" style="color: white"></label></div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="DetailTarifModalOpen" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<h3 class="modal-title" style="text-align:center;">Detail Investor</h3>
			<div class="modal-header">
				<i class="fa fa-automobile" style="font-size:20px;"></i>
				<label id="judulgerbangc"></label>


				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>
			<div class="modal-body" style="background-color: black;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-2" style="color: white">
							<h4>Investor</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 1</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 2</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 3</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 4</h4>
						</div>
						<div class="col-sm-2" style="color: white">
							<h4>Gol 5</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body" style="background-color: black;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-2"><label id="investor1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i1_gol1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i1_gol2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i1_gol3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i1_gol4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i1_gol5c" style="color: white"></label></div>
					</div>

					<div class="row">
						<div class="col-sm-2"><label id="investor2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i2_gol1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i2_gol2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i2_gol3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i2_gol4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i2_gol5c" style="color: white"></label></div>
					</div>

					<div class="row">
						<div class="col-sm-2"><label id="investor3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i3_gol1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i3_gol2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i3_gol3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i3_gol4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i3_gol5c" style="color: white"></label></div>
					</div>

					<div class="row">
						<div class="col-sm-2"><label id="investor4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i4_gol1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i4_gol2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i4_gol3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i4_gol4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i4_gol5c" style="color: white"></label></div>
					</div>

					<div class="row">
						<div class="col-sm-2"><label id="investor5c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i5_gol1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i5_gol2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i5_gol3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i5_gol4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i5_gol5c" style="color: white"></label></div>
					</div>
					<div class="row">
						<div class="col-sm-2"><label id="investor6c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol1c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol2c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol3c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol4c" style="color: white"></label></div>
						<div class="col-sm-2"><label id="i6_gol5c" style="color: white"></label></div>
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

var obj = <?php echo json_encode($GerbangOption); ?>;

	var tabelDaftarTarif;
	var tabelDaftarTarifClose;

	function DoSubmit() {
		var gerbang = $("#gerbang option:selected").val();
		document.getElementById("inputopen").value = gerbang;
		return true;
	}

	function DoSubmit2() {
		var gerbang = $("#gerbang option:selected").val();
		document.getElementById("inputclose").value = gerbang;
		return true;
	}
	document.getElementById("gerbang").onchange = function() {
		myFunction()
	};

	function myFunction() {
		var x = document.getElementById("gerbang");
		//   alert(x.value );
		gerbang = $("#gerbang option:selected").val();
		g = $("#gerbang option:selected").text();
		g = g.split('(').pop().split(')')[0]; // returns 'two'
		console.log(g);
		console.log(gerbang);

		if (g == 0 || g == 4) {
			// console.log("betul");
			// $('#Open').show();
			// $('#Close').hide();
			$('#btnmatriksopenf').show();
			$('#btnmatriksclosef').hide();

		} else if (g == 1 || g == 3) {
			// console.log("betul");
			// $('#Close').show();
			// $('#Open').hide();
			$('#btnmatriksopenf').hide();
			$('#btnmatriksclosef').show();

		} else {
			$('#Open').hide();
			$('#Close').hide();
			$('#btnAddDaftarTarif').hide();
			$('#refreshDaftarTarif').hide();
			$('#utama').show();

			location.replace("<?= base_url('main/daftar_tarif') ?>")

		}

	}
	$(document).ready(function() {
		gerbang = $("#gerbang option:selected").val();
		g = $("#gerbang option:selected").text();
		g = g.split('(').pop().split(')')[0]; // returns 'two'
		console.log(g);
		console.log(gerbang);

		if (g == 0 || g == 4) {
			// console.log("betul");
			$('#Open').show();
			$('#Close').hide();
			$('#btnmatriksopenf').show();
			$('#btnmatriksclosef').hide();
			$('#matriksclose').hide();
			$('#matriksopen').hide();

		} else if (g == 1 || g == 3) {
			// console.log("betul");
			$('#Close').show();
			$('#Open').hide();
			$('#btnmatriksopenf').hide();
			$('#btnmatriksclosef').show();
			$('#matriksclose').hide();
			$('#matriksopen').hide();
		} else {
			$('#Open').hide();
			$('#Close').hide();
			$('#btnAddDaftarTarif').hide();
			$('#refreshDaftarTarif').hide();
			$('#btnmatriksopenf').hide();
			$('#btnmatriksclosef').hide();
			$('#matriksclose').show();
			$('#matriksopen').show();
			// location.replace("<?= base_url('main/daftar_tarif') ?>")

		}

		tabelDaftarTarif = $('#tabelDaftarTarif').DataTable({
			columns: [{
					title: "No"
				},
				{
					title: "Nama Gerbang"
				},
				{
					title: "Dasar Tarif"
				},
				{
					title: "Golongan 1"
				},
				{
					title: "Golongan 2"
				},
				{
					title: "Golongan 3"
				},
				{
					title: "Golongan 4"
				},
				{
					title: "Golongan 5"
				},
				{
					title: "Waktu Berlaku"
				},
				{
					title: "Action"
				}
			],
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
					sFirst: "Awal",
					"sPrevious": "Sebelumnya",
					sNext: "Selanjutnya",
					"sLast": "Akhir"
				},
			},
			"fnDrawCallback": function() {
				$('#loading-body').hide();
			},
			"ajax": {
				"url": base_url + "main/ajax_list_daftartarif",
				"type": "POST",

				"data": function(data) {
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
			"columnDefs": [{
				// "targets": [0,1,2,3,4,5,6,7,8,9], //first column / numbering column
				"className": 'text-center text-nowrap',
				"orderable": false, //set not orderable
			}, ],
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],

		});

		tabelDaftarTarifClose = $('#tabelDaftarTarifClose').DataTable({
			columns: [{
					title: "No"
				},
				{
					title: "Asal Gerbang"
				},
				{
					title: "Nama Gerbang"
				},
				{
					title: "Jenis Tarif"
				},
				{
					title: "Dasar Tarif"
				},
				{
					title: "Golongan 1"
				},
				{
					title: "Golongan 2"
				},
				{
					title: "Golongan 3"
				},
				{
					title: "Golongan 4"
				},
				{
					title: "Golongan 5"
				},
				{
					title: "Waktu Berlaku"
				},
				{
					title: "Action"
				}
			],
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
					sFirst: "Awal",
					"sPrevious": "Sebelumnya",
					sNext: "Selanjutnya",
					"sLast": "Akhir"
				},
			},
			"fnDrawCallback": function() {
				$('#loading-body').hide();
			},
			"ajax": {
				"url": base_url + "main/ajax_list_daftartarifclose",
				"type": "POST",
				"data": function(data) {
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


			'columnDefs': [{
				// "targets": [0,1,2,3,4,5,6,7,8,9], //first column / numbering column
				"className": 'text-center text-nowrap',
				// "orderable": false, //set not orderable
			}, ],
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
		});

		$('.total1').on('change', function() {
			$('#nominal_pembayaran').val($(this).val())
		})

		$('#btnDaftarTarif').click(function() {
			var selectedVal = $("#gerbang option:selected").text();
			selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
			$("#asal_gerbang_update").hide();
			$("#asq").hide();
			console.log('9');

			if (selectedVal == 0 || selectedVal == 4) {
				tabelDaftarTarif.ajax.reload(null, false);
				tabelDaftarTarifClose.ajax.reload(null, false);

				// alert("uhuy");
				$('#Open').show();
				$('#Close').hide();
				$('#btnAddDaftarTarif').show();
				$('#refreshDaftarTarif').show();
				$('#matriksclose').hide();
				$('#matriksopen').hide();

				// document.getElementById('btnAddDaftarTarif').style.visibility = 'visible';
				// document.getElementById('btnAddDaftarTarifClose').style.visibility = 'hidden';
			} else if (selectedVal == 1 || selectedVal == 3) {
				tabelDaftarTarif.ajax.reload(null, false);
				tabelDaftarTarifClose.ajax.reload(null, false);
				// alert("cihuy");
				$('#Open').hide();
				$('#Close').show();
				$('#btnAddDaftarTarif').show();
				$('#refreshDaftarTarif').show();
				$('#matriksclose').hide();
				$('#matriksopen').hide();
				// document.getElementById('btnAddDaftarTarif').style.visibility = 'hidden';
				// document.getElementById('btnAddDaftarTarifClose').style.visibility = 'visible';

			} else {
				tabelDaftarTarif.ajax.reload(null, false);
				tabelDaftarTarifClose.ajax.reload(null, false);
				// alert("uhuk");
				$('#Open').hide();
				$('#Close').hide();
				$('#btnAddDaftarTarif').hide();
				$('#refreshDaftarTarif').hide();

				// document.getElementById('btnAddDaftarTarif').style.visibility = 'hidden';
				// document.getElementById('btnAddDaftarTarifClose').style.visibility = 'visible';

			}




		});



		$("#waktu").datetimepicker({
			format: 'Y-m-d H:i:s',
			theme: 'white'
		});

		$('#btnAddDaftarTarif').click(function() {

			var selectedVal = $("#gerbang option:selected").text();
			selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
			var option = '';
			var gerbang = $("#gerbang").val();
			var url = base_url + '/main/showDasarTarifOption';
			$("#asal_gerbang_update").hide();
			$("#asq").hide();
			if (selectedVal == 0 || selectedVal == 4) {
				$('#gerbangmodal').find('option').remove().end();
				$('#dasartarifmodal').find('option').remove().end();
				$("#form-tambah-edit-DaftarTarif").trigger('reset');

				$.ajax({
					url: url,
					async: false,
					method: "POST",
					data: {
						gerbang: gerbang
					},
					dataType: "JSON",
					success: function(response) {
						//console.log(response);

						$.each(response, function(i, item) {

							option += '<option value="' + response[i].id_dasar_tarif + '"  >' + response[i].dasar_tarif + '</option>'
							//console.log(option);
							//console.log(response[i].dasar_tarif);
						});
					}

				});
			

				$("#gerbangmodal").val($("#gerbang").val());
				$("#id").val(0);
				var optionValue = $("#gerbang option:selected").val();
				var optionText = $("#gerbang option:selected").text();
				$('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
				$('#dasartarifmodal').append(option);
				$("#DaftarTarif-modal-tittle").html('Tambah Tarif');
				$("#DaftarTarifModal").modal('show');
				$("#asal_gerbang").hide();
				$("#jenis").hide();
				$("#asd1").hide();
				$("#asd2").hide();
			} else if (selectedVal == 1 || selectedVal == 3) {
				$('#gerbangmodal').find('option').remove().end();
				$('#dasartarifmodal').find('option').remove().end();
				$("#form-tambah-edit-DaftarTarif").trigger('reset');

				$.ajax({
					url: url,
					async: false,
					method: "POST",
					data: {
						gerbang: gerbang
					},
					dataType: "JSON",
					success: function(response) {
						//console.log(response);

						$.each(response, function(i, item) {

							option += '<option value="' + response[i].id_dasar_tarif + '"  >' + response[i].dasar_tarif + '</option>'
							console.log(option);
							//console.log(response[i].dasar_tarif);
						});
					}

				});


				$('#jenis').find('option').remove().end();
				$("#jenis").append(`<option value="3">NORMAL</option>`);
				$("#jenis").append(`<option value="1">KHL</option>`);
				$("#jenis").append(`<option value="2">AGS</option>`);

				$("#gerbangmodal").val($("#gerbang").val());
				$("#id").val(0);
				var optionValue = $("#gerbang option:selected").val();
				var optionText = $("#gerbang option:selected").text();
				$('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
				$('#dasartarifmodal').append(option);
				$("#DaftarTarif-modal-tittle").html('Tambah Tarif');
				$("#DaftarTarifModal").modal('show');
				$("#asal_gerbang").show();
				$("#jenis").show();
				$("#asd1").show();
				$("#asd2").show();
			} else {
				$("#DaftarTarifModal").modal('hide');
				$("#asal_gerbang").hide();
				$("#jenis").hide();
				$("#asd1").hide();
				$("#asd2").hide();

			}
		});



		$('#refreshDaftarTarif').click(function() {

			var selectedVal = $("#gerbang option:selected").text();
			selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
			if (selectedVal == 0 || selectedVal == 4) {
				tabelDaftarTarif.ajax.reload(null, false);
			} else {
				tabelDaftarTarifClose.ajax.reload(null, false);
			}

		});

		$("#form-tambah-edit-DaftarTarif").submit(function(e) {
			e.preventDefault()
			var selectedVal = $("#gerbang option:selected").text();
			selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
			// $('#asik2').show();
			if (selectedVal == 0 || selectedVal == 4) {

				var url = base_url + '/main/addEditDaftarTarif';
				var formData = new FormData($("#form-tambah-edit-DaftarTarif")[0]);

				$.ajax({
					url: url,
					method: "POST",
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(response) {

						$("#DaftarTarifModal").modal('hide');
						$("#form-tambah-edit-DaftarTarif").trigger('reset');
						tabelDaftarTarif.ajax.reload(null, false);
						iziToast.success({
							title: 'OK',
							message: 'DaftarTarif Berhasil disimpan !',
						});
					}
				});
			} else {
				var url = base_url + '/main/addEditDaftarTarifClose';
				var formData = new FormData($("#form-tambah-edit-DaftarTarif")[0]);

				$.ajax({
					url: url,
					method: "POST",
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(response) {

						$("#DaftarTarifModal").modal('hide');
						$("#form-tambah-edit-DaftarTarif").trigger('reset');
						tabelDaftarTarifClose.ajax.reload(null, false);
						iziToast.success({
							title: 'OK',
							message: 'DaftarTarif Berhasil disimpan !',
						});
					}
				});
			}

		});

	});


	function sum_gol(id) {
		switch (id) {
			case 1:
				var mtn = $('#mtngol1').val() == '' ? 0 : $('#mtngol1').val();
				var jm = $('#jangergol1').val() == '' ? 0 : $('#jangergol1').val();
				var mms = $('#mmsgol1').val() == '' ? 0 : $('#mmsgol1').val();
				var bsd = $('#bsdgol1').val() == '' ? 0 : $('#bsdgol1').val();
				var csj = $('#csjgol1').val() == '' ? 0 : $('#csjgol1').val();
				var jkc = $('#jkcgol1').val() == '' ? 0 : $('#jkcgol1').val();

				var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
				if (!isNaN(result)) {
					$('#totalgol1').val(result);
				}
				break;
			case 2:
				var mtn = $('#mtngol2').val() == '' ? 0 : $('#mtngol2').val();
				var jm = $('#jangergol2').val() == '' ? 0 : $('#jangergol2').val();
				var mms = $('#mmsgol2').val() == '' ? 0 : $('#mmsgol2').val();
				var bsd = $('#bsdgol2').val() == '' ? 0 : $('#bsdgol2').val();
				var csj = $('#csjgol2').val() == '' ? 0 : $('#csjgol2').val();
				var jkc = $('#jkcgol2').val() == '' ? 0 : $('#jkcgol2').val();

				var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
				if (!isNaN(result)) {
					$('#totalgol2').val(result);
				}
				break;
			case 3:
				var mtn = $('#mtngol3').val() == '' ? 0 : $('#mtngol3').val();
				var jm = $('#jangergol3').val() == '' ? 0 : $('#jangergol3').val();
				var mms = $('#mmsgol3').val() == '' ? 0 : $('#mmsgol3').val();
				var bsd = $('#bsdgol3').val() == '' ? 0 : $('#bsdgol3').val();
				var csj = $('#csjgol3').val() == '' ? 0 : $('#csjgol3').val();
				var jkc = $('#jkcgol3').val() == '' ? 0 : $('#jkcgol3').val();

				var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
				if (!isNaN(result)) {
					$('#totalgol3').val(result);
				}
				break;
			case 4:
				var mtn = $('#mtngol4').val() == '' ? 0 : $('#mtngol4').val();
				var jm = $('#jangergol4').val() == '' ? 0 : $('#jangergol4').val();
				var mms = $('#mmsgol4').val() == '' ? 0 : $('#mmsgol4').val();
				var bsd = $('#bsdgol4').val() == '' ? 0 : $('#bsdgol4').val();
				var csj = $('#csjgol4').val() == '' ? 0 : $('#csjgol4').val();
				var jkc = $('#jkcgol4').val() == '' ? 0 : $('#jkcgol4').val();

				var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
				if (!isNaN(result)) {
					$('#totalgol4').val(result);
				}
				break;
			case 5:
				var mtn = $('#mtngol5').val() == '' ? 0 : $('#mtngol5').val();
				var jm = $('#jangergol5').val() == '' ? 0 : $('#jangergol5').val();
				var mms = $('#mmsgol5').val() == '' ? 0 : $('#mmsgol5').val();
				var bsd = $('#bsdgol5').val() == '' ? 0 : $('#bsdgol5').val();
				var csj = $('#csjgol5').val() == '' ? 0 : $('#csjgol5').val();
				var jkc = $('#jkcgol5').val() == '' ? 0 : $('#jkcgol5').val();

				var result = parseFloat(mtn) + parseFloat(jm) + parseFloat(mms) + parseFloat(bsd) + parseFloat(csj) + parseFloat(jkc);
				if (!isNaN(result)) {
					$('#totalgol5').val(result);
				}
				break;
		}

	}

	function btnEditDaftarTarifModal(id) {
		//alert(id);
		var selectedVal = $("#gerbang option:selected").text();
		selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
		if (selectedVal == 0 || selectedVal == 4) {
			var url = base_url + '/main/showDaftarTarif';
			var gerbang = $("#gerbang option:selected").val();

			$.ajax({

				url: url,
				method: "POST",
				async: false,
				data: {
					id: id,
					gerbang: gerbang
				},
				dataType: "JSON",
				success: function(response) {
					$('#dasartarifmodal').find('option').remove().end();
					$('#gerbangmodal').find('option').remove().end();
					$("#id").val(response[0].id);
					$('#jenis').find('option').remove().end();

					//console.log(response[0].id_dasar_tarif);

					var option = '';
					var gerbang = $("#gerbang").val();
					var url = base_url + '/main/showDasarTarifOption';
					$.ajax({
						url: url,
						async: false,
						method: "POST",
						data: {
							id: id,
							gerbang: gerbang
						},
						dataType: "JSON",
						success: function(data) {
							// console.log(data);
							console.log(data[0].id_daftar_tarif);
							$.each(data, function(i, item) {

								//console.log(data[i].id_dasar_tarif);
								var selected = '';
								if (response[0].id_dasar_tarif == data[i].id_dasar_tarif) {
									selected = "selected";
								}

								option += '<option value="' + data[i].id_dasar_tarif + '" ' + selected + '>' + response[i].dasar_tarif + '</option>'

															
							});
						}

					});

					$('#dasartarifmodal').append(option);

					// $('#jenis').find('option').remove().end();

					// if (optionJenisVal == 'KHL') {
					// 	$("#jenis").append(`<option value="1"> ${optionJenisVal}</option>`);
					// 	$("#jenis").append(`<option value="2">AGS</option>`);
					// 	$("#jenis").append(`<option value="3">NORMAL</option>`);


					// }
					// else if (optionJenisVal == 'AGS') {
					// 	$("#jenis").append(`<option value="2"> ${optionJenisVal}</option>`);
					// 	$("#jenis").append(`<option value="1">KHL</option>`);
					// 	$("#jenis").append(`<option value="3">NORMAL</option>`);
					// }
					// else {
					// 	$("#jenis").append(`<option value="3"> ${optionJenisVal}</option>`);
					// 	$("#jenis").append(`<option value="1">KHL</option>`);
					// 	$("#jenis").append(`<option value="2">AGS</option>`);
					// }



					
					var optionValue = $("#gerbang option:selected").val();
					var optionText = $("#gerbang option:selected").text();
					$('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);

					$("#waktu").val(response[0].tgl_berlaku);
					$("#mtngol1").val(JSON.parse(response[0].gol1_d)[0]);
					$("#jangergol1").val(JSON.parse(response[0].gol1_d)[1]);
					$("#mmsgol1").val(JSON.parse(response[0].gol1_d)[2]);
					$("#bsdgol1").val(JSON.parse(response[0].gol1_d)[3]);
					$("#jkcgol1").val(JSON.parse(response[0].gol1_d)[4]);
					$("#csjgol1").val(JSON.parse(response[0].gol1_d)[5]);

					$("#totalgol1").val(response[0].gol1)

					$("#mtngol2").val(JSON.parse(response[0].gol2_d)[0]);
					$("#jangergol2").val(JSON.parse(response[0].gol2_d)[1]);
					$("#mmsgol2").val(JSON.parse(response[0].gol2_d)[2]);
					$("#bsdgol2").val(JSON.parse(response[0].gol2_d)[3]);
					$("#jkcgol2").val(JSON.parse(response[0].gol2_d)[4]);
					$("#csjgol2").val(JSON.parse(response[0].gol2_d)[5]);
					$("#totalgol2").val(response[0].gol2)

					$("#mtngol3").val(JSON.parse(response[0].gol3_d)[0]);
					$("#jangergol3").val(JSON.parse(response[0].gol3_d)[1]);
					$("#mmsgol3").val(JSON.parse(response[0].gol3_d)[2]);
					$("#bsdgol3").val(JSON.parse(response[0].gol3_d)[3]);
					$("#jkcgol3").val(JSON.parse(response[0].gol3_d)[4]);
					$("#csjgol3").val(JSON.parse(response[0].gol3_d)[5]);
					$("#totalgol3").val(response[0].gol3)

					$("#mtngol4").val(JSON.parse(response[0].gol4_d)[0]);
					$("#jangergol4").val(JSON.parse(response[0].gol4_d)[1]);
					$("#mmsgol4").val(JSON.parse(response[0].gol4_d)[2]);
					$("#bsdgol4").val(JSON.parse(response[0].gol4_d)[3]);
					$("#jkcgol4").val(JSON.parse(response[0].gol4_d)[4]);
					$("#csjgol4").val(JSON.parse(response[0].gol4_d)[5]);
					$("#totalgol4").val(response[0].gol4)

					$("#mtngol5").val(JSON.parse(response[0].gol5_d)[0]);
					$("#jangergol5").val(JSON.parse(response[0].gol5_d)[1]);
					$("#mmsgol5").val(JSON.parse(response[0].gol5_d)[2]);
					$("#bsdgol5").val(JSON.parse(response[0].gol5_d)[3]);
					$("#jkcgol5").val(JSON.parse(response[0].gol5_d)[4]);
					$("#csjgol5").val(JSON.parse(response[0].gol5_d)[5]);
					$("#totalgol5").val(response[0].gol5)

					$("#DaftarTarif-modal-tittle").html('Edit Daftar Tarif');
					$("#DaftarTarifModal").modal('show');
					$("#asal_gerbang").hide();
					$("#asal_gerbang_update").hide();
					$("#asq").hide();

					$("#jenis").hide();
					$("#asd1").hide();
					$("#asd2").hide();

				}

			});
		} else {
			var url = base_url + '/main/showDaftarTarifClose';
			var gerbang = $("#gerbang option:selected").val();

			$.ajax({

				url: url,
				method: "POST",
				async: false,
				data: {
					id: id,
					gerbang: gerbang
				},
				dataType: "JSON",
				success: function(response) {
					$("#id").val(response[0].id);
					$('#dasartarifmodal').find('option').remove().end();
					$('#gerbangmodal').find('option').remove().end();
					//console.log(response[0].id_dasar_tarif);

					var option = '';
					var gerbang = $("#gerbang").val();
					var url = base_url + '/main/showDasarTarifOption';
					$.ajax({
						url: url,
						async: false,
						method: "POST",
						data: {
							gerbang: gerbang
						},
						dataType: "JSON",
						success: function(data) {
							//console.log(data);
							//console.log(data[0].id_daftar_tarif_close);
							$.each(data, function(i, item) {

								//console.log(data[i].id_dasar_tarif);
								var selected = '';
								if (response[0].id_dasar_tarif == data[i].id_dasar_tarif) {
									selected = "selected";
								}

								option += '<option value="' + data[i].id_dasar_tarif + '" ' + selected + '>' + data[i].dasar_tarif + '</option>'
							});
						}

					});

					$('#dasartarifmodal').append(option);
					var optionValue = $("#gerbang option:selected").val();
					var optionText = $("#gerbang option:selected").text();
					var optionJenisVal = response[0].jenis;
					var optionJenisVal = optionJenisVal.toUpperCase();

					// var temp="a"; 
					$('#jenis').find('option').remove().end();
					$('#asal_gerbang_update').find('option').remove().end();

					var i;
					for (i = 0; i < obj.length; i++) {
						if(response[0].asal_gerbang == obj[i].gerbang_id){
							// $("#judulgerbangc").text(obj[i].gerbang_nama);
							$("#asal_gerbang_update").append(`<option value="${obj[i].gerbang_id}"> ${obj[i].gerbang_nama} </option>`);
							// console.log(obj[i].gerbang_nama);

						}
					}


					if (optionJenisVal == 'KHL') {
						$("#jenis").append(`<option value="1"> ${optionJenisVal}</option>`);
						$("#jenis").append(`<option value="2">AGS</option>`);
						$("#jenis").append(`<option value="3">NORMAL</option>`);


					}
					else if (optionJenisVal == 'AGS') {
						$("#jenis").append(`<option value="2"> ${optionJenisVal}</option>`);
						$("#jenis").append(`<option value="1">KHL</option>`);
						$("#jenis").append(`<option value="3">NORMAL</option>`);
					}
					else {
						$("#jenis").append(`<option value="3"> ${optionJenisVal}</option>`);
						$("#jenis").append(`<option value="1">KHL</option>`);
						$("#jenis").append(`<option value="2">AGS</option>`);
					}

					$('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);


					$("#waktu").val(response[0].tgl_berlaku);

					$("#mtngol1").val(JSON.parse(response[0].gol1_d)[0]);
					$("#jangergol1").val(JSON.parse(response[0].gol1_d)[1]);
					$("#mmsgol1").val(JSON.parse(response[0].gol1_d)[2]);
					$("#bsdgol1").val(JSON.parse(response[0].gol1_d)[3]);
					$("#jkcgol1").val(JSON.parse(response[0].gol1_d)[4]);
					$("#csjgol1").val(JSON.parse(response[0].gol1_d)[5]);

					$("#totalgol1").val(response[0].gol1)

					$("#mtngol2").val(JSON.parse(response[0].gol2_d)[0]);
					$("#jangergol2").val(JSON.parse(response[0].gol2_d)[1]);
					$("#mmsgol2").val(JSON.parse(response[0].gol2_d)[2]);
					$("#bsdgol2").val(JSON.parse(response[0].gol2_d)[3]);
					$("#jkcgol2").val(JSON.parse(response[0].gol2_d)[4]);
					$("#csjgol2").val(JSON.parse(response[0].gol2_d)[5]);
					$("#totalgol2").val(response[0].gol2)

					$("#mtngol3").val(JSON.parse(response[0].gol3_d)[0]);
					$("#jangergol3").val(JSON.parse(response[0].gol3_d)[1]);
					$("#mmsgol3").val(JSON.parse(response[0].gol3_d)[2]);
					$("#bsdgol3").val(JSON.parse(response[0].gol3_d)[3]);
					$("#jkcgol3").val(JSON.parse(response[0].gol3_d)[4]);
					$("#csjgol3").val(JSON.parse(response[0].gol3_d)[5]);
					$("#totalgol3").val(response[0].gol3)

					$("#mtngol4").val(JSON.parse(response[0].gol4_d)[0]);
					$("#jangergol4").val(JSON.parse(response[0].gol4_d)[1]);
					$("#mmsgol4").val(JSON.parse(response[0].gol4_d)[2]);
					$("#bsdgol4").val(JSON.parse(response[0].gol4_d)[3]);
					$("#jkcgol4").val(JSON.parse(response[0].gol4_d)[4]);
					$("#csjgol4").val(JSON.parse(response[0].gol4_d)[5]);
					$("#totalgol4").val(response[0].gol4)

					$("#mtngol5").val(JSON.parse(response[0].gol5_d)[0]);
					$("#jangergol5").val(JSON.parse(response[0].gol5_d)[1]);
					$("#mmsgol5").val(JSON.parse(response[0].gol5_d)[2]);
					$("#bsdgol5").val(JSON.parse(response[0].gol5_d)[3]);
					$("#jkcgol5").val(JSON.parse(response[0].gol5_d)[4]);
					$("#csjgol5").val(JSON.parse(response[0].gol5_d)[5]);
					$("#totalgol5").val(response[0].gol5)

					$("#DaftarTarif-modal-tittle").html('Edit Daftar Tarif');
					$("#DaftarTarifModal").modal('show');
					$("#asal_gerbang").hide();
					$("#asd1").hide();
					$("#asq").show();
					$("#asal_gerbang_update").show();


				}

			});
		}

	}

	function btnDeleteDaftarTarif(id) {

		var selectedVal = $("#gerbang option:selected").text();
		selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
		if (selectedVal == 0 || selectedVal == 4) {
			iziToast.question({
				timeout: 20000,
				close: false,
				overlay: true,
				displayMode: 'once',
				id: 'question',
				zindex: 999,
				title: 'Hey',
				message: 'Are you sure want to delete ID = ' + id + '?',
				position: 'center',
				buttons: [
					['<button><b>YES</b></button>', function(instance, toast) {

						instance.hide({
							transitionOut: 'fadeOut'
						}, toast, 'button');
						var url = base_url + '/main/deleteDaftarTarif';
						var gerbang = $("#gerbang option:selected").val();
						//console.log(gerbang);
						$.ajax({
							url: url,
							method: "POST",
							data: {
								id: id,
								gerbang: gerbang
							},
							dataType: "JSON",
							success: function(data) { //jika sukses
								//console.log(data);
								tabelDaftarTarif.ajax.reload(null, false);
								iziToast.success({
									title: 'OK',
									message: 'Data has been deleted !',
								});
							}
						});

					}, true],
					['<button>NO</button>', function(instance, toast) {
						instance.hide({
							transitionOut: 'fadeOut'
						}, toast, 'button');
					}],
				]
			});
		} else {
			iziToast.question({
				timeout: 20000,
				close: false,
				overlay: true,
				displayMode: 'once',
				id: 'question',
				zindex: 999,
				title: 'Hey',
				message: 'Are you sure want to delete ID = ' + id + '?',
				position: 'center',
				buttons: [
					['<button><b>YES</b></button>', function(instance, toast) {

						instance.hide({
							transitionOut: 'fadeOut'
						}, toast, 'button');
						var url = base_url + '/main/deleteDaftarTarifClose';
						var gerbang = $("#gerbang option:selected").val();
						//console.log(gerbang);
						$.ajax({
							url: url,
							method: "POST",
							data: {
								id: id,
								gerbang: gerbang
							},
							dataType: "JSON",
							success: function(data) { //jika sukses
								//console.log(data);
								tabelDaftarTarifClose.ajax.reload(null, false);
								iziToast.success({
									title: 'OK',
									message: 'Data has been deleted !',
								});
							}
						});

					}, true],
					['<button>NO</button>', function(instance, toast) {
						instance.hide({
							transitionOut: 'fadeOut'
						}, toast, 'button');
					}],
				]
			});
		}
	}

	function btnDetailDaftarTarif(id)
{    
	//alert(id);
	var selectedVal = $("#gerbang option:selected").text();
		selectedVal = selectedVal.split('(').pop().split(')')[0]; // returns 'two'
		if (selectedVal == 0 || selectedVal == 4) {	
			var url=base_url +'/main/showDaftarTarif'; 
			var gerbang=$("#gerbang option:selected").val();

			$.ajax({

				url:url,
				method:"POST",
				
				data : {id:id,gerbang:gerbang},
				dataType :"JSON",
				success:function(response)
				{
					$('#dasartarifmodal').find('option').remove().end();
					$('#gerbangmodal').find('option').remove().end();
					$("#id").val(response[0].id);
					// console.log(response[0].id_dasar_tarif);

					var option='';
					var gerbang=$("#gerbang").val();
					var url=base_url +'/main/showDasarTarifOption';
					$.ajax({
					url:url,
					
					method:"POST",
					data : {gerbang:gerbang},
					dataType :"JSON",
					success:function(data)
						{
							console.log(data);
							console.log(data[0].id_dasar_tarif);

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


					var investor = response[0].bagi_hasil;
					var investor = investor.replace('[', '');
					var investor = investor.replace(']', '');
					var investor1 = investor.split(',');
					// var gerbang=$("#gerbang option:selected").text();
					
					
					var i;
					for (i = 0; i < obj.length; i++) {
						if(response[0].gerbang_id == obj[i].gerbang_id){
							$("#judulgerbangc").text(obj[i].gerbang_nama);
						}
					}

					$("#investor1c").text(investor1[0]);
					$("#i1_gol1c").text(JSON.parse(response[0].gol1_d)[0]);
					$("#i1_gol2c").text(JSON.parse(response[0].gol2_d)[0]);
					$("#i1_gol3c").text(JSON.parse(response[0].gol3_d)[0]);
					$("#i1_gol4c").text(JSON.parse(response[0].gol4_d)[0]);
					$("#i1_gol5c").text(JSON.parse(response[0].gol5_d)[0]);

					$("#investor2c").text(investor1[1]);
					$("#i2_gol1c").text(JSON.parse(response[0].gol1_d)[1]);
					$("#i2_gol2c").text(JSON.parse(response[0].gol2_d)[1]);
					$("#i2_gol3c").text(JSON.parse(response[0].gol3_d)[1]);
					$("#i2_gol4c").text(JSON.parse(response[0].gol4_d)[1]);
					$("#i2_gol5c").text(JSON.parse(response[0].gol5_d)[1]);

					$("#investor3c").text(investor1[2]);
					$("#i3_gol1c").text(JSON.parse(response[0].gol1_d)[2]);
					$("#i3_gol2c").text(JSON.parse(response[0].gol2_d)[2]);
					$("#i3_gol3c").text(JSON.parse(response[0].gol3_d)[2]);
					$("#i3_gol4c").text(JSON.parse(response[0].gol4_d)[2]);
					$("#i3_gol5c").text(JSON.parse(response[0].gol5_d)[2]);

					$("#investor4c").text(investor1[3]);
					$("#i4_gol1c").text(JSON.parse(response[0].gol1_d)[3]);
					$("#i4_gol2c").text(JSON.parse(response[0].gol2_d)[3]);
					$("#i4_gol3c").text(JSON.parse(response[0].gol3_d)[3]);
					$("#i4_gol4c").text(JSON.parse(response[0].gol4_d)[3]);
					$("#i4_gol5c").text(JSON.parse(response[0].gol5_d)[3]);

					$("#investor5c").text(investor1[4]);
					$("#i5_gol1c").text(JSON.parse(response[0].gol1_d)[4]);
					$("#i5_gol2c").text(JSON.parse(response[0].gol2_d)[4]);
					$("#i5_gol3c").text(JSON.parse(response[0].gol3_d)[4]);
					$("#i5_gol4c").text(JSON.parse(response[0].gol4_d)[4]);
					$("#i5_gol5c").text(JSON.parse(response[0].gol5_d)[4]);

					$("#investor6c").text(investor1[5]);
					$("#i6_gol1c").text(JSON.parse(response[0].gol1_d)[5]);
					$("#i6_gol2c").text(JSON.parse(response[0].gol2_d)[5]);
					$("#i6_gol3c").text(JSON.parse(response[0].gol3_d)[5]);
					$("#i6_gol4c").text(JSON.parse(response[0].gol4_d)[5]);
					$("#i6_gol5c").text(JSON.parse(response[0].gol5_d)[5]);

										
					$("#DetailTarifModalOpen").modal('show');


				}

			});		
		}
		else {
			var url=base_url +'/main/showDaftarTarifClose'; 
			var gerbang=$("#gerbang option:selected").val();

			$.ajax({

				url:url,
				method:"POST",
				
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
					var url=base_url +'/main/showDasarTarifOption';
					$.ajax({
					url:url,
					
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

					// $("#dasartarifmodal").val(JSON.parse(response[0].id_dasar_tarif));
					// $('#dasartarifmodal').append(option);
					// var optionValue=$("#gerbang option:selected").val();
					// var optionText=$("#gerbang option:selected").text();
					// $('#gerbangmodal').append(`<option value="${optionValue}"> ${optionText}</option>`);
					// $("#jenis").val(response[0].tgl_berlaku);      					
					// $("#waktu").val(response[0].tgl_berlaku);      


					var investor = response[0].tarif_inv;
					var investor = investor.replace('[', '');
					var investor = investor.replace(']', '');
					var investor1 = investor.split(',');

					var i;
					for (i = 0; i < obj.length; i++) {
						if(response[0].gerbang_id == obj[i].gerbang_id){
							$("#judulgerbang").text(obj[i].gerbang_nama);
						}
					}
					var i;
					for (i = 0; i < obj.length; i++) {
						if(response[0].asal_gerbang == obj[i].gerbang_id){
							$("#judulgerbangasal").text(obj[i].gerbang_nama);
						}
					}
					// $("#judulgerbang").text(response[0].gerbang_id);
					// $("#judulgerbangasal").text(response[0].asal_gerbang);

					$("#investor1").text(investor1[0]);
					$("#i1_gol1").text(JSON.parse(response[0].gol1_d)[0]);
					$("#i1_gol2").text(JSON.parse(response[0].gol2_d)[0]);
					$("#i1_gol3").text(JSON.parse(response[0].gol3_d)[0]);
					$("#i1_gol4").text(JSON.parse(response[0].gol4_d)[0]);
					$("#i1_gol5").text(JSON.parse(response[0].gol5_d)[0]);

					$("#investor2").text(investor1[1]);
					$("#i2_gol1").text(JSON.parse(response[0].gol1_d)[1]);
					$("#i2_gol2").text(JSON.parse(response[0].gol2_d)[1]);
					$("#i2_gol3").text(JSON.parse(response[0].gol3_d)[1]);
					$("#i2_gol4").text(JSON.parse(response[0].gol4_d)[1]);
					$("#i2_gol5").text(JSON.parse(response[0].gol5_d)[1]);

					$("#investor3").text(investor1[2]);
					$("#i3_gol1").text(JSON.parse(response[0].gol1_d)[2]);
					$("#i3_gol2").text(JSON.parse(response[0].gol2_d)[2]);
					$("#i3_gol3").text(JSON.parse(response[0].gol3_d)[2]);
					$("#i3_gol4").text(JSON.parse(response[0].gol4_d)[2]);
					$("#i3_gol5").text(JSON.parse(response[0].gol5_d)[2]);

					$("#investor4").text(investor1[3]);
					$("#i4_gol1").text(JSON.parse(response[0].gol1_d)[3]);
					$("#i4_gol2").text(JSON.parse(response[0].gol2_d)[3]);
					$("#i4_gol3").text(JSON.parse(response[0].gol3_d)[3]);
					$("#i4_gol4").text(JSON.parse(response[0].gol4_d)[3]);
					$("#i4_gol5").text(JSON.parse(response[0].gol5_d)[3]);

					$("#investor5").text(investor1[4]);
					$("#i5_gol1").text(JSON.parse(response[0].gol1_d)[4]);
					$("#i5_gol2").text(JSON.parse(response[0].gol2_d)[4]);
					$("#i5_gol3").text(JSON.parse(response[0].gol3_d)[4]);
					$("#i5_gol4").text(JSON.parse(response[0].gol4_d)[4]);
					$("#i5_gol5").text(JSON.parse(response[0].gol5_d)[4]);

					$("#investor6").text(investor1[5]);
					$("#i6_gol1").text(JSON.parse(response[0].gol1_d)[5]);
					$("#i6_gol2").text(JSON.parse(response[0].gol2_d)[5]);
					$("#i6_gol3").text(JSON.parse(response[0].gol3_d)[5]);
					$("#i6_gol4").text(JSON.parse(response[0].gol4_d)[5]);
					$("#i6_gol5").text(JSON.parse(response[0].gol5_d)[5]);

					$("#investor7").text(investor1[6]);
					$("#i7_gol1").text(JSON.parse(response[0].gol1_d)[6]);
					$("#i7_gol2").text(JSON.parse(response[0].gol2_d)[6]);
					$("#i7_gol3").text(JSON.parse(response[0].gol3_d)[6]);
					$("#i7_gol4").text(JSON.parse(response[0].gol4_d)[6]);
					$("#i7_gol5").text(JSON.parse(response[0].gol5_d)[6]);

					$("#investor8").text(investor1[7]);
					$("#i8_gol1").text(JSON.parse(response[0].gol1_d)[7]);
					$("#i8_gol2").text(JSON.parse(response[0].gol2_d)[7]);
					$("#i8_gol3").text(JSON.parse(response[0].gol3_d)[7]);
					$("#i8_gol4").text(JSON.parse(response[0].gol4_d)[7]);
					$("#i8_gol5").text(JSON.parse(response[0].gol5_d)[7]);



					// $("#DaftarTarif-modal-tittle").html('Edit Daftar Tarif');       
					$("#DetailTarifModalClose").modal('show');
			}

		});	
	}
 
}



</script>