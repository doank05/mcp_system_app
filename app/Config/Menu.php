<?php

namespace Config;

class Menu
{
    public static function get()
    {
        return [
            [
                'label' => 'Dashboard',
                'icon'  => '📊',
                'url'   => '/dashboard',
                'level' => [1,2,3,4],
            ],

            /*
            |--------------------------------------------------------------------------
            | MAINTENANCE
            |--------------------------------------------------------------------------
            | Admin (1)
            | Supervisor (2) -> CRUD pekerjaan
            | Operator (3)
            | Viewer (4) -> lihat saja (index)
            */
            [
                'label' => 'Maintenance',
                'icon'  => '🛠',
                'type'  => 'group',
                'level' => [1,2,3,4],
                'children' => [
                    [
                        'label' => 'Maintenance Umum',
                        'url'   => '/maintenance-non-engine',
                        'level' => [1,2,3,4],
                    ],
                    [
                        'label' => 'Maintenance Engine',
                        'url'   => '/maintenance-engine',
                        'level' => [1,3],
                    ],
                ]
            ],

            /*
            |--------------------------------------------------------------------------
            | PRODUKSI
            |--------------------------------------------------------------------------
            | Admin (1)
            | Operator (3)
            */
            [
                'label' => 'Produksi',
                'icon'  => '⚡',
                'url'   => '/produksi',
                'level' => [1,3],
            ],

            /*
            |--------------------------------------------------------------------------
            | INVENTORY
            |--------------------------------------------------------------------------
            | Admin (1)
            | Operator (3)
            | Viewer (4) -> lihat data
            */
            [
                'label' => 'Inventory',
                'icon'  => '📦',
                'type'  => 'group',
                'level' => [1,3,4],
                'children' => [
                    [
                        'label' => 'Data Barang',
                        'url'   => '/barang',
                        'level' => [1,3],
                    ],
                    [
                        'label' => 'Pemakaian Engine',
                        'url'   => '/data-engine',
                        'level' => [1,3],
                    ],
                ]
            ],

            /*
            |--------------------------------------------------------------------------
            | BUDGET
            |--------------------------------------------------------------------------
            | Admin (1)
            */
            [
                'label' => 'Budget',
                'icon'  => '📦',
                'type'  => 'group',
                'level' => [1],
                'children' => [
                    [
                        'label' => 'Budget',
                        'url'   => '/budget',
                        'level' => [1],
                    ],
                ]
            ],

            /*
            |--------------------------------------------------------------------------
            | KARYAWAN
            |--------------------------------------------------------------------------
            | Admin (1)
            */
            [
                'label' => 'Data Karyawan',
                'icon'  => '👤',
                'url'   => '/karyawan',
                'level' => [1],
            ],

            /*
            |--------------------------------------------------------------------------
            | TAHUN AKTIF
            |--------------------------------------------------------------------------
            | Admin (1)
            */
            [
                'label' => 'Pengaturan Tahun Aktif',
                'icon'  => '🗓',
                'url'   => '/tahun-aktif',
                'level' => [1],
            ],

        ];
    }
}
