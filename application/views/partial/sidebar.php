<div id="sidebar">
    <div id="sidebar-wrapper">
        <div class="sidebar-title"><h2>APLIKASI</h2><span>Operasional</span></div>
        <ul class="sidebar-nav">
            <li class="sidebar-close"><a href="#"><i class="fa fa-fw fa-close"></i></a></li>
            <li class="<?php if($this->uri->segment(2)=='dashboard' || $this->uri->segment(2)==''){echo 'active';}?>"><a href="<?=base_url('main/dashboard')?>"><i class="fa fa-fw fa-home"></i><span class="nav-label">Dashboard</span></a></li>
            <li class="<?php if($this->uri->segment(2)=='petugas' || $this->uri->segment(2)=='lihat_petugas' || $this->uri->segment(2)=='kartu_operasional' ){echo 'active';}?>">
                <a href="#nav-petugas" data-toggle="collapse" aria-controls="nav-petugas"><i class="fa fa-fw fa-users"></i><span class="nav-label">Petugas</span></a>
                <ul class="sidebar-nav-child collapse collapseable"  id="nav-petugas">
                    <li id="ko" class="<?php if($this->uri->segment(2)=='petugas'){echo 'active';}?>"><a href="<?=base_url('main/petugas')?>"><i class="fa fa-user"></i><span class="nav-label">Data Petugas</span></a></li>
                    <li id="ko" class="<?php if($this->uri->segment(2)=='lihat_petugas'){echo 'active';}?>"><a href="<?=base_url('main/lihat_petugas')?>"><i class="fa fa-eye"></i><span class="nav-label">Lihat Petugas</span></a></li>
                    <li id="ko" class="<?php if($this->uri->segment(2)=='kartu_operasional'){echo 'active';}?>"><a href="<?=base_url('main/kartu_operasional')?>"><i class="fa fa-bookmark"></i><span class="nav-label">Buat Kartu Ops</span></a></li>
                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2)=='rencana_petugas' || $this->uri->segment(2)=='jadwal_gerbang'){echo 'active';}?>">
                <a href="#nav-penjadwalan" data-toggle="collapse" aria-controls="nav-penjadwalan"><i class="fa fa-fw fa-book"></i><span class="nav-label">Penjadwalan</span></a>
                <ul class="sidebar-nav-child collapse collapseable"  id="nav-penjadwalan">
                    <li id="ko" class="<?php if($this->uri->segment(2)=='rencana_petugas'){echo 'active';}?>"><a href="<?=base_url('main/rencana_petugas')?>"><i class="fa fa-pencil-square-o"></i><span class="nav-label">Rencana</span></a></li>
                    <li id="ko" class="<?php if($this->uri->segment(2)=='jadwal_gerbang'){echo 'active';}?>"><a href="<?=base_url('main/jadwal_gerbang')?>"><i class="fa fa-table"></i><span class="nav-label">Jadwal Gerbang</span></a></li>
                </ul>
            </li>		
            
            <li class="<?php if($this->uri->segment(2)=='penerbitan_kartu' || $this->uri->segment(2)=='kartu_dinas' || $this->uri->segment(2)=='blacklist'  ){echo 'active';}?>">
                <a href="#nav-dokumen" data-toggle="collapse" aria-controls="nav-dokumen"><i class="fa fa-fw fa-credit-card"></i><span class="nav-label">Kartu Dinas</span></a>
                <ul class="sidebar-nav-child collapse collapseable"  id="nav-dokumen">
                    <li class="<?php if($this->uri->segment(2)=='penerbitan_kartu'){echo 'active';}?>"><a href="<?=base_url('main/penerbitan_kartu')?>"><i class="fa fa-sticky-note-o"></i><span class="nav-label">Penerbitan Kartu</span></a></li>
                    <li class="<?php if($this->uri->segment(2)=='kartu_dinas' ){echo 'active';}?>"><a href="<?=base_url('main/kartu_dinas')?>"><i class="fa fa-car"></i><span class="nav-label">Buat Kartu</span></a></li>
                    <li class="<?php if($this->uri->segment(2)=='perpanjangan'){echo 'active';}?>"><a href="<?=base_url('main/perpanjangan')?>"><i class="fa fa-ticket"></i><span class="nav-label">Perpanjangan</span></a></li>
                    <li class="<?php if($this->uri->segment(2)=='blacklist' ){echo 'active';}?>"><a href="<?=base_url('main/blacklist')?>"><i class="fa fa-ban"></i><span class="nav-label">Blacklist</span></a></li>
                </ul>
            </li>					
            <li class="<?php if($this->uri->segment(2)=='tarif'){echo 'active';}?>"><a data-toggle="collapse" aria-controls="nav-tarif" href="#nav-tarif"><i class="fa fa-fw fa-money"></i><span class="nav-label">Tarif</span></a>
                 <ul class="sidebar-nav-child collapse collapseable"  id="nav-tarif">
                    <li id="ko" class="<?php if($this->uri->segment(2)=='dasar_tarif' ){echo 'active';}?>"><a href="<?=base_url('main/dasar_tarif')?>"><i class="fa fa-archive"></i><span class="nav-label">Dasar Tarif</span></a></li>
                    <li class="<?php if($this->uri->segment(2)=='daftar_tarif' ){echo 'active';}?>"><a href="<?=base_url('main/daftar_tarif')?>"><i class="fa fa-list-alt"></i><span class="nav-label">Manajemen Tarif</span></a></li>
                    <li class="<?php if($this->uri->segment(2)=='durasi_tarif' ){echo 'active';}?>"><a href="<?=base_url('main/durasi_tarif')?>"><i class="fa fa-clock-o"></i><span class="nav-label">Durasi Tarif</span></a></li>
                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2)=='log') {echo 'active';}?>"><a href="<?=base_url('main/log')?>"><i class="fa fa-fw fa-google-wallet"></i><span class="nav-label">Log</span></a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="<?= base_url('auth/logout')?>" class="btn btn-default btn-block"><i class="fa fa-fw fa-power-off"></i><span class="nav-label">logout</span></a>
        </div>
    </div>
</div>




``