# Jawaban Tes Debugging SIMRS Mini

Nama: Muhammad Ghilman Fauzan
Tanggal: 04 Nov 2026

Salin blok di bawah untuk setiap bug yang Anda temukan.

## Bug 1

- Gejala: saat mencoba update dokter terdapat error terkait izin http Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
- Lokasi (file:baris): routes/web.php:16 dokter/form.blade.php:19
- Penyebab: Pada routes/web.php, route untuk memperbarui data dokter (dokter.perbarui) menggunakan HTTP method PUT di form cuman POST saja
- Perbaikan: ditambahkan directive @method('PUT') ketika $dokter->exists bernilai true pada resources/views/dokter/form.blade.php


## Bug 2

- Gejala: saat mencoba tambah edit data pasien terdapat error Call to a member function format() on string
- Lokasi (file:baris): pada model/pasien.php:45 dan views/pasien/daftar.blade:65
- Penyebab: terdapat typo penulisan atau ketidak cocokan nama field tgl_lahir dan tanggal_lahir pada view dan di modelnya
- Perbaikan: saya menyamakan nama fieldnya disemua mvc nya menjadi tanggal_lahir sesuai yang ada pada database

## Bug 3

- Gejala: saat mencoba edit data pasien nik nya yang lama tidak bisa diubah dan pesannya nik sudah terdaftar
- Lokasi (file:baris): pada pasienReuest.php
- Penyebab: Karena parameter di route routes/web.php bernama {pasien} (/pasien/{pasien}), variabel $this->id bernilai null. Akibatnya, Laravel tidak mengecualikan ID pasien yang sedang diedit dan menganggap NIK tersebut duplikat.
- Perbaikan: saya menyamakan nama fieldnya disemua mvc nya menjadi tgl_lahir sesuai yang ada pada database


## Bug 4

- Gejala: alamat tidak ke insert dan update pada pasien
- Lokasi (file:baris): model/pasien.php
- Penyebab: parameter alamat tidak tertulis didalam modelnya jadi ngga masuk datanya ke database
- Perbaikan: saya menambahkan field alamat kedalam modelnya

## Bug 5

- Gejala: ketika pasien dihapus data tidak terdelete
- Lokasi (file:baris): routes/web.php:17, controller/pasienController.php:73
- Penyebab: pada routes/web.php, parameter route hapus ditulis /{id} tidak sesuai di pasien comntrolernya
- Perbaikan: pada routes/web.php: Mengubah parameter route dari {id} menjadi {pasien}


## Bug 6

- Gejala: search pasien tidak berfungsi
- Lokasi (file:baris): Controllers/PasienController.php:19
- Penyebab: Pada method daftar() di PasienController, pola pencarian LIKE hanya memiliki wildcard % di awal ("%{$kataKunci}") tanpa % di akhir. Akibatnya, query SQL hanya mencari data yang berakhiran dengan kata kunci tersebut, bukan yang mengandung kata kunci di awal atau di tengah dan dihasil paginasi belum memanggil ->withQueryString(), sehingga saat berpindah halaman paginasi, filter pencarian (?cari=...) hilang.
- Perbaikan: pada Controllers/PasienController.php Menambahkan % di akhir string LIKE menjadi "%{$kataKunci}%" serta menambahkan ->withQueryString() pada fungsi paginasi.