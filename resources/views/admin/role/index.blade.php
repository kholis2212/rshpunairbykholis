<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Role</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Daftar Role</h1>
    <table>
        <thead>
            <tr>
                <th>ID Role</th>
                <th>Nama Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($role as $item)
            <tr>
                <td>{{ $item->idrole }}</td>
                <td>{{ $item->nama_role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>