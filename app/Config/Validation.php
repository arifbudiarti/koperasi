<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    //visite marketing
    public $register = [
        'username'     => 'required',
        'password'     => 'required',
        'name'     => 'required',
        'nik'     => 'required',
        'email'     => 'required',
        'no_hp'     => 'required',
        'alamat'     => 'required'
    ];

    public $register_errors = [
        'username' => [
            'required'    => 'Data Register username Required.',
        ],
        'password' => [
            'required'    => 'Data Register Password Required.',
        ],
        'name' => [
            'required'    => 'Data Register nama Required.',
        ],
        'nik' => [
            'required'    => 'Data Register NIK Required.',
        ],
        'email' => [
            'required'    => 'Data Register Email Required.',
        ],
        'no_hp' => [
            'required'    => 'Data Register Email Required.',
        ],
        'alamat' => [
            'required'    => 'Data Register Alamat Required.',
        ]
    ];

    //visite marketing
    public $authlogin = [
        'username'     => 'required',
        'password'     => 'required'
    ];

    public $authlogin_errors = [
        'username' => [
            'required'    => 'Data Register username Required.',
        ],
        'password' => [
            'required'    => 'Data Register Password Required.',
        ]
    ];

    //visite marketing
    public $simpanadd = [
        'tgl_transaksi'     => 'required',
        'id_anggota'     => 'required|is_natural_no_zero',
        'nominal'     => 'required'
    ];

    public $simpanadd_errors = [
        'tgl_transaksi' => [
            'required'    => 'Data Simpanan tgl transaksi Required.',
        ],
        'id_anggota' => [
            'required'    => 'Data Anggota Required.',
        ],
        'nominal' => [
            'required'    => 'Data Simpanan nominal Required.',
        ]
    ];


    //visite marketing
    public $pinjamadd = [
        'tgl_peminjaman'     => 'required',
        'bunga'     => 'required',
        'kredit'     => 'required',
        'id_anggota'     => 'required|is_natural_no_zero',
        'pokok_peminjaman'     => 'required',
        'pokok_bunga'     => 'required',
        'pokok_cicilan'     => 'required',
        'total_cicilan'     => 'required',
        'total_peminjaman'     => 'required'
    ];

    public $pinjamadd_errors = [
        'tgl_peminjaman' => [
            'required'    => 'Data Peminjaman tgl transaksi Required.',
        ],
        'bunga' => [
            'required'    => 'Data Peminjaman Bunga Required.',
        ],
        'kredit' => [
            'required'    => 'Data Peminjaman jumlah kredit Required.',
        ],
        'id_anggota' => [
            'required'    => 'Data Peminjaman anggota Required.',
        ],
        'pokok_peminjaman' => [
            'required'    => 'Data Peminjaman pokok Required.',
        ],
        'pokok_bunga' => [
            'required'    => 'Data Peminjaman Required.',
        ],
        'pokok_cicilan' => [
            'required'    => 'Data Peminjaman Required.',
        ],
        'total_cicilan' => [
            'required'    => 'Data Peminjaman Required.',
        ],
        'total_peminjaman' => [
            'required'    => 'Data Peminjaman Required.',
        ]
    ];

    //visite marketing
    public $useradd = [
        'id_anggota'     => 'required|is_natural_no_zero',
        'password'     => 'required',
        'username'     => 'required'
    ];

    public $useradd_errors = [
        'id_anggota' => [
            'required'    => 'Data Anggota tgl transaksi Required.',
        ],
        'password' => [
            'required'    => 'Data Password tgl transaksi Required.',
        ],
        'username' => [
            'required'    => 'Data Username nominal Required.',
        ]
    ];
    //visite marketing
    public $anggota = [
        'jenis_kelamin'     => 'required',
        'nama'     => 'required',
        'nik'     => 'required',
        'email'     => 'required',
        'no_hp'     => 'required',
        'alamat'     => 'required'
    ];

    public $anggota_errors = [
        'jenis_kelamin' => [
            'required'    => 'Data Register JK Required.',
        ],
        'name' => [
            'required'    => 'Data Register nama Required.',
        ],
        'nik' => [
            'required'    => 'Data Register NIK Required.',
        ],
        'email' => [
            'required'    => 'Data Register Email Required.',
        ],
        'no_hp' => [
            'required'    => 'Data Register Email Required.',
        ],
        'alamat' => [
            'required'    => 'Data Register Alamat Required.',
        ]
    ];
    //visite marketing
    public $petugas = [
        'id_anggota'     => 'required|is_natural_no_zero',
        'tmt'     => 'required',
    ];

    public $petugas_errors = [
        'id_anggota' => [
            'required'    => 'Data Anggota tgl transaksi Required.',
        ],
        'tmt' => [
            'required'    => 'Data tmt tgl transaksi Required.',
        ]
    ];
    //visite marketing
    public $bayar = [
        'id_anggota'     => 'required|is_natural_no_zero',
        'id_pinjam'     => 'required',
        'kredit'     => 'required',
        'nominal'     => 'required',
        'saldo'     => 'required',
        'sisa'     => 'required'
    ];

    public $bayar_errors = [
        'id_anggota' => [
            'required'    => 'Data Register JK Required.',
        ],
        'id_pinjam' => [
            'required'    => 'Data Register nama Required.',
        ],
        'kredit' => [
            'required'    => 'Data Register NIK Required.',
        ],
        'nominal' => [
            'required'    => 'Data Register Email Required.',
        ],
        'saldo' => [
            'required'    => 'Data Register Email Required.',
        ],
        'sisa' => [
            'required'    => 'Data Register Alamat Required.',
        ]
    ];
}
