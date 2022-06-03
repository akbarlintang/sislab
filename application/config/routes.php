<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profileUpdate'] = "user/profileUpdate";
$route['profileUpdate/(:any)'] = "user/profileUpdate/$1";

//pelanggan
$route['daftarPelanggan'] = 'pelanggan/daftarPelanggan';
$route['daftarPelanggan/(:num)'] = "pelanggan/daftarPelanggan/$1";
$route['tambahPelanggan'] = "pelanggan/tambahPelanggan";
$route['tambahPelangganBaru'] = "pelanggan/tambahPelangganBaru";
$route['editPelangganLama'] = "pelanggan/editPelangganLama";
$route['editPelangganLama/(:num)'] = "pelanggan/editPelangganLama/$1";
$route['editPelanggan'] = "pelanggan/editPelanggan";
$route['deletePelanggan/(:num)'] = "pelanggan/deletePelanggan/$1";

//wadah
$route['daftarWadah'] = 'wadah/daftarWadah';
$route['daftarWadah/(:num)'] = "wadah/daftarWadah/$1";
$route['tambahWadah'] = "wadah/tambahWadah";
$route['tambahWadahBaru'] = "wadah/tambahWadahBaru";
$route['editWadahLama'] = "wadah/editWadahLama";
$route['editWadahLama/(:num)'] = "wadah/editWadahLama/$1";
$route['editWadah'] = "wadah/editWadah";
$route['deleteWadah/(:num)'] = "wadah/deleteWadah/$1";

//bentuk
$route['daftarBentuk'] = 'bentuk/daftarBentuk';
$route['daftarBentuk/(:num)'] = "bentuk/daftarBentuk/$1";
$route['tambahBentuk'] = "bentuk/tambahBentuk";
$route['tambahBentukBaru'] = "bentuk/tambahBentukBaru";
$route['editBentukLama'] = "bentuk/editBentukLama";
$route['editBentukLama/(:num)'] = "bentuk/editBentukLama/$1";
$route['editBentuk'] = "bentuk/editBentuk";
$route['deleteBentuk/(:num)'] = "bentuk/deleteBentuk/$1";

//pegawai
$route['daftarPegawai'] = 'pegawai/daftarPegawai';
$route['daftarPegawai/(:num)'] = "pegawai/daftarPegawai/$1";
$route['tambahPegawai'] = "pegawai/tambahPegawai";
$route['tambahPegawaiBaru'] = "pegawai/tambahPegawaiBaru";
$route['editPegawaiLama'] = "pegawai/editPegawaiLama";
$route['editPegawaiLama/(:num)'] = "pegawai/editPegawaiLama/$1";
$route['editPegawai'] = "pegawai/editPegawai";
$route['deletePegawai/(:num)'] = "pegawai/deletePegawai/$1";

//trader
$route['daftarTrader'] = 'trader/daftarTrader';
$route['daftarTrader/(:num)'] = "trader/daftarTrader/$1";
$route['tambahTrader'] = "trader/tambahTrader";
$route['tambahTraderBaru'] = "trader/tambahTraderBaru";
$route['editTraderLama'] = "trader/editTraderLama";
$route['editTraderLama/(:num)'] = "trader/editTraderLama/$1";
$route['editTrader'] = "trader/editTrader";
$route['deleteTrader/(:num)'] = "trader/deleteTrader/$1";

//ikan
$route['daftarIkan'] = 'ikan/daftarIkan';
$route['daftarIkan/(:num)'] = "ikan/daftarIkan/$1";
$route['tambahIkan'] = "ikan/tambahIkan";
$route['tambahIkanBaru'] = "ikan/tambahIkanBaru";
$route['editIkanLama'] = "ikan/editIkanLama";
$route['editIkanLama/(:num)'] = "ikan/editIkanLama/$1";
$route['editIkan'] = "ikan/editIkan";
$route['deleteIkan/(:num)'] = "ikan/deleteIkan/$1";

//Kode_asal
$route['daftarKode_asal'] = 'kode_asal/daftarKode_asal';
$route['daftarKode_asal/(:num)'] = "kode_asal/daftarKode_asal/$1";
$route['tambahKode_asal'] = "kode_asal/tambahKode_asal";
$route['tambahKode_asalBaru'] = "kode_asal/tambahKode_asalBaru";
$route['editKode_asalLama'] = "kode_asal/editKode_asalLama";
$route['editKode_asalLama/(:num)'] = "kode_asal/editKode_asalLama/$1";
$route['editKode_asal'] = "kode_asal/editKode_asal";
$route['deleteKode_asal/(:num)'] = "kode_asal/deleteKode_asal/$1";

//Permintaan Uji
$route['daftarPermintaan_uji'] = 'permintaan_uji/daftarPermintaan_uji';
$route['daftarPermintaan_uji/(:num)'] = "permintaan_uji/daftarPermintaan_uji/$1";
$route['tambahPermintaan_uji'] = "permintaan_uji/tambahPermintaan_uji";
$route['tambahPermintaan_ujiBaru'] = "permintaan_uji/tambahPermintaan_ujiBaru";
$route['editPermintaan_ujiLama'] = "permintaan_uji/editPermintaan_ujiLama";
$route['editPermintaan_ujiLama/(:num)'] = "permintaan_uji/editPermintaan_ujiLama/$1";
$route['editPermintaan_uji'] = "permintaan_uji/editPermintaan_uji";
$route['deletePermintaan_uji/(:num)'] = "permintaan_uji/deletePermintaan_uji/$1";

$route['update_detail_fppc'] = "Permohonanlab/update_detail_fppc";

$route['edit_Fppc'] = "Permohonanlab/edit_Fppc";

$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['changePassword/(:any)'] = "user/changePassword/$1";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

//panelis
$route['daftarPanelis'] = 'panelis/daftarPanelis';
$route['daftarPanelis/(:num)'] = "panelis/daftarPanelis/$1";
$route['tambahPanelis'] = "panelis/tambahPanelis";
$route['tambahPanelisBaru'] = "panelis/tambahPanelisBaru";
$route['editPanelisLama'] = "panelis/editPanelisLama";
$route['editPanelisLama/(:num)'] = "panelis/editPanelisLama/$1";
$route['editPanelis'] = "panelis/editPanelis";
$route['deletePanelis/(:num)'] = "panelis/deletePanelis/$1";

//organoleptik
$route['daftarOrganoleptik'] = 'organoleptik/daftarOrganoleptik';
$route['daftarOrganoleptik/(:num)'] = "organoleptik/daftarOrganoleptik/$1";
$route['tambahOrganoleptik'] = "organoleptik/tambahOrganoleptik";
$route['tambahOrganoleptikBaru'] = "organoleptik/tambahOrganoleptikBaru";
$route['editOrganoleptikLama'] = "organoleptik/editOrganoleptikLama";
$route['editOrganoleptikLama/(:any)'] = "organoleptik/editOrganoleptikLama/$1";
$route['editOrganoleptik'] = "organoleptik/editOrganoleptik";
$route['deleteOrganoleptik/(:num)'] = "organoleptik/deleteOrganoleptik/$1";

//LHUS
$route['daftarLHUS'] = 'laporan_hasil/daftarLaporan_hasil';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
