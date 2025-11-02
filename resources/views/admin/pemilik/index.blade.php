<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemilik</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Daftar Pemilik</h1>
    <table>
        <thead>
            <tr>
                <th>ID Pemilik</th>
                <th>No WA</th>
                <th>Alamat</th>
                <th>Nama User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemilik as $item)
            <tr>
                <td>{{ $item->idpemilik }}</td>
                <td>{{ $item->no_wa }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->user ? $item->user->nama : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>