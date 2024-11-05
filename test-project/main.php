<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghitung Nilai Rapor Siswa</title>
</head>
<body>

<h2>Formulir Input Nilai Siswa</h2>
<form method="POST">
    <label for="name">Nama Siswa:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="nilai_harian">Nilai Harian:</label>
    <input type="number" id="nilai_harian" name="nilai_harian" required><br><br>

    <label for="nilai_pts">Nilai PTS:</label>
    <input type="number" id="nilai_pts" name="nilai_pts" required><br><br>

    <label for="nilai_pat">Nilai PAT:</label>
    <input type="number" id="nilai_pat" name="nilai_pat" required><br><br>

    <button type="submit">Hitung dan Tambah Data</button>
</form>

<!-- Tombol untuk menghapus semua data -->
<form method="POST" style="margin-top: 20px;">
    <button type="submit" name="clear" value="true">Clear Data</button>
</form>

<h3>Daftar Nilai Rapor Siswa:</h3>

<?php
// Mulai sesi untuk menyimpan data antar-pengisian
session_start();

// Cek apakah tombol "Clear Data" ditekan
if (isset($_POST['clear']) && $_POST['clear'] == "true") {
    // Hapus semua data dalam sesi
    unset($_SESSION['data']);
    echo "<p>Data telah dihapus.</p>";
}

// Cek apakah ada data yang dikirim melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['clear'])) {
    // Ambil data input dari form
    $name = htmlspecialchars($_POST['name']);
    $nilai_harian = htmlspecialchars($_POST['nilai_harian']);
    $nilai_pts = htmlspecialchars($_POST['nilai_pts']);
    $nilai_pat = htmlspecialchars($_POST['nilai_pat']);

    // Hitung nilai akhir berdasarkan bobot yang diberikan
    $nilai_akhir = (0.5 * $nilai_harian) + (0.25 * $nilai_pts) + (0.25 * $nilai_pat);

    // Simpan data ke dalam sesi
    $_SESSION['data'][] = [
        'name' => $name,
        'nilai_harian' => $nilai_harian,
        'nilai_pts' => $nilai_pts,
        'nilai_pat' => $nilai_pat,
        'nilai_akhir' => $nilai_akhir
    ];
}

// Tampilkan data nilai siswa yang telah dimasukkan
if (isset($_SESSION['data']) && !empty($_SESSION['data'])) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>Nama Siswa</th>
            <th>Nilai Harian</th>
            <th>Nilai PTS</th>
            <th>Nilai PAT</th>
            <th>Nilai Akhir</th>
          </tr>";
    foreach ($_SESSION['data'] as $entry) {
        echo "<tr>
                <td>{$entry['name']}</td>
                <td>{$entry['nilai_harian']}</td>
                <td>{$entry['nilai_pts']}</td>
                <td>{$entry['nilai_pat']}</td>
                <td>{$entry['nilai_akhir']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Tidak ada data siswa yang tersimpan.</p>";
}
?>

</body>
</html>
