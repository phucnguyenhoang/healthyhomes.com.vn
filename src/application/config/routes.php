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
$route['default_controller'] = 'Pages';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Public product routes */
$route['san-pham-khac'] = 'Product/index';
$route['san-pham-khac/([a-z0-9\-]+)\.html'] = 'Product/detail/$1';

/* Admin product routes */
$route['admin/products'] = 'Products/index';
$route['admin/products/create'] = 'Products/create';
$route['admin/products/upload-image'] = 'Products/uploadImage';
$route['admin/products/delete-image/(:num)'] = 'Products/deleteImage/$1';
$route['admin/products/edit/(:num)'] = 'Products/edit/$1';
$route['admin/products/delete/(:num)'] = 'Products/delete/$1';

$route['san-pham'] = 'Pages/product';
$route['san-pham/cach-thuc-van-hanh'] = 'Pages/howToWork';
$route['san-pham/cach-thuc-mua-hang'] = 'Pages/howToBuy';
$route['san-pham/dung-cu'] = 'Pages/tool';

$route['gioi-thieu/gioi-thieu-ve-chung-toi'] = 'Pages/aboutUs';
$route['gioi-thieu/lich-su-thanh-lap'] = 'Pages/history';
$route['gioi-thieu/chung-thuc-tu-khach-hang'] = 'Pages/customerFeed';

$route['chung-nhan/giay-chung-nhan'] = 'Pages/certification';
$route['chung-nhan/nguoi-noi-tieng'] = 'Pages/starMember';
$route['chung-nhan/nguoi-noi-tieng/(:num)'] = 'Pages/starMemberDetail/$1';

$route['ho-tro'] = 'Pages/support';
$route['ho-tro/khach-hang-chu-y'] = 'Pages/customerWarning';
$route['ho-tro/videos'] = 'Pages/videos';
$route['ho-tro/huong-dan-su-dung'] = 'Pages/userManual';
$route['ho-tro/nhung-meo-lam-sach'] = 'Pages/cleaningTip';
$route['ho-tro/nhung-cau-hoi-thuong-gap'] = 'Pages/friendlyQA';
$route['ho-tro/du-lieu-tham-khao'] = 'Pages/dataSheet';
$route['ho-tro/dat-mua-phu-kien'] = 'Pages/supplies';
$route['ho-tro/lien-he-chung-toi'] = 'Pages/contactUs';

$route['yeu-cau-dung-thu-tai-nha'] = 'Pages/requestDemo';

$route['khach-hang'] = 'Pages/customers';

/* Migration runner */
$route['migrate'] = 'Migrate/index';

/* Admin module */
$route['admin/login'] = 'Admin/login';
$route['admin/logout'] = 'Admin/logout';
$route['admin/dashboard'] = 'Admin/dashboard';
$route['admin/reset-password'] = 'Admin/resetPassword';
$route['admin/change-password'] = 'Admin/changePassword';
$route['admin'] = 'Admin/index';
$route['admin/blogs'] = 'Blogs/index';
$route['admin/blogs/create'] = 'Blogs/create';
$route['admin/blogs/upload-image'] = 'Blogs/uploadImage';
$route['admin/blogs/edit/(:num)'] = 'Blogs/edit/$1';
$route['admin/blogs/view/(:num)'] = 'Blogs/view/$1';
$route['admin/blogs/delete/(:num)'] = 'Blogs/delete/$1';

/* Public blog routes */
$route['bai-viet'] = 'Blog/index';
$route['bai-viet/([a-z0-9\-]+)\.html'] = 'Blog/detail/$1';
$route['bai-viet/(:any)'] = 'Blog/byTag/$1';

$route['blogs'] = 'pages/blogs';
$route['blogs/(:any)'] = 'pages/blogView/$1';

/** Router for activities */
$route['admin/activities'] = 'blogs/indexActivity';
$route['admin/activities/create'] = 'blogs/createActivity';
$route['admin/activities/edit/(:num)'] = 'blogs/editActivity/$1';
$route['admin/activities/view/(:num)'] = 'blogs/viewActivity/$1';
$route['admin/activities/delete/(:num)'] = 'blogs/deleteActivity/$1';
$route['hoat-dong'] = 'pages/activities';
$route['hoat-dong/(:any)'] = 'pages/activityView/$1';

/* Router for Free gifts */
$route['admin/gifts'] = 'gifts/index';
$route['admin/gifts/create'] = 'gifts/create';
$route['admin/gifts/edit/(:num)'] = 'gifts/edit/$1';
$route['admin/gifts/delete/(:num)'] = 'gifts/delete/$1';

$route['submit-request-demo'] = 'FormSubmit/requestDemo';
$route['submit-contact-us'] = 'FormSubmit/contactUs';