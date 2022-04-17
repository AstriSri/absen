<?php
// use Illuminate\Support\Facades\Route;

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
//AUTENTICATION
Auth::routes();

// Route::get('/', 'UserController@index')->name('index');
Route::get('/', 'HomeController@loginadmin');

// Route::get('admin', 'HomeController@loginadmin');
Route::post('adminlogin', 'HomeController@adminlogin');
Route::get('logoutadmin', 'HomeController@logoutadmin')->name('logout.admin');

Route::get('{id}/dosen_hapus', 'DeleteController@dosen_hapus');
Route::get('{id}/dosen_riwayatgolongan_hapus', 'DeleteController@dosen_riwayatgolongan_hapus');
Route::get('{id}/dosen_riwayatjabatan_hapus', 'DeleteController@dosen_riwayatjabatan_hapus');
Route::get('{id}/dosen_riwayatpendidikan_hapus', 'DeleteController@dosen_riwayatpendidikan_hapus');
Route::get('{id}/{stat}/dokumen_hapus', 'DeleteController@dokumen_hapus');




Route::get('get-kota-list/', 'DataWilayahController@getKota')->name('kota.index');
Route::get('get-district-list', 'DataWilayahController@getDistrik')->name('distrik.index');
Route::get('get-desa-list', 'DataWilayahController@getDesa')->name('desa.index');

Route::get('test', 'ViewController@test');

Route::get('biodata', 'UserController@biodata');
Route::get('{id}/{stat}/dokumen_view', 'ViewController@dokumen_view');
Route::get('{foto2}/display_foto', 'ViewController@display_foto');

Route::middleware(['auth'])->group(function () {
    Route::prefix("admin")->group(function() {
        //HAK AKSES ADMIN
        Route::middleware(['level:100'])->group(function () {
            Route::resource('role', 'RoleController')->except(["create"]);
            Route::resource('userrole', 'UserRoleController')->except(["create"]);
            Route::get("laporan/absensi", "AdminController@laporanAbsensi")->name("laporan.absensi");
            Route::post("laporan/absensi/{pegawai}/show", "AdminController@laporanAbsensiDetail");

            //MANIPULASI AKUN
            Route::get('dataakun/cari', 'AdminController@caridataakun');
            Route::post('dataakun', 'AdminController@dataakun');
            Route::get('tambahakun', 'AdminController@tambahakun');
            Route::post('simpanakun', 'AdminController@simpanakun');
            Route::get('edit/{id}/akun', 'AdminController@editakun');
            Route::post('{id}/updateakun', 'AdminController@updateakun');
            Route::get('{id}/hapusakun', 'AdminController@hapusakun');
        });
        //HAK AKSES ADMIN DAN KEPEGAWAIAN
        Route::middleware(['level:100,10'])->group(function () {
            //MASTER DATA
            Route::resource('agama', 'AgamaController')->except(["create"]);
            Route::resource('divisi', 'DivisiController')->except(["create"]);
            Route::resource('dosen-homebase', 'DosenHomebaseController')->except(["create"]);
            Route::resource('golongan', 'GolonganController')->except(["create"]);
            Route::resource('goldar', 'GolonganDarahController')->except(["create"]);
            Route::resource('jabatan', 'JabatanController')->except(["create"]);
            Route::resource('jabatan-fungsional', 'JabatanFungsionalController')->except(["create"]);
            Route::resource('jeniskelamin', 'JenisKelaminController')->except(["create"]);
            Route::resource('kewarganegaraan', 'KewarganegaraanController')->except(["create"]);
            Route::resource('pendidikan', 'PendidikanController')->except(["create"]);
            Route::resource('statuskerja', 'StatusKerjaController')->except(["create"]);
            Route::resource('statusdosen', 'StatusDosenController')->except(["create"]);
            Route::resource('statusaktifdosen', 'StatusAktifDosenController')->except(["create"]);
            Route::resource('statuspegawai', 'StatusPegawaiController')->except(["create"]);
            Route::resource('jam-kerja', 'Jam_kerjaController')->shallow();
            Route::resource('jam-kerja-pegawai', 'Jam_kerja_pegawaiController')->shallow();
            //PEGAWAI
            Route::resource('pegawai', 'PegawaiController')->shallow();
            Route::resource('pegawai.riwayat-golongan', 'Riwayat\PegawaiRiwayatGolonganController')->except(["index"]);
            Route::resource('pegawai.riwayat-jabatan', 'Riwayat\PegawaiRiwayatJabatanController')->except(["index"]);
            Route::resource('pegawai.riwayat-pendidikan', 'Riwayat\PegawaiRiwayatPendidikanController')->except(["index"]);
            Route::resource('pegawai.dokumen', 'PegawaiDokumenController')->except(["index"]);
            Route::post('pegawai/{id}/update/foto', 'PegawaiController@updateFoto')->name("admin.pegawai.foto.update");
            Route::post('pegawai/biodata/{id}', 'PegawaiController@createBiodata')->name("pegawai.biodata.create");
            Route::put('pegawai/biodata/{id}', 'PegawaiController@updateBiodata')->name("pegawai.biodata.update");
            Route::post('pegawai/search', 'PegawaiController@search')->name("admin.search.nama.pegawai");
            Route::get('pegawai/{id}/filter/{column}', 'PegawaiController@filter')->name("admin.filter.column.pegawai");
            //DOSEN
            Route::resource('dosen', 'DosenController')->shallow();
            Route::resource('dosen.riwayat-golongan', 'Riwayat\DosenRiwayatGolonganController')->except(["index"]);
            Route::resource('dosen.riwayat-jabatan', 'Riwayat\DosenRiwayatJabatanController')->except(["index"]);
            Route::resource('dosen.riwayat-pendidikan', 'Riwayat\DosenRiwayatPendidikanController')->except(["index"]);
            Route::resource('dosen.dokumen', 'DosenDokumenController')->except(["index"]);
            Route::post('dosen/{id}/update/foto', 'DosenController@updateFoto')->name("admin.dosen.foto.update");
            Route::post('dosen/biodata/{id}', 'DosenController@createBiodata')->name("dosen.biodata.create");
            Route::put('dosen/biodata/{id}', 'DosenController@updateBiodata')->name("dosen.biodata.update");
            Route::post('dosen/search', 'DosenController@search')->name("admin.search.nama.dosen");
            Route::get('dosen/{id}/filter/{column}', 'DosenController@filter')->name("admin.filter.column.dosen");
            
            Route::get('/', 'AdminController@adminhome')->name("dashboard");
            // Route::get('profil', 'UserController@profil');

            Route::get('trash/{model}/index','AdminController@trash');
            Route::put('{model}/{id}/restore','AdminController@restore');
            Route::delete('{model}/{id}/delete_per','AdminController@force_delete');
            //IDCARD DOSEN
            Route::get("dosen/{id}/idcard/show", "DosenController@idCardShow");
            Route::get("idcard/dosen", "DosenController@idCardIndex")->name("idcard.dosen.index");
            Route::post("idcard/dosen/cetak", "DosenController@idCardCetak")->name("cetakIdcardDosen");
            //ID CARD PEGAWAI
            Route::get("pegawai/{id}/idcard/show", "PegawaiController@idCardShow");
            Route::get("idcard/pegawai", "PegawaiController@idCardIndex")->name("idcard.pegawai.index");
            Route::post("idcard/pegawai/cetak", "PegawaiController@idCardCetak")->name("cetakIdcardPegawai");

        });
    });
    //HAK AKSES DOSEN DAN PEGAWAI
    Route::middleware(['level:5,7'])->group(function () {
        Route::get('userhome', 'UserController@userhome')->name('dashboarduser');
        Route::get('user', 'UserController@profil')->name("profil");
        
        Route::post('user/{id}/update/foto', 'UserController@updateFoto')->name("user.foto.update");
        Route::put('user/{id}/update/biodata', 'UserController@updateBiodata')->name("user.biodata.update");
        
        Route::resource('riwayat-golongan', 'Riwayat\RiwayatGolonganController')->except(["index"]);
        Route::resource('riwayat-jabatan-dosen', 'Riwayat\RiwayatJabatanDosenController')->except(["index"]);
        Route::resource('riwayat-pendidikan', 'Riwayat\RiwayatPendidikanController')->except(["index"]);
        Route::resource('dokumen', 'DokumenController')->except(["index"]);
    });
    //HAK AKSES PEGAWAI
    Route::middleware(['level:5'])->group(function () {
        Route::get("user/idcard/pegawai", "UserController@idCardPegawai");
        Route::resource('riwayat-jabatan-pegawai', 'Riwayat\RiwayatJabatanPegawaiController')->except(["index"]);
        
        Route::resource('pegawai/absensi', "AbsensiController")->shallow();
        Route::get('pegawai/absensi/laporan/show', "AbsensiController@showLaporan");
        Route::resource('pegawai/kegiatan', "KegiatanController")->shallow();
        Route::post('pegawai/absensi/jam-kerja/update', "Jam_kerja_pegawaiController@userUpdate")->name("user.jam-kerja.update");
        Route::post('pegawai/absensi/presensi/datang', "AbsensiController@presensiDatang")->name("user.presensi.datang");
        Route::post('pegawai/absensi/presensi/pulang', "AbsensiController@presensiPulang")->name("user.presensi.pulang");
        
    });
    //HAK AKSES DOSEN
    Route::middleware(['level:7'])->group(function () {
        Route::get("user/idcard/dosen", "UserController@idCardDosen");
    });


    Route::get('gantipassword', 'GantiPasswordController@gantipassword');
    Route::post('simpanpassword', 'GantiPasswordController@simpanpassword');
});



