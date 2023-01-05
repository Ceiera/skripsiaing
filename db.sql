CREATE TYPE is_active as ENUM('0','1');
CREATE TYPE jenis_hewan as ENUM('Kucing', 'Anjing');
CREATE TYPE jenis_kelaminh as ENUM('Jantan', 'Betina');
CREATE TYPE vaksinasi as ENUM('0','1');
CREATE TYPE steril as ENUM('0','1');
CREATE TYPE status_adopsi as ENUM('Menunggu Calon','Menunggu Pembayaran','Berhasil','Gagal');
CREATE TYPE status_transaksi as ENUM('Menunggu','Berhasil','Dibatalkan','Selesai');

CREATE TABLE admin(
    id_admin varchar(255) primary key,
    nama_admin varchar(255),
    password varchar(255),
    login_at timestamp,
    created_at timestamp,
    updated_at timestamp,
    is_active is_active
);

CREATE TABLE member (
    id_member varchar(255) primary key,
    username varchar(255),
    password varchar(255),
    email varchar(255) UNIQUE,
    no_hp varchar(255) UNIQUE,
    created_at timestamp,
    updated_at timestamp,
    login_at timestamp,
    is_active is_active
);

CREATE TABLE hewan(
    id_hewan varchar(255) primary key,
    id_member varchar(255),
    nama_hewan varchar(255),
    jenis_hewan jenis_hewan,
    tanggal_lahir date,
    created_at timestamp,
    updated_at timestamp,
    is_active is_active,
    constraint fk_member foreign key(id_member) references member(id_member)
);

CREATE TABLE detail_hewan(
    id_detail_hewan varchar(255) primary key,
    id_hewan varchar(255),
    berat int,
    jenis_kelaminh jenis_kelaminh,
    vaksinasi vaksinasi,
    steril steril,
    kemampuan_khusus text,
    biaya_ganti int,
    created_at timestamp,
    updated_at timestamp,
    is_active is_active,
    constraint fk_hewan foreign key(id_hewan) references hewan(id_hewan)
);

CREATE TABLE adopsi(
    id_adopsi varchar(255) primary key,
    id_hewan varchar(255),
    id_member_pemilik varchar(255),
    id_member_calon varchar(255),
    status_adopsi status_adopsi,
    created_at timestamp,
    updated_at timestamp,
    is_active is_active,
    constraint fk_hewan foreign key(id_hewan) references hewan(id_hewan),
    constraint fk_member_pemilik foreign key(id_member_pemilik) references member(id_member),
    constraint fk_member_calon foreign key(id_member_calon) references member(id_member)
);

CREATE TABLE transaksi(
    id_transaksi varchar(255) primary key,
    id_adopsi varchar(255),
    created_at timestamp,
    updated_at timestamp,
    is_active is_active,
    status_transaksi status_transaksi,
    constraint fk_adopsi foreign key(id_adopsi) references adopsi(id_adopsi)
);

CREATE TABLE dana_cair(
    id_dana varchar(255) primary key,
    id_admin varchar(255),
    id_pemilik_hewan varchar(255),
    nominal int,
    bukti varchar(255),
    status status_transaksi,
    created_at timestamp,
    updated_at timestamp,
    is_active is_active,
    constraint fk_admin foreign key(id_admin) references admin(id_admin),
    constraint fk_member_pemilik foreign key(id_pemilik_hewan) references member(id_member)
);

CREATE TABLE rating(
    id_rating varchar(255) primary key,
    id_member varchar(255),
    id_member_pemberi varchar(255),
    id_transaksi varchar(255),
    nilai int,
    created_at timestamp,
    updated_at timestamp,
    is_active is_active,
    constraint fk_member foreign key(id_member) references member(id_member),
    constraint fk_member_pemberi foreign key(id_member_pemberi) references member(id_member),
    constraint fk_transaksi foreign key(id_transaksi) references transaksi(id_transaksi)
);