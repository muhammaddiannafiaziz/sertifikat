<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        @page {
            size: A4 landscape;
            /* Ukuran kertas A4 landscape */
            margin: 0;
            /* Hapus margin default */
        }

        body {
            margin: 0;
            padding: 0;
            width: 297mm;
            height: 210mm;
            font-family: Arial, sans-serif;
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/bg.png"))) }}') no-repeat center center;
            background-size: cover;
            /* Gambar memenuhi seluruh halaman */
        }

        .content {
            text-align: center;
            color: #000;
            /* Warna teks hitam */
            padding: 10mm 20mm;
            position: relative;
        }

        .details {
            font-size: 18px;
            /* margin-bottom: 20mm; */
            line-height: 0.5;
            text-align: left;
            margin-left: 85mm;
            margin-top: 95mm;
            /* Penurunan posisi dengan margin top */
        }

        .qr-code {
            position: absolute;
            bottom: 10mm;
            left: 10mm;
            margin-left: 100mm;
            margin-bottom: 20mm;
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
    <div class="content">
        <!-- Nama, Program Studi, dan NIM Section -->
        <div class="mt-8 details">
            <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
            <p><strong>Program Studi:</strong> {{ $sertifikat->mahasiswa->program_studi }}</p>
            <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim }}</p>
        </div>

        <!-- QR Code Section -->
        <div class="qr-code">
            <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
        </div>
    </div>
</body>

</html>