<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat SKL Bahasa</title>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .page { width: 297mm; height: 210mm; position: relative; page-break-after: always; }
        .page:last-child { page-break-after: avoid; }

        /* Backgrounds (sesuai CSS baru Anda) */
        .bg-arab {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklarab.png"))) }}') no-repeat center center;
            background-size: cover;
        }
        .bg-inggris {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklinggris.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        .content { text-align: center; color: #000; padding: 20mm; position: relative; }
        .details { font-size: 18px; line-height: 0.5; text-align: left; margin-left: 25mm; margin-top: 70mm; }
        .qr-code { position: absolute; bottom: 10mm; left: 10mm; margin-left: 240mm; margin-bottom: 150mm; width: 100px; height: 100px; }
        .qr-code img { width: 100%; height: 100%; }
    </style>
</head>
<body>
    @if($data->istima || $data->kitabah || $data->qiraah)
        <div class="page bg-arab">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $data->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $data->mahasiswa->nama }}</p>
                    <p><strong>NIM:</strong> {{ $data->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>SKL BAHASA ARAB</strong></p>
                    <p>Nilai Istima': <strong>{{ $data->istima ?? '-' }}</strong></p>
                    <p>Nilai Kitabah: <strong>{{ $data->kitabah ?? '-' }}</strong></p>
                    <p>Nilai Qira'ah: <strong>{{ $data->qiraah ?? '-' }}</strong></p>
                </div>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif

    @if($data->listening || $data->writing || $data->reading)
        <div class="page bg-inggris">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $data->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $data->mahasiswa->nama }}</p>
                    <p><strong>Program Studi:</strong> {{ $data->mahasiswa->program_studi }}</p>
                    <p><strong>NIM:</strong> {{ $data->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>SKL BAHASA INGGRIS</strong></p>
                    <p>Nilai Listening: <strong>{{ $data->listening ?? '-' }}</strong></p>
                    <p>Nilai Writing: <strong>{{ $data->writing ?? '-' }}</strong></p>
                    <p>Nilai Reading: <strong>{{ $data->reading ?? '-' }}</strong></p>
                </div>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif
</body>
</html>