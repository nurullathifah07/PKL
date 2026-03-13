<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $data = [

            ['kode_barang'=>'000025','nama_barang'=>'SPIDOL SNOWMAN 8','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000052','nama_barang'=>'KERTAS F4 80 GSM SIDU','satuan'=>'rim','stok_minimal'=>5],
            ['kode_barang'=>'000102','nama_barang'=>'KERTAS A4 70 GSM SIDU','satuan'=>'rim','stok_minimal'=>5],
            ['kode_barang'=>'000108','nama_barang'=>'REFFIL ISI PENSIL PILOT 0,5 2B','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000149','nama_barang'=>'LAKBAN BENING','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000184','nama_barang'=>'STABILO FEBER CASTILL','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000205','nama_barang'=>'TIPE X KENKO','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000213','nama_barang'=>'PEN KENKO K-1 HITAM','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000224','nama_barang'=>'MAP SNELHECTER PLASTIK','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000235','nama_barang'=>'PENSIL MEKANIK PILOT','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000236','nama_barang'=>'ISI PENSIL MEKANIK PILOT','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000262','nama_barang'=>'POST IT BIG 76x76 mm','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000277','nama_barang'=>'ISI PENSIL MEKANIK FIBER CASTLE 0.7','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000278','nama_barang'=>'POST IT BIG 76X51 mm','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000284','nama_barang'=>'PISAU PERUNCING SP2020','satuan'=>'buah','stok_minimal'=>3],
            ['kode_barang'=>'000286','nama_barang'=>'BALLPOINT SP2020','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000292','nama_barang'=>'BOLPOIN KENKO GELL 0,5mm','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000293','nama_barang'=>'PEN KENKO K-1 BIRU','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000294','nama_barang'=>'MAP BIOLA SNELHECTER','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000295','nama_barang'=>'AMPLOP EXECUTIVE COKLAT B','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000297','nama_barang'=>'AMPLOP EXECUTIVE COKLAT C','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000298','nama_barang'=>'POST IT BIG 76x101 mm','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000299','nama_barang'=>'PENGHAPUS KARET SP2020','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000300','nama_barang'=>'PENSIL 2B SP2020','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000301','nama_barang'=>'PEN FABER CASTLE K7','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000302','nama_barang'=>'POST IT LABEL','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000303','nama_barang'=>'AMPLOP PAPERLINE PPL 90PS','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000304','nama_barang'=>'AMPLOP FOLIO','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000305','nama_barang'=>'AMPLOP 1 2 FOLIO','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000306','nama_barang'=>'MAP LAMINASI & SPOT UV DESIGN 1','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000307','nama_barang'=>'MAP LAMINASI DESIGN 1','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000308','nama_barang'=>'MAP LAMINASI DESIGN 2','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000309','nama_barang'=>'PEN TIZO','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000310','nama_barang'=>'BLOCKNOTE','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000311','nama_barang'=>'SILET PERUNCING','satuan'=>'buah','stok_minimal'=>3],
            ['kode_barang'=>'000312','nama_barang'=>'PENSIL FABER CASTELL 2B','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000313','nama_barang'=>'PULPEN FASTER','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000314','nama_barang'=>'LAKBAN COKLAT','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000315','nama_barang'=>'LAKBAN HITAM','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000316','nama_barang'=>'KERTAS MATTE STICKER EPRINT','satuan'=>'rim','stok_minimal'=>3],
            ['kode_barang'=>'000317','nama_barang'=>'RAUTAN LYRA','satuan'=>'buah','stok_minimal'=>3],
            ['kode_barang'=>'000318','nama_barang'=>'POST IT 51x38','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000319','nama_barang'=>'PENSIL MEKANIK SET','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000320','nama_barang'=>'POST IT 13x16','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000321','nama_barang'=>'POST IT MARK','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000322','nama_barang'=>'PULPEN SNOWMAN V-7','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000323','nama_barang'=>'SERUTAN PENSIL MEJA','satuan'=>'buah','stok_minimal'=>3],
            ['kode_barang'=>'000324','nama_barang'=>'Pulpen Joyko Diamond Merah','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000325','nama_barang'=>'Post It Joyko warna plastik','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000326','nama_barang'=>'Pulpen Boxy Mitsubishi Biru','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000327','nama_barang'=>'AMPLOP PAPERLINE','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000328','nama_barang'=>'LAKBAN KECIL BENING','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000329','nama_barang'=>'ISI STAPLES KANGARO NO.10','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000330','nama_barang'=>'POST IT 102x76','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000331','nama_barang'=>'PENGHAPUS 2B FABER CASTLE','satuan'=>'buah','stok_minimal'=>5],
            ['kode_barang'=>'000332','nama_barang'=>'STICKY HIGHLIGHTER STRIP','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000333','nama_barang'=>'ISI PENSIL MEKANIK FABER CASTELL 2B 0,5','satuan'=>'box','stok_minimal'=>5],
            ['kode_barang'=>'000334','nama_barang'=>'PEN TIZO HITAM','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000335','nama_barang'=>'Pulpen Pilot Balliner','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000336','nama_barang'=>'Balpoin SNLIK','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000337','nama_barang'=>'Sticky Note SNLIK','satuan'=>'box','stok_minimal'=>3],
            ['kode_barang'=>'000338','nama_barang'=>'Pulpen Pilot Balliner Hitam','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000339','nama_barang'=>'Pulpen Pilot Balliner Biru','satuan'=>'buah','stok_minimal'=>10],
            ['kode_barang'=>'000003','nama_barang'=>'TINTA STEMPEL BAK','satuan'=>'buah','stok_minimal'=>2],
            ['kode_barang'=>'000004','nama_barang'=>'TINTA STEMPEL LASE','satuan'=>'buah','stok_minimal'=>2],

        ];

        foreach ($data as $barang) {

            $stok = 0;

            $status = match (true) {
                $stok == 0 => 'habis',
                $stok <= $barang['stok_minimal'] => 'menipis',
                default => 'tersedia',
            };

            Barang::create([
                'kode_barang' => $barang['kode_barang'],
                'nama_barang' => $barang['nama_barang'],
                'satuan' => $barang['satuan'],
                'stok_minimal' => $barang['stok_minimal'],
                'stok' => $stok,
            ]);
        }
    }
}
