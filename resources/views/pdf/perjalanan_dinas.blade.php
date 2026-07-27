<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Perjalanan Dinas (SPD)</title>
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

        .title { text-align: center; font-weight: bold; text-decoration: underline; font-size: 14pt; margin-bottom: 20px; margin-top: 10px; text-transform: uppercase; }
        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table-data td { padding: 8px; vertical-align: top; }
        .table-data td:first-child { width: 25%; font-weight: bold; }
        .table-data td:nth-child(2) { width: 5%; }
        
        .box-nominal { background-color: #f0f0f0; padding: 10px; font-size: 16pt; font-weight: bold; display: inline-block; border: 1px solid #000; }
        
        .signature-area { width: 100%; margin-top: 50px; }
        .signature-box { width: 40%; float: right; text-align: center; }
        .ttd-digital { padding: 10px; margin: 10px 0; font-size: 9pt; color: #555; }
        
        .page-break { page-break-after: always; }
        .lampiran-title { text-align: center; font-weight: bold; margin-top: 30px; margin-bottom: 20px; background-color: #eee; padding: 10px;}
        .lampiran-container { text-align: center; width: 100%; margin-bottom: 20px; }
        .img-lampiran { width: 75%; max-width: 600px; height: auto; border: 1px solid #ccc; display: block; margin: 0 auto; }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td width="15%" class="text-center">
                @php
                    $logoPath = public_path('images/logo.png');
                    $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
                @endphp
                <img src="{{ $logoBase64 }}" class="logo">
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

    <div class="title">BUKTI PELAKSANAAN PERJALANAN DINAS</div>

    <table class="table-data">
        <tr>
            <td>Nomor Dokumen</td>
            <td>:</td>
            <td>{{ $archive->nomor_dokumen }}</td>
        </tr>
        <tr>
            <td>Tanggal Pelaksanaan</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($archive->tanggal_dokumen)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td>Pegawai Pelaksana</td>
            <td>:</td>
            <td>{{ $archive->user->nama_lengkap ?? '-' }} <br><small>NIP. {{ $archive->user->nip ?? '-' }}</small></td>
        </tr>
        <tr>
            <td>Lokasi Tujuan</td>
            <td>:</td>
            <td><strong>{{ $archive->lokasi_tujuan }}</strong></td>
        </tr>
        <tr>
            <td>Kegiatan / Perihal</td>
            <td>:</td>
            <td>{{ $archive->nama_dokumen }}<br/><small>{{ $archive->deskripsi }}</small></td>
        </tr>
    </table>

    <div class="signature-area">
        <div class="signature-box">
            <p>Disetujui dan Disahkan oleh,<br/><strong>Pimpinan / Pejabat Pembuat Komitmen</strong></p>
            
            <div class="ttd-digital">
                @if(isset($qrBase64))
                    <img src="{{ $qrBase64 }}" style="width: 80px; height: 80px; display: inline-block; margin-bottom: 5px;" alt="QR Code"><br/>
                @endif
                <strong>TANDA TANGAN ELEKTRONIK (TTE)</strong><br/>
                Sistem Informasi Arsip Keuangan<br/>
                <em>Validasi Hash: {{ substr($archive->file_hash, 0, 15) }}...</em><br/>
                Telah dienkripsi pada: {{ date('d/m/Y H:i:s') }}
            </div>
            
            <p><strong>{{ auth()->user()->nama_lengkap ?? 'Ir. Pimpinan Tertinggi, M.T.' }}</strong><br/>
            NIP. {{ auth()->user()->nip ?? '19700101 199503 1 002' }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <!-- LAMPIRAN / BUKTI RAW -->
    @php
        // Cek apakah punya attachments, jika tidak, gunakan file_path sebagai fallback lampiran
        $lampiranFiles = (is_array($archive->attachments) && count($archive->attachments) > 0) 
            ? $archive->attachments 
            : ($archive->file_path ? [$archive->file_path] : []);
    @endphp

    @if(count($lampiranFiles) > 0)
        @foreach($lampiranFiles as $index => $path)
            @php 
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg', 'jpeg', 'png']);
                $absoluteImagePath = storage_path('app/public/' . $path);
                
                $imgBase64 = null;
                if ($isImage && file_exists($absoluteImagePath)) {
                    $imageData = file_get_contents($absoluteImagePath);
                    if ($imageData) {
                        $imgBase64 = 'data:image/' . $ext . ';base64,' . base64_encode($imageData);
                    }
                }
            @endphp
            
            @if($imgBase64)
                <div class="page-break"></div>
                <div class="lampiran-title">LAMPIRAN BUKTI TIKET / PERJALANAN #{{ $index + 1 }}</div>
                <div class="lampiran-container">
                    <img src="{{ $imgBase64 }}" class="img-lampiran" alt="Lampiran">
                </div>
            @endif
        @endforeach
    @endif

</body>
</html>
