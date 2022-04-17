<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>
<style>
    @media print {
        @page {
            size: A4 landscape;
            /* DIN A4 standard, Europe */
            margin: 2cm 1cm 1cm 1cm;
        }
        html,
        body {
            display: table;
            width: 330mm;
            /* height: 297mm; */
            height: 200mm;
            font-size: 12pt;
            background: #FFF;
            overflow: visible;
        }
    }

</style>
<body>
    <h1>UNIBA</h1>
    <br>
    <!-- HEADER -->
    <table style="width: 100%;border-collapse: collapse">
        <tbody>
            <tr style="width:100%">
                <td style="width: 10%;">Laporan</td>
                <td style="width: 2%;">:</td>
                <td style="width: 38%;">Kartu Absensi Per Departement</td>
                <td style="width: 10%;">Kode</td>
                <td style="width: 2;">:</td>
                <td style="width: 28%;">51</td>
                <td style="width: 10;"></td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td>{{ reset($months)->isoFormat('DD MMM YYYY') }} s/d {{ end($months)->isoFormat('DD MMM YYYY') }}</td>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $pegawai->namagelar }}</td>
            </tr>
            <tr>
                <td>Dibuat Tgl</td>
                <td>:</td>
                <td>{{ $now->isoFormat("DD MMM YYYY kk:mm") }}</td>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $pegawai->Jabatan->jabatan }} - {{ $pegawai->Divisi->kode }}, YAYASAN</td>
                <td style="float: right">Page 1 of 1</td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="border-top: 1px #000 solid">
                <td>Kriteria</td>
                <td>:</td>
                <td colspan="5"></td>
            </tr>
        </tfoot>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <thead>
            <tr style="text-align: center">
                <td style="border: 1px solid" rowspan="2">No</td>
                <td style="border: 1px solid" rowspan="2">Tanggal</td>
                <td style="border: 1px solid" rowspan="2">Hari</td>
                <td style="border: 1px solid" rowspan="2">Jadwal</td>
                <td style="border: 1px solid" colspan="2">Clock</td>
                <td style="border: 1px solid" rowspan="2">Dat Telat</td>
                <td style="border: 1px solid" rowspan="2">Pul Awl</td>
                <td style="border: 1px solid" colspan="2">Break</td>
                <td style="border: 1px solid" colspan="2">OverTime</td>
                <td style="border: 1px solid" colspan="5">Lama</td>
            </tr>
            <tr style="text-align: center">
                <td style="border: 1px solid">In</td>
                <td style="border: 1px solid">Out</td>
                <td style="border: 1px solid">Out</td>
                <td style="border: 1px solid">In</td>
                <td style="border: 1px solid">In</td>
                <td style="border: 1px solid">Out</td>
                <td style="border: 1px solid">Kerja</td>
                <td style="border: 1px solid">Hadir</td>
                <td style="border: 1px solid">Break</td>
                <td style="border: 1px solid">Lembur</td>
                <td style="border: 1px solid">OverT</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total_waktu_telat = \Carbon\Carbon::parse("00:00");
                $total_waktu_awal = \Carbon\Carbon::parse("00:00");
                $total_telat = 0;
                $total_awal = 0;
                $total_absensi = 0;
            @endphp
          @foreach ($months as $day)
            <tr style="text-align: center">
              <td style="border: 1px grey; border-style: dotted">{{ $loop->iteration }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $day->isoFormat("DD-MMMM-YYYY") }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $day->isoFormat("dddd") }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $pegawai->jam_kerja->jam_datang }} - {{ $pegawai->jam_kerja->jam_pulang }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $absensi->where("tanggal",$day->format("Y-m-d"))->pluck("jam_datang")->first() }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $absensi->where("tanggal",$day->format("Y-m-d"))->pluck("jam_pulang")->first() }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $telat = $absensi->where("tanggal", $day->format("Y-m-d"))->first()->Telat ?? "" }}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $awal = $absensi->where("tanggal", $day->format("Y-m-d"))->first()->Awal ?? "" }}</td>
              <td style="border: 1px grey; border-style: dotted"></td>
              <td style="border: 1px grey; border-style: dotted"></td>
              <td style="border: 1px grey; border-style: dotted"></td>
              <td style="border: 1px grey; border-style: dotted"></td>
              <td style="border: 1px grey; border-style: dotted">{{ $pegawai->jam_kerja->duration ?? ''}}</td>
              <td style="border: 1px grey; border-style: dotted">{{ $isAbsen = $absensi->where("tanggal",$day->format("Y-m-d"))->first()->duration ?? "❌"}}</td>
              <td style="border: 1px grey; border-style: dotted"></td>
              <td style="border: 1px grey; border-style: dotted"></td>
              <td style="border: 1px grey; border-style: dotted"></td>
            </tr>
            @php
                if ($telat != "") {
                    $total_waktu_telat = $total_waktu_telat->addHours(substr($telat, 0,2))->addMinutes(substr($telat, 3,2));
                    $total_telat += 1;
                }
                if ($awal != "") {
                    $total_waktu_awal = $total_waktu_awal->addHours(substr($awal, 0,2))->addMinutes(substr($awal, 3,2));
                    $total_awal += 1;
                }
                if ($isAbsen != "❌") {
                    $total_absensi += 1;
                }
            @endphp
          @endforeach
        </tbody>
        <tfoot>
            <tr style="border-bottom: 1px #000 solid">
                <td></td>
                <td>Total Waktu</td>
                <td>:</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center">{{ $total_waktu_telat->format("H:i") }}</td>
                <td style="text-align: center">{{ $total_waktu_awal->format("H:i") }}</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center">00:00</td>
                <td style="text-align: center">00:00</td>
                <td style="text-align: center"></td>
            </tr>
        </tfoot>
    </table>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 10%; text-align: center">Frekuensi :</td>
                <td style="width: 10%">Absen Hadir</td>
                <td style="width: 2%">:</td>
                <td style="width: 2%">X=</td>
                <td style="width: 2%">{{ round($total_absensi / count($months) *100, 2) }}</td>
                <td style="width: 54%">%</td>
                <td style="width: 20%; text-align: center">{{ $now->isoFormat("DD MMM YYYY kk:mm") }}</td>
            </tr>
            <tr>
                <td rowspan="2"></td>
                <td>Datang Telat</td>
                <td>:</td>
                <td>X=</td>
                <td>{{ round($total_telat / count($months) *100, 2) }}</td>
                <td>%</td>
            </tr>
            <tr>
                <td>Pulang Awal</td>
                <td>:</td>
                <td>X=</td>
                <td>{{ round($total_awal / count($months) *100, 2) }}</td>
                <td>%</td>
                <td style="text-align: center">(&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)</td>
            </tr>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>
