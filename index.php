<?php
// **********************  1  **************************  
// Inisialisasi variabel untuk menyimpan nilai input dan error
$nama = $email = $nim = $jurusan = $fakultas = "";
$namaErr = $emailErr = $nimErr = $jurusanErr = $fakultasErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // **********************  2  **************************  
    // - Tangkap nilai nama yang ada pada form HTML (Lihat Task 7)
    // - Validasi agar nama tidak boleh kosong
    // - Validasi agar nama hanya berupa abjad (Hint : gunakan fungsi preg_match (atau fungsi lainnya))
    // silakan taruh kode kalian di bawah
    $nama = trim($_POST["nama"]);
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $namaErr = "Nama hanya boleh huruf dan spasi";
    }

    // **********************  3  **************************  
    // - Tangkap nilai email yang ada pada form HTML (Lihat Task 7)
    // - Memeriksa apakah email kosong
    // - Memeriksa apakah format email valid (Hint : gunakan fungsi filter_var)
    // silakan taruh kode kalian di bawah
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    }

    // **********************  4  **************************  
    // - Tangkap nilai NIM yang ada pada form HTML (Lihat Task 7)
    // - Pastikan NIM terisi dan berformat angka
    // - silakan taruh kode kalian di bawah
    $nim = trim($_POST["nim"]);
    if (empty($nim)) {
        $nimErr = "NIM wajib diisi";
    } elseif (!ctype_digit($nim)) {
        $nimErr = "NIM harus berupa angka";
    }

    // **********************  5  **************************  
    // - Tangkap nilai jurusan yang ada pada form HTML (Lihat Task 7)
    // - Validasi agar jurusan tidak boleh kosong
    // - Validasi agar jurusan hanya berupa abjad (Hint : gunakan fungsi preg_match (atau fungsi lainnya))
    // silakan taruh kode kalian di bawah
    $jurusan = trim($_POST["jurusan"]);
    if (empty($jurusan)) {
        $jurusanErr = "Jurusan wajib diisi";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $jurusan)) {
        $jurusanErr = "Jurusan hanya boleh huruf dan spasi";
    }

    // **********************  6  **************************  
    // - Tangkap nilai fakultas yang ada pada form HTML (Lihat Task 7)
    // - Validasi agar fakultas tidak boleh kosong
    // - Validasi agar fakultas hanya berupa abjad (Hint : gunakan fungsi preg_match (atau fungsi lainnya))
    // silakan taruh kode kalian di bawah
    $fakultas = trim($_POST["fakultas"]);
    if (empty($fakultas)) {
        $fakultasErr = "Fakultas wajib diisi";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fakultas)) {
        $fakultasErr = "Fakultas hanya boleh huruf dan spasi";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <img src="logo.png" alt="Logo Kampus" class="logo">
    <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nimErr && !$jurusanErr && !$fakultasErr): ?>
    <div class="alert-success">
        <strong>Berhasil!</strong> Data pendaftaran telah diterima.
    </div>
<?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && ($namaErr || $emailErr || $nimErr || $jurusanErr || $fakultasErr)): ?>
    <div class="alert-danger">
        <strong>Kesalahan!</strong> Harap perbaiki data yang salah.
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <!-- **********************  7  ************************** -->
    <!-- Tambahkan value di tiap form-group/kolom untuk menampilkan kembali data di form setelah submit (retaining input) -->
    <!-- Hint : value pada input form harus berisi variabel yang menyimpan data input -->
        <div class="form-group">
            <label>Nama:</label>
           <input type="text" name="nama" value="<?php echo $nama; ?>">
<?php if ($namaErr): ?>
    <div class="error-text">* <?php echo $namaErr; ?></div>
<?php endif; ?>

        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
<?php if ($emailErr): ?>
    <div class="error-text">* <?php echo $emailErr; ?></div>
<?php endif; ?>

        </div>

        <div class="form-group">
            <label>NIM:</label>
            <input type="text" name="nim" value="<?php echo $nim; ?>">
<?php if ($nimErr): ?>
    <div class="error-text">* <?php echo $nimErr; ?></div>
<?php endif; ?>

        </div>

        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" value="<?php echo $jurusan; ?>">
<?php if ($jurusanErr): ?>
    <div class="error-text">* <?php echo $jurusanErr; ?></div>
<?php endif; ?>

        </div>

        <div class="form-group">
            <label>Fakultas:</label>
           <input type="text" name="fakultas" value="<?php echo $fakultas; ?>">
<?php if ($fakultasErr): ?>
    <div class="error-text">* <?php echo $fakultasErr; ?></div>
<?php endif; ?>

        </div>

        <div class="button-container">
            <button type="submit">Daftar</button>
        </div>
    </form>
</div>

<!-- **********************  8  ************************** -->
<!-- Panggil variabel yang berisi pesan error (Hint : gunakan if dan metode post) -->
<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nimErr && !$jurusanErr && !$fakultasErr): ?>
<div class="container">
    <h3>Data Pendaftaran</h3>

    <!-- **********************  9  ************************** -->
    <!-- Tampilkan data pendaftaran dalam bentuk tabel yang baru saja diinput -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Fakultas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $nama ?></td>
                    <td><?= $email ?></td>
                    <td><?= $nim ?></td>
                    <td><?= $jurusan ?></td>
                    <td><?= $fakultas ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
</body>
</html>
