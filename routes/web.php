<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//tidak perlu login start
Route::get('/', 'HomeController@index')->name('index');
Auth::routes();
Route::get('/keahlian/{n_keahlian}', 'HomeController@pengajars')->name('daftar.pengajar');
Route::get('/cara-pemesanan', 'HomeController@howto')->name('how.to');

// harus login, bisa diakses semua
Route::get('/side', 'NavigationController@side')->name('side');

Route::get('/dashboard', 'NavigationController@dashboard')->name('dashboard');
// profil tidak bisa diakses admin
Route::get('/profil', 'NavigationController@profil')->name('Profil');
Route::any('/profil/cari', 'NavigationController@cari')->name('Profil.Cari');
Route::get('/edit/profil/{id}', 'NavigationController@eprofile')->name('Form.E-Profil');
Route::put('/update/profil/{email}', 'ProfilController@update')->name('Ubah.Profil');
Route::post('/update/status/{email}', 'ProfilController@statusAjar')->name('Ubah.Status');
Route::put('/update/avatar/{email}', 'ProfilController@avatar')->name('Ubah.Avatar');
Route::put('/update/pass/{email}', 'ProfilController@PassChange')->name('Ubah.Password');
Route::post('/update/jadwal/{id}', 'ProfilController@ChangeJadwal')->name('Ubah.Jadwal');

// Profil Admin
// Route::get('/profil', 'NavigationController@profil_admin')->name('Profil.admin');

// data keahlian
Route::get('/dt-keahlian', 'NavigationController@keahlians')->name('Data.Keahlian');
Route::post('/create/dt-keahlian', 'KeahlianController@store')->name('Tambah.Keahlian');
Route::put('/update/dt-keahlian/{id_keahlian}', 'KeahlianController@update')->name('Ubah.Keahlian');
Route::delete('/delete/dt-keahlian/{id_keahlian}', 'KeahlianController@destroy')->name('Hapus.Keahlian');

// Route::get('/create/keahlian', 'NavigationController@tambahKeahlian')->name('Tambah.Keahlian');
// Hanya Bisa Diakses Super Admin
    // data admin
    Route::get('/dt-admin', 'NavigationController@adminss')->name('Data.Admin');
    Route::post('/create/dt-admin', 'AdminController@store')->name('Tambah.Admin');
    Route::put('/update/dt-admin/{id}', 'AdminController@update')->name('Ubah.Admin');
    Route::delete('/delete/dt-admin/{id}', 'AdminController@destroy')->name('Hapus.Admin');

// booking
Route::any('/create/pesan/{id_pengajar}', 'TransactionController@booking')->name('book.guru');

// list booking pengajar
Route::get('/dt-booking', 'NavigationController@listBooking')->name('Data.Booking');
Route::post('/create/dt-booking/{id_client}/{id_booking}', 'TransactionController@konfirmasi')->name('Konfirmasi.Booking');
Route::get('/history', 'NavigationController@history')->name('history');

// riwayat pemesanan client
Route::get('/transaksi/pending', 'NavigationController@TransPending')->name('trans.pending');
Route::get('/transaksi/belajar', 'NavigationController@TransBelajar')->name('trans.belajar');
Route::get('/transaksi/ditolak', 'NavigationController@TransDitolak')->name('trans.ditolak');
Route::get('/transaksi/diterima', 'NavigationController@TransDiterima')->name('trans.diterima');
Route::put('/upload/transaksi/{id_trans}', 'TransactionController@upload')->name('upload.bukti');
Route::delete('/delete/transaksi/{id}', 'TransactionController@destroyHistory')->name('Hapus.Transaksi.History');

//Data Transaksi Admin
Route::get('/dt-transaksi/proses', 'NavigationController@dt_trans_proses')->name('trans.data.proc');
Route::get('/dt-transaksi', 'NavigationController@dt_trans_all')->name('trans.data.all');
Route::get('/dt-transaksi/pending', 'NavigationController@dt_trans')->name('trans.data.konf');
Route::get('/dt-transaksi/finish', 'NavigationController@dt_trans_finish')->name('trans.data.finish');
Route::put('/update/dt-trans/{id_trans}', 'TransactionController@update_stat')->name('update.stat');


//Halaman Pertemuan pengajar & admin
Route::get('/pertemuan/{id_trans}', 'NavigationController@pertemuan')->name('pertemuan.pengajar');
Route::put('/update/pertemuan/{id_pertemuan}', 'PertemuanController@update_pertemuan')->name('update.pertemuan');
Route::put('/update/pertemuan/admin/{id_pertemuan}', 'PertemuanController@update_pertemuan_admin')->name('update.pertemuan.admin');

//halaman pertemuan client
Route::get('/dt-pertemuan/{id_trans}', 'NavigationController@dt_pertemuan')->name('pertemuan.client');
Route::put('/update/pertemuan/client/{id_pertemuan}', 'PertemuanController@update_pertemuan_client')->name('update.pertemuan.client');

// halaman laporan transaksi
Route::get('/laporan/transaksi', 'NavigationController@laporan_trans')->name('laporan.trans');
Route::post('/laporan/search', 'TransactionController@laporan_search')->name('laporan.search');
Route::post('/laporan/download', 'TransactionController@PDFTrans')->name('laporan.PDF');