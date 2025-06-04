<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Pendaftaran UPC</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border: 1px solid #ddd; padding: 30px; border-radius: 8px;">
        <h2 style="color: #333;">Halo Peserta UPC,</h2>
        <p>Terima kasih telah mendaftar dalam kegiatan lomba kami.</p>

        <p>Berikut adalah <strong>password</strong> yang dapat digunakan untuk login atau keperluan selanjutnya:</p>

        <div style="background-color: #f1f1f1; padding: 15px; border-radius: 5px; text-align: center; font-size: 18px; font-weight: bold;">
            {{ $password }}
        </div>

        <p style="margin-top: 30px;">Jangan membagikan password ini kepada orang lain.</p>

        <p>Salam, <br><strong>Panitia UPC</strong></p>
    </div>
</body>
</html>
