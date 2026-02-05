<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Arsip</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; }
        
        /* KOP SURAT */
        .header { width: 100%; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header td { vertical-align: middle; }
        .logo { width: 90px; height: auto; }
        .text-center { text-align: center; }
        .instansi-utama { font-size: 14px; font-weight: bold; }
        .instansi-balai { font-size: 16px; font-weight: bold; margin: 5px 0; }
        .alamat { font-size: 10px; font-style: italic; }

        /* TABEL DATA */
        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th, table.data td { border: 1px solid #000; padding: 6px; }
        table.data th { background-color: #f0f0f0; text-align: center; font-weight: bold; }
        
        /* TANDA TANGAN */
        .signature { width: 100%; margin-top: 50px; }
        .signature-box { width: 250px; float: right; text-align: center; }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ public_path('images/logo.png') }}" class="logo">
            </td>
            <td width="85%" class="text-center">
                <div class="instansi-utama">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</div>
                <div class="instansi-utama">DIREKTORAT JENDERAL BINA MARGA</div>
                <div class="instansi-balai">BALAI PELAKSANAAN JALAN NASIONAL KALIMANTAN SELATAN</div>
                <div class="alamat">
                    Jl. Brigjen H. Hasan Basri No. 12, Banjarmasin, Kalimantan Selatan - 70123<br>
                    Telepon: (0511) 3304036 | Email: bpjn.kalsel@pu.go.id
                </div>
            </td>
        </tr>
    </table>

    <div class="text-center" style="margin-bottom: 20px;">
        <h3 style="margin: 0; text-transform: uppercase; text-decoration: underline;">LAPORAN REKAPITULASI ARSIP {{ str_replace('_', ' ', $kategori) }}</h3>
        <p style="margin: 5px 0;">Tahun Anggaran: {{ $tahun == 'semua' ? 'Semua Tahun' : $tahun }}</p>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">No. Dokumen</th>
                <th>Perihal / Nama Dokumen</th>
                @if($kategori == 'pembayaran' || $kategori == 'kontrak')
                    <th width="15%">Nominal</th>
                @endif
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d/m/Y') }}</td>
                    <td>{{ $item->nomor_dokumen }}</td>
                    <td>
                        {{ $item->nama_dokumen }}
                        @if($kategori == 'perjalanan_dinas')
                            <br><small><i>Tujuan: {{ $item->lokasi_tujuan }}</i></small>
                        @endif
                    </td>
                    @if($kategori == 'pembayaran' || $kategori == 'kontrak')
                        <td style="text-align: right;">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    @endif
                    <td class="text-center" style="text-transform: uppercase;">{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            <p>Banjarmasin, {{ date('d F Y') }}</p>
            <p>Mengetahui,<br>Kepala Subbagian Tata Usaha</p>
            <br><br><br><br> <p style="font-weight: bold; text-decoration: underline;">(NAMA PEJABAT)</p>
            <p>NIP. 198xxxxxx xxxx xxxx</p>
        </div>
    </div>

</body>
</html>