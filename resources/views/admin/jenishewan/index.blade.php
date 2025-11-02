<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jenis Hewan</title>
</head>
<body>
    <h1>Daftar Jenis Hewan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jenis Hewan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisHewan as $item)
            <tr>
                <td>{{ $item->idjenis_hewan }}</td>
                <td>{{ $item->nama_jenis_hewan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>