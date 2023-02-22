CREATE TYPE is_active as ENUM('0','1');
CREATE TYPE jenis_hewan as ENUM('Kucing', 'Anjing');
CREATE TYPE jenis_kelaminh as ENUM('Jantan', 'Betina');
CREATE TYPE vaksinasi as ENUM('0','1');
CREATE TYPE steril as ENUM('0','1');
CREATE TYPE status_adopsi as ENUM('Menunggu Diterima','Menunggu Pembayaran','Proses Jual Beli','Berhasil','Gagal');
CREATE TYPE status_transaksi as ENUM('Menunggu','Berhasil Dibayar','Diterima oleh Penjual', 'Proses Pengiriman','Sampai','Dibatalkan oleh Pembeli','Dibatalkan oleh Penjual','Selesai');
CREATE TYPE id_level as ENUM ('1','2','3','4'); /* 1=admin, 2=memberterverifikasi, 3=member baru daftar, 4=mungkin customer service */
CREATE TYPE status_verifikasi as ENUM ('Ditolak','Diterima','Dalam Proses'); 

CREATE TABLE admin(
    id_admin varchar(255) primary key,
    username varchar(255),
    password varchar(255),
    email varchar(255),
    last_login timestamp,
    created_at timestamp  default current_timestamp,
    updated_at timestamp,
    is_active is_active default '1',
    id_level id_level default '1'
);

CREATE TABLE member (
    id_member varchar(255) primary key,
    username varchar(255),
    password varchar(255),
    email varchar(255),
    no_hp varchar(255),
    bank_code varchar(255),
    nama_akunbank varchar(255),
    foto varchar(255),
    last_login timestamp,
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    is_active is_active default '1',
    id_level id_level default '3'
);

CREATE TABLE infoLogin (
    otw
);

CREATE TABLE hewan(
    id_hewan varchar(255) primary key,
    id_member varchar(255),
    nama_hewan varchar(255),
    jenis_hewan jenis_hewan,
    tanggal_lahir date,
    berat int,
    jenis_kelaminh jenis_kelaminh,
    vaksinasi vaksinasi,
    steril steril,
    kemampuan_khusus text,
    biaya_ganti int,
    foto varchar(255),
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    is_active is_active default '1',
    constraint fk_member foreign key(id_member) references member(id_member)
);


CREATE TABLE adopsi(
    id_adopsi varchar(255) primary key,
    id_hewan varchar(255),
    id_member_pemilik varchar(255),
    id_member_calon varchar(255),
    status_adopsi status_adopsi default 'Menunggu Diterima',
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    is_active is_active,
    alasan varchar(255),
    harga_diterima int,
    dibatalkan_oleh varchar(255),
    constraint fk_hewan foreign key(id_hewan) references hewan(id_hewan),
    constraint fk_member_pemilik foreign key(id_member_pemilik) references member(id_member),
    constraint fk_member_calon foreign key(id_member_calon) references member(id_member),
    constraint fk_member_dibatalkan foreign key(dibatalkan_oleh) references member(id_member)
);

CREATE TABLE transaksi(
    id_transaksi varchar(255) primary key,
    id_adopsi varchar(255),
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    is_active is_active default '1',
    status_transaksi status_transaksi,
    constraint fk_adopsi foreign key(id_adopsi) references adopsi(id_adopsi)
);

CREATE TABLE dana_cair(
    id_dana varchar(255) primary key, /* id dari disbursement */
    id_pemilik_hewan varchar(255),
    nominal int,
    status status_transaksi,
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    is_active is_active default '1',
    constraint fk_member_pemilik foreign key(id_pemilik_hewan) references member(id_member)
);

CREATE TABLE rating(
    id_rating varchar(255) primary key,
    id_member varchar(255),
    id_member_pemberi varchar(255),
    id_adopsi varchar(255),
    nilai int,
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    is_active is_active default '1',
    constraint fk_member foreign key(id_member) references member(id_member),
    constraint fk_member_pemberi foreign key(id_member_pemberi) references member(id_member),
    constraint fk_adopsi foreign key(id_adopsi) references adopsi(id_adopsi)
);

CREATE TABLE verifikasi(
    id_verifikasi varchar(255) primary key,
    id_admin varchar(255),
    id_member varchar(255),
    nama_lengkap varchar(255),
    alamat_ktp varchar(255),
    tanggal_lahir date,
    profesi varchar(255),
    jum_penghuni_rumah varchar(255),
    bersedia_vaksinasi_rutin varchar(255),
    bersedia_steril varchar(255),
    status_tempat_tinggal varchar(255),
    persetujuan_penghuni_rumah varchar(255),
    pernah_adopsi varchar(255),
    alasan_adopsi_lagi varchar(255),
    foto_rumah varchar(255),
    foto_rumah2 varchar(255),
    foto_dirirumah varchar(255),
    foto_kandang varchar (255),
    created_at timestamp default current_timestamp,
    updated_at timestamp,
    status_verifikasi status_verifikasi default 'Dalam Proses',
    constraint fk_admin foreign key (id_admin) references admin(id_admin),
    constraint fk_member foreign key (id_member) references member(id_member)
);

