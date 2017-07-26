# post-trending

Post trending ( from google analytics ) counter. Modul ini menerima beberapa konfigurasi
aplikasi tentang kalkulasi trending post.

```php
<?php
return [
    'name' => 'Phun',
    ...
    
    'post-trending' => [
        'last_days'     => 3,
        'total_items'   => 15
    ]
];
```

Keterangan opsi-opsi tersebut adalah:

1. last_days  Total hari kebelakang yang digunakan untuk perhitungan
1. total_items  Total post yang akan disimpan.

## cronjob

Agar proses perhitungan bisa berjalan dengan baik, pastikan Anda menambahkan cron
yang memanggil `curl HOST/post/-/trending` setiap jam 2 malam agar
trending post terupdate.