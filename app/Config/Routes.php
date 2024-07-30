<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('login', 'User::index');
$routes->get('logout', 'User::logout');
$routes->get('register', 'User::register');
$routes->add('auth', 'User::create');
$routes->add('authcheck', 'User::authcheck');
$routes->add('register/(:segment)/edit', 'User::edit/$1');
$routes->get('register/(:segment)/delete', 'User::delete/$1');

//admin
$routes->get('dashboard', 'Home::index');
$routes->get('simpan', 'Transaksi::simpan');
$routes->add('simpan/new', 'Transaksi::simpancreate');
// $routes->add('simpan/add', 'Transaksi::simpanadd');
$routes->add('simpan/(:segment)/edit', 'Transaksi::simpanedit/$1');
$routes->get('simpan/(:segment)/delete', 'Transaksi::simpandelete/$1');
$routes->get('simpan/(:segment)/detail', 'Transaksi::simpandetail/$1');
//pinjam
$routes->get('pinjam', 'Transaksi::pinjam');
$routes->add('pinjam/new', 'Transaksi::pinjamcreate');
$routes->add('pinjam/(:segment)/accept', 'Transaksi::pinjamacc/$1');
$routes->add('pinjam/(:segment)/decline', 'Transaksi::pinjamdec/$1');
// $routes->add('simpan/add', 'Transaksi::simpanadd');
$routes->add('pinjam/(:segment)/edit', 'Transaksi::pinjamedit/$1');
$routes->get('pinjam/(:segment)/delete', 'Transaksi::pinjamdelete/$1');
$routes->get('pinjam/(:segment)/detail', 'Transaksi::pinjamdetail/$1');
//bayar
$routes->get('bayar', 'Transaksi::bayar');
$routes->add('bayar/(:segment)/(:segment)/new', 'Transaksi::bayarcreate/$1/$2');
// $routes->add('simpan/add', 'Transaksi::simpanadd');
$routes->add('bayar/(:segment)/edit', 'Transaksi::bayaredit/$1');
$routes->get('bayar/(:segment)/delete', 'Transaksi::bayardelete/$1');
// $routes->get('bayar/(:segment)/detail', 'Transaksi::bayardetail/$1');
$routes->get('bayar/(:segment)/(:segment)/detail', 'Transaksi::bayardetail/$1/$2');

//admin
$routes->get('users', 'User::list');
$routes->add('users/new', 'User::usercreate');
$routes->add('users/(:segment)/edit', 'User::useredit/$1');
$routes->get('users/(:segment)/delete', 'User::userdelete/$1');
$routes->get('anggota', 'User::anggota');
$routes->add('anggota/new', 'User::anggotacreate');
$routes->add('anggota/(:segment)/edit', 'User::anggotaedit/$1');
$routes->get('anggota/(:segment)/delete', 'User::anggotadelete/$1');
$routes->get('petugas', 'User::petugas');
$routes->add('petugas/new', 'User::petugascreate');
$routes->add('petugas/(:segment)/edit', 'User::petugasedit/$1');
$routes->get('petugas/(:segment)/delete', 'User::petugasdelete/$1');



//anggota
