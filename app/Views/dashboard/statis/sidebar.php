<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa fa-paw"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Dashboard</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Kelola
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kelolaProfile"
        aria-expanded="true" aria-controls="kelolaProfile">
        <i class="fa fa-user"></i>
        <span>Profile</span>
    </a>
    <div id="kelolaProfile" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Ubah Profile</a>
            <a class="collapse-item" href="<?= base_url("dashboard/veriflanjut")?>">Verifikasi Lanjut</a>
        </div>
    </div>
</li>
<!-- Kelola hewan -->

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kelolaHewan"
        aria-expanded="true" aria-controls="kelolaHewan">
        <i class="fa fa-paw"></i>
        <span>Kelola Hewan</span>
    </a>
    <div id="kelolaHewan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('/dashboard/kelolahewan')?>">Cek Hewan</a>
            <a class="collapse-item" href="<?= base_url('/dashboard/kelolaadopsi/pengajuan')?>">Pengajuan Adopsi</a>
            <a class="collapse-item" href="<?= base_url('/dashboard/kelolaadopsi/orang')?>">Permintaan Pengadopsi</a>
        </div>
    </div>
</li>

<!-- Transaksi -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi"
        aria-expanded="true" aria-controls="transaksi">
        <i class="fa fa-exchange"></i>
        <span>Transaksi</span>
    </a>
    <div id="transaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Daftar Transaksi</a>
            <a class="collapse-item" href="cards.html">Pencairan Dana</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>


<!-- Nav Item - Keluar -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('/login/keluar')?>">
        <i class="fa fa-sign-out"></i>
        <span>Keluar</span></a>
</li>

<!-- Nav Item - Tables -->
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
</ul>