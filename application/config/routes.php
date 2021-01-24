<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['berita/(:any)'] = 'berita/index/$1';
$route['default_controller'] = 'Login/Index';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
//route kelola login sistem
$route['member/auth/(:any)/(:any)'] = 'auth/index/$1';
$route['member/login'] = 'Login';
$route['akun/logout'] = 'Logout';
$route['admin'] = 'Admin/Admindashboard';
//route kelola hak akses
$route['admin/has'] = 'Admin/Adminkelolahakakses';
$route['admin/kelhas'] = 'Admin/Adminkelolahakakses/kelola_hak_akses';
$route['admin/tambahhak'] = 'Admin/Adminkelolahakakses/tambah_hak_akses';
$route['admin/hapushak'] = 'Admin/Adminkelolahakakses/hapus_hak_akses';
$route['admin/tambahhaksub'] = 'Admin/Adminkelolahakakses/tambah_hak_akses_sub_menu';
$route['admin/hapushaksub'] = 'Admin/Adminkelolahakakses/hapus_hak_akses_sub_menu';
$route['admin/tambahhaksubsub'] = 'Admin/Adminkelolahakakses/tambah_hak_akses_sub_submenu';
$route['admin/hapushaksubsub'] = 'Admin/Adminkelolahakakses/hapus_hak_akses_sub_submenu';
$route['admin/hakaksesmenu/(:any)/(:any)'] = 'Admin/Adminkelolahakakses/hak_akses_menu/$2/$1';
$route['admin/hakaksessubmenu/(:any)/(:any)'] = 'Admin/Adminkelolahakakses/hak_akses_submenu/$2/$1';
$route['admin/hakaksessubsubmenu/(:any)/(:any)'] = 'Admin/Adminkelolahakakses/hak_akses_sub_submenu/$2/$1';
$route['admin/carirole/(:any)/(:any)'] = 'Admin/Adminkelolahakakses/cari_role/$2/$1';
//Route member Kelola Register
$route['member/register'] = 'Register';
$route['member/register/auth/(:any)/(:any)'] = 'Register/auth/$1';
$route['member/cek/email'] = 'Register/authemail';
$route['member/cek/username'] = 'Register/authusername';
//Route Superadmin kelola Register
$route['admin/register'] = 'Admin/Registeradmin';
$route['admin/register/auth/(:any)/(:any)'] = 'Admin/Registeradmin/auth/$1';
$route['admin/cek/email'] = 'Admin/Registeradmin/authemail';
$route['admin/cek/username'] = 'Admin/Registeradmin/authusername';
//Route profiler
$route['akun/Data_profil'] = 'profil/Data_profil';
$route['akun/update_profil'] = 'profil/Data_profil/update_profil';
$route['akun/update_foto_profil'] = 'profil/Data_profil/update_foto_profil';
$route['akun/user'] = 'profil/Data_profil/user';
//Dashboard
$route['akun/dashboard'] = 'Puris/Dashboard';
//Data member
$route['admin/manajemen_data_user'] = 'Admin/Data_member';
$route['admin/getdatamember'] = 'Admin/Data_member/kelola_data_member';
$route['admin/getdatapaketmember'] = 'Admin/Data_member/kelola_data_paket_member';
$route['admin/getinformanmember'] = 'Admin/Data_member/kelola_biodata_get_informasi';
$route['admin/hapusdatapaketmember'] = 'Admin/Data_member/hapus_data_paket_member';
$route['admin/inputdatapaketmember'] = 'Admin/Data_member/inputpaketmember';
$route['admin/nonaktifdatamember'] = 'Admin/Data_member/nonaktifmember';
$route['admin/data_pri_member'] = 'Admin/Data_member/pri_member';
$route['admin/getbiodata'] = 'Admin/Data_member/getbiodata';
$route['admin/getbiodatabyid'] = 'Admin/Data_member/getbiodatabyid';
//Data keuangan Member
$route['admin/keuangan'] = 'Admin/Keuanganmember';
$route['admin/getkeuangandatamember'] = 'Admin/Keuanganmember/kelola_data_keuangan';
$route['admin/getinvoice'] = 'Admin/Keuanganmember/getinvoice';
$route['admin/getinvoiceall'] = 'Admin/Keuanganmember/getinvoiceall';
$route['admin/getkirimtagihan'] = 'Admin/Keuanganmember/getkirimtagihan';
$route['admin/kirimdatatagihanmember'] = 'Admin/Keuanganmember/kirimdatatagihanmember';
$route['admin/getpembayaran'] = 'Admin/Keuanganmember/kelola_data_pembayaran';
$route['admin/hapustagihan'] = 'Admin/Keuanganmember/hapustagihan';
$route['admin/getkonfirmtagihan'] = 'Admin/Keuanganmember/getkonfirmtagihan';
$route['admin/konfirmasipembayaran'] = 'Admin/Keuanganmember/konfirmasipembayaran';
//Data Paket Bimbel
$route['admin/datapaket'] = 'Admin/Paket';
$route['admin/getpaket'] = 'Admin/Paket/getpaket';
$route['admin/getpaketbyid'] = 'Admin/Paket/getpaketbyid';
$route['admin/editdatapaket'] = 'Admin/Paket/editdatapaket';
$route['admin/hapuspaket'] = 'Admin/Paket/hapuspaket';
$route['admin/editfotopaket'] = 'Admin/Paket/editfotopaket';
$route['admin/inputpaket'] = 'Admin/Paket/inputpaket';
//referal kode 
$route['admin/referal'] = 'Admin/referal';
$route['admin/getreferal'] = 'Admin/referal/getreferal';
$route['admin/getreferalbyid'] = 'Admin/referal/getreferalbyid';
$route['admin/editdatareferal'] = 'Admin/referal/editdatareferal';
$route['admin/hapusreferal'] = 'Admin/referal/hapusreferal';
$route['admin/inputreferal'] = 'Admin/referal/inputreferal';
//notifikasi
$route['admin/notif'] = 'Admin/notifikasi';
$route['admin/getuser'] = 'Admin/notifikasi/getuser';
$route['admin/inputdatanotif'] = 'Admin/notifikasi/inputdatanotif';
$route['notif/notifikasi_pembaruan'] = 'notifikasi/notifikasi/pembaruan';
$route['notif/notifikasi_pengumuman'] = 'notifikasi/notifikasi/pengumuman';
$route['notif/notifikasi_pembayaran'] = 'notifikasi/notifikasi/pembayaran';
$route['notif/getpembaruan'] = 'notifikasi/notifikasi/getpembaruan';
$route['notif/getpengumuman'] = 'notifikasi/notifikasi/getpengumuman';
$route['notif/getpembayaran'] = 'notifikasi/notifikasi/getpembayaran';
$route['notif/lihat'] = 'notifikasi/notifikasi/lihat';
$route['admin/notifikasi_registrasi'] = 'Admin/notifikasi/registrasi';
$route['admin/getregistrasi'] = 'Admin/notifikasi/getregistrasi';

//member dashboard
$route['member'] = 'Member/Memberdashboard';

//chating
$route['chater'] = 'Admin/chating/index';
$route['chater/send'] = 'Admin/chating/send';

//Member pembayaran
$route['member/pembayaran'] = 'Member/Bayar';
$route['member/gettagihan'] = 'Member/Bayar/tagihan';
$route['member/getpembayaran'] = 'Member/Bayar/pembayaran';
$route['member/getrekapitulasi'] = 'Member/Bayar/rekapitulasi';
$route['member/submit'] = 'Member/Bayar/submit';
$route['member/datapembayaran'] = 'Member/Bayar/tampil';
$route['member/getinvoiceall'] = 'Member/Bayar/getinvoiceall';
$route['member/getkonfirmtagihan'] = 'Member/Bayar/getkonfirmtagihan';

//akademik siswa
$route['admin/nilai_siswa'] = 'Admin/Akademik';
$route['admin/nilai_getbyid']= 'Admin/Akademik/nilai_getbyid';
$route['admin/inputnilai'] = 'Admin/Akademik/inputnilai';
$route['admin/hapusnilai'] = 'Admin/Akademik/hapusnilai';

//mapel
$route['admin/kelola_mapel'] = 'Admin/Mapel';
$route['admin/getmapel'] = 'Admin/Mapel/getmapel';
$route['admin/inputmapel'] = 'Admin/Mapel/inputmapel';
$route['admin/mapel_getbyid'] = 'Admin/Mapel/mapel_getbyid';
$route['admin/submiteditmapel'] = 'Admin/Mapel/submiteditmapel';
$route['admin/detailpaketmapel'] = 'Admin/Mapel/detailpaketmapel';
$route['admin/submitaddmapelonpaket'] = 'Admin/Mapel/submitaddmapelonpaket';
$route['admin/hapusmapelonpaket'] = 'Admin/Mapel/hapusmapelonpaket';

//akademik member
$route['member/hasil_belajar'] = 'Member/Akademik';
$route['member/getnilai'] = 'Member/Akademik/getnilai';