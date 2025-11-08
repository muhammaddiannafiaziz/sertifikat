<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .page {
            width: 297mm;
            height: 210mm;
            position: relative;
            /* Halaman baru akan dimulai di halaman baru */
            page-break-after: always;
        }

        /* Memastikan halaman terakhir tidak ada page-break */
        .page:last-child {
            page-break-after: avoid;
        }

        .bg-ibadah {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklibadah.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        .bg-alquran {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklalquran.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        /* =================================== */
        /* ==     CSS BARU ANDA DITAMBAHKAN   == */
        /* =================================== */
        .bg-arab {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklarab.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        .bg-inggris {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklinggris.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        .bg-komputer {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklkomputer.png"))) }}') no-repeat center center;
            background-size: cover;
        }
        /* =================================== */
        /* ==     CSS BARU ANDA SELESAI       == */
        /* =================================== */


        .content {
            text-align: center;
            color: #000;
            padding: 20mm;
            position: relative;
        }

        /* Class .details ini sekarang dipakai oleh SEMUA halaman */
        .details {
            font-size: 18px;
            line-height: 0.5; /* Sesuai kode asli Anda */
            text-align: left;
            margin-left: 25mm;
            margin-top: 70mm;
        }

        .qr-code {
            position: absolute;
            bottom: 10mm;
            left: 10mm;
            margin-left: 240mm;
            margin-bottom: 150mm;
            width: 100px;
            height: 100px;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    @if($sertifikat->status_ujian_ibadah == 'lulus')
        <div class="page bg-ibadah">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $sertifikat->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
                    <p><strong>Program Studi:</strong> {{ $sertifikat->mahasiswa->program_studi }}</p>
                    <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>DINYATAKAN LULUS</strong></p>
                    <p>TES SKL IBADAH UIN RADEN MAS SAID SURAKARTA</p>
                </div>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif

    @if($sertifikat->status_ujian_alquran == 'lulus')
        <div class="page bg-alquran">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $sertifikat->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
                    <p><strong>Program Studi:</strong> {{ $sertifikat->mahasiswa->program_studi }}</p>
                    <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>DINYATAKAN LULUS</strong></p>
                    <p>TES SKL ALQUR'AN UIN RADEN MAS SAID SURAKARTA</p>
                </div>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif

    @if($sertifikat->istima)
        <div class="page bg-arab">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $sertifikat->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
                    <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>SKL BAHASA ARAB</strong></p>
                    <p>Nilai Istima': <strong>{{ $sertifikat->istima }}</strong></p>
                    <p>Nilai Kitabah: <strong>{{ $sertifikat->kitabah }}</strong></p>
                    <p>Nilai Qira'ah: <strong>{{ $sertifikat->qiraah }}</strong></p>
                </div>

                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif

    @if($sertifikat->listening)
        <div class="page bg-inggris">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $sertifikat->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
                    <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>SKL BAHASA INGGRIS</strong></p>
                    <p>Nilai Listening: <strong>{{ $sertifikat->listening }}</strong></p>
                    <p>Nilai Writing: <strong>{{ $sertifikat->writing }}</strong></p>
                    <p>Nilai Reading: <strong>{{ $sertifikat->reading }}</strong></p>
                </div>
                
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif

    @if($sertifikat->word)
        <div class="page bg-komputer">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $sertifikat->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
                    <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>SKL KOMPUTER</strong></p>
                    <p>Nilai Word: <strong>{{ $sertifikat->word }}</strong></p>
                    <p>Nilai Excel: <strong>{{ $sertifikat->excel }}</strong></p>
                    <p>Nilai Power Point: <strong>{{ $sertifikat->power_point }}</strong></p>
                </div>
                
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif

</body>

</html>