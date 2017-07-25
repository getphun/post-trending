# post-trending

Post trending ( from google analytics ) counter. Modul ini menerima beberapa konfigurasi
aplikasi tentang kalkulasi trending dan popular post.

```php
<?php
return [
    'name' => 'Phun',
    ...
    
    'post-trending' => [
        'trending' => [
            'last_days'     => 3,
            'total_items'   => 15
        ],
        'popular' => [
            'time_start'    => '2005-01-01',
            'total_items'   => 15
        ]
    ]
];
```

Keterangan opsi-opsi tersebut adalah:

1. trending  Menyimpan semua konfigurasi untuk perhitungan trending
    1. last_days  Total hari kebelakang yang digunakan untuk perhitungan
    1. total_items  Total post yang akan disimpan.
1. popular  Menyimpan semua konfigurasi untuk perhitungan popular post
    1. time_start  Tanggal pertama google analytics di install. Tanggal tidak boleh kurang dari 2005-01-01.
    1. selebihnya sama dengan konfigurasi trending.

## cronjob

Agar proses perhitungan bisa berjalan dengan baik, pastikan Anda menambahkan cron
yang memanggil `curl HOST/post/-/trending` setiap jam 2 malam agar
trending/popular post terupdate.