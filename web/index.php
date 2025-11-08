<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tes Proyek Sertifikat</title>
    <style>body { font-family: sans-serif; display: grid; place-items: center; min-height: 90vh; background: #f4f4f4; }</style>
</head>
<body>
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <h1>🚀 Proyek Sertifikat Berhasil!</h1>
        <p>Skema 1 (Fast Iteration) berfungsi dengan baik.</p>
        
        <h3>Tes PHP & Ekstensi</h3>
        <ul>
            <li>Versi PHP: <?php echo phpversion(); ?></li>
            <li>Ekstensi 'pdo_mysql': <?php echo extension_loaded('pdo_mysql') ? '✅ Terinstal' : '❌ Gagal'; ?></li>
            <li>Ekstensi 'gd': <?php echo extension_loaded('gd') ? '✅ Terinstal' : '❌ Gagal'; ?></li>
        </ul>

        <h3>Tes Koneksi Database</h3>
        <?php
            // Nama service 'db' dari docker-compose.yml
            $host = 'db'; 
            $db   = 'db_sertifikat';
            $user = 'user_sertifikat';
            $pass = 'password_rahasia'; // Ganti dengan password Anda

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                echo '<p style="color: green;">✅ Berhasil terhubung ke database <strong>' . $db . '</strong></p>';
            } catch (\PDOException $e) {
                echo '<p style="color: red;">❌ Gagal terhubung ke database: ' . $e->getMessage() . '</p>';
            }
        ?>
    </div>
</body>
</html>