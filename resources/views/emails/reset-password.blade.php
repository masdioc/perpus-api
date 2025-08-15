<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Baru</title>
</head>

<body>
    <p>Halo {{ $user->name }},</p>
    <p>Password akun Anda telah direset oleh admin.</p>
    <p>Password baru Anda adalah: <strong>{{ $plainPassword }}</strong></p>
    <p>Silakan login dan ubah password Anda setelah masuk.</p>
    <br>
    <p>Salam,</p>
    <p><strong>Admin AppKita</strong></p>
</body>

</html>
