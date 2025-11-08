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
            background: url('data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path("storage/backgrounds/certificate.jpg"))) }}') no-repeat center center;
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

        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5mm;
        }

        .subheading {
            font-size: 18px;
            margin-bottom: 10mm;
        }

        .details {
            font-size: 22px;
            margin-bottom: 20mm;
            line-height: 1.5;
        }

        .table-container {
            margin: 0 auto;
            width: 70%;
            margin-bottom: 15mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: center;
            font-size: 18px;
        }

        .qr-code {
            text-align: right;
            margin-right: 20mm;
            margin-top: 10mm;
        }

        .qr-code img {
            width: 100px;
            height: 100px;
        }

        .signature {
            position: absolute;
            bottom: 15mm;
            width: 100%;
            text-align: center;
        }

        .signature img {
            width: 120px;
            margin-bottom: 5mm;
        }

        .signature p {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="content">
        <!-- Header Section -->
        <h1>SERTIFIKAT</h1>
        <p class="subheading">Nomor Sertifikat: {{ $sertifikat->no_sertifikat }}</p>

        <!-- Nama dan Program Studi Section -->
        <div class="details">
            <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama }}</p>
            <p><strong>Program Studi:</strong> {{ $sertifikat->mahasiswa->program_studi }}</p>
        </div>

        <!-- Tabel Nilai Ujian -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Ujian</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ibadah</td>
                        <td>{{ $sertifikat->nilai_ujian_ibadah }}</td>
                    </tr>
                    <tr>
                        <td>Al-Quran</td>
                        <td>{{ $sertifikat->nilai_ujian_alquran }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- QR Code Section -->
        <div class="qr-code">
            <p><strong>Validasi Sertifikat</strong></p>
            <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
        </div>

        <!-- Signature Section -->
        <div class="signature">
            <p>Kepala UPT Ma'had Al-Jami'ah</p>
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path("storage/signature.png"))) }}" alt="Signature">
            <p>Ahmad Hafidh, M.Ag.</p>
        </div>
    </div>
</body>

</html>