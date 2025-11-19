<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat SKL Komputer</title>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .page { width: 297mm; height: 210mm; position: relative; }
        
        /* Backgrounds */
        .bg-komputer {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklkomputer.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        .content { text-align: center; color: #000; padding: 20mm; position: relative; }
        .details { font-size: 18px; line-height: 0.5; text-align: left; margin-left: 25mm; margin-top: 70mm; }
        .qr-code { position: absolute; bottom: 10mm; left: 10mm; margin-left: 240mm; margin-bottom: 150mm; width: 100px; height: 100px; }
        .qr-code img { width: 100%; height: 100%; }
    </style>
</head>
<body>
    @if($data->word || $data->excel || $data->power_point)
        <div class="page bg-komputer">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $data->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $data->mhsTipd->mahasiswa->nama }}</p>
                    <p><strong>NIM:</strong> {{ $data->mhsTipd->mahasiswa->nim }}</p>
                    <br>
                    <p><strong>SKL KOMPUTER</strong></p>
                    <p>Nilai Word: <strong>{{ $data->word ?? '-' }}</strong></p>
                    <p>Nilai Excel: <strong>{{ $data->excel ?? '-' }}</strong></p>
                    <p>Nilai Power Point: <strong>{{ $data->power_point ?? '-' }}</strong></p>
                </div>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    @endif
</body>
</html>