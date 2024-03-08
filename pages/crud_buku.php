<?php
include '../function/config.php';

if (isset($_POST['btnSimpan'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $nama_rak = $_POST['nama_rak'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $ukuranFile = $_FILES['gambar']['size'];
    $namaFile = $_FILES['gambar']['name'];
    $dir = '../assets/img/sampul/';
    $random = rand();
    $tmpFile = $_FILES['gambar']['tmp_name'];
    if ($ukuranFile < 1088779) {
        move_uploaded_file($tmpFile, $dir . $random . '_' . $namaFile);
        $gambar = $random . '_' . $namaFile;
        $simpan = mysqli_query($koneksi, "INSERT INTO buku (id_buku, id_kategori, id_rak, judul, penulis, penerbit, tahun, gambar) VALUES (NULL, '$nama_kategori', '$nama_rak', '$judul', '$penulis', '$penerbit', '$tahun', '$gambar')");
        echo "<script>alert('Data buku berhasil disimpan'); document.location='kelola_buku.php';</script>";
    } else {
        echo "<script>alert('ukuran gambar terlalu besar'); document.location='kelola_buku.php';</script>";

    }
}

if (isset($_POST['btnUbah'])) {
    $id = $_POST['id'];
    $nama_kategori = $_POST['nama_kategori'];
    $nama_rak = $_POST['nama_rak'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $ukuranFile = $_FILES['gambar']['size'];
    $namaFile = $_FILES['gambar']['name'];
    $dir = '../asset/img/sampul';
    $random = rand();
    $tmpFile = $_FILES['gambar']['tmp_name'];
    $gambarLama = $_POST['gambarLama'];

    if ($namaFile === "") {
        $query = mysqli_query($koneksi, "UPDATE buku SET id_kategori = '$nama_kategori', id_rak = '$nama_rak', judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun = '$tahun', gambar = '$gambarLama' WHERE id = '$id'");
        echo "<script>alert('Data buku berhasil diubah'); document.location='kelola_buku.php';</script>";
    } else {
        $data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
        $ambil = mysqli_fetch_assoc($data);
        unlink('../asset/img/sampul/' . $ambil['gambar']);

        move_uploaded_file($tmpFile, $dir . $random . '_' . $namaFile);
        $gambar = $random . '_' . $namaFile;
        $query = mysqli_query($koneksi, "UPDATE buku SET id_kategori = '$nama_kategori', id_rak = '$nama_rak', judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun = '$tahun', gambar = '$gambar' WHERE id = '$id'");
        echo "<script>alert('Data buku berhasil diubah'); document.location='kelola_buku.php';</script>";
    }
}

if (isset($_POST['btnHapus'])) {
    $id = $_POST['id_buku'];
    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
    $ambil = mysqli_fetch_assoc($query);
    unlink('../assets/img/sampul/' . $ambil['gambar']);
    $hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id'");
    if ($hapus) {
        echo "<script>alert('Data buku berhasil dihapus'); document.location='kelola_buku.php';</script>";
    } else {
        echo "<script>alert('Data buku gagal dihapus'); document.location='kelola_buku.php';</script>";
    }
}
