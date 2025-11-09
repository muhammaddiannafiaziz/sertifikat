<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat SKL Ma'had</title>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .page { width: 297mm; height: 210mm; position: relative; page-break-after: always; }
        .page:last-child { page-break-after: avoid; }

        /* Backgrounds (sesuai file lama Anda) */
        .bg-ibadah {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklibadah.png"))) }}') no-repeat center center;
            background-size: cover;
        }
        .bg-alquran {
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bgsklalquran.png"))) }}') no-repeat center center;
            background-size: cover;
        }

        .content { text-align: center; color: #000; padding: 20mm; position: relative; }
        
        /* Posisi Teks (sesuai file lama Anda) */
        .details {
            font-size: 18px;
            line-height: 0.5;
            text-align: left;
            margin-left: 25mm;
            margin-top: 70mm;
        }

        /* Posisi QR Code (sesuai file lama Anda) */
        .qr-code {
            position: absolute;
            bottom: 10mm;
            left: 10mm;
            margin-left: 240mm;
            margin-bottom: 150mm;
            width: 100px;
            height: 100px;
        }
        .qr-code img { width: 100%; height: 100%; }
    </style>
</head>
<body>
    @if($data->status_ujian_ibadah == 'lulus')
        <div class="page bg-ibadah">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $data->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $data->mahasiswa->nama }}</p>
                    <p><strong>Program Studi:</strong> {{ $data->mahasiswa->program_studi }}</p>
                    <p><strong>NIM:</strong> {{ $data->mahasiswa->nim }}</p>
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

    @if($data->status_ujian_alquran == 'lulus')
        <div class="page bg-alquran">
            <div class="content">
                <div class="details">
                    <p><strong>{{ $data->no_sertifikat }}</strong></p>
                    <br>
                    <p><strong>Nama:</strong> {{ $data->mahasiswa->nama }}</p>
                    <p><strong>Program Studi:</strong> {{ $data->mahasiswa->program_studi }}</p>
                    <p><strong>NIM:</strong> {{ $data->mahasiswa->nim }}</p>
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
</body>
</html>