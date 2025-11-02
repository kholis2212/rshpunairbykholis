<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik</title>
</head>
<body>
    <h1>Dashboard Pemilik</h1>
    <p>Data Pet Anda</p>
    <table border="1">
        <thead><tr><th>ID</th><th>Nama</th><th>Ras</th></tr></thead>
        <tbody>@foreach($pet as $item)<tr><td>{{ $item->idpet }}</td><td>{{ $item->nama }}</td><td>{{ $item->rasHewan->nama_ras ?? 'N/A' }}</td></tr>@endforeach</tbody>
    </table>
    <a href="{{ route('logout') }}">Logout</a>
</body>
</html>