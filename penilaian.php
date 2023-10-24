<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'path-to-PHPMailer/Exception.php';
require 'path-to-PHPMailer/PHPMailer.php';
require 'path-to-PHPMailer/SMTP.php';

// Fungsi untuk mengirim email penilaian
function kirimEmailPenilaian($nama, $email, $nilai, $komentar) {
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server email
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Ganti dengan server SMTP yang sesuai
        $mail->SMTPAuth = true;
        $mail->Username = 'cimerasik@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'Kramat019823'; // Ganti dengan kata sandi email Anda
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Penerima email (alamat email Cimerasik)
        $mail->setFrom('cimerasik@gmail.com', 'Cimer Mercon'); // Ganti dengan nama Anda
        $mail->addAddress('cimerasik@gmail.com'); // Ganti dengan alamat email Cimerasik

        // Isi email
        $mail->isHTML(true);
        $mail->Subject = 'Penilaian Makanan';
        $mail->Body = "Nama: $nama<br>Email: $email<br>Nilai: $nilai<br>Komentar: $komentar";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Proses formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nilai = $_POST['nilai'];
    $komentar = $_POST['komentar'];

    // Simpan data penilaian ke database
    // Anda juga bisa menambahkan kode ini di sini jika diperlukan

    // Kirim email penilaian
    if (kirimEmailPenilaian($nama, $email, $nilai, $komentar)) {
        echo "Terima kasih atas penilaian Anda!";
    } else {
        echo "Gagal mengirim penilaian.";
    }
}
?>
