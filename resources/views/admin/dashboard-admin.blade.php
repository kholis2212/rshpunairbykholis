<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Administrator</h1>
    <p>Selamat datang, Admin! Anda dapat melihat semua data master.</p>
    <h2>Jenis Hewan</h2>
    <table border="1">
        <thead><tr><th>ID</th><th>Nama</th></tr></thead>
        <tbody>@foreach($jenisHewan as $item)<tr><td>{{ $item->idjenis_hewan }}</td><td>{{ $item->nama_jenis_hewan }}</td></tr>@endforeach</tbody>
    </table>
    <!-- Tambahkan table serupa untuk rasHewan, kategori, dll. (sama seperti view di Modul 9) -->
    <a href="{{ route('logout') }}">Logout</a>
</body>
</html>