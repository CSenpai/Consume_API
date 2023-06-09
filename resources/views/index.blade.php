<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consume REST API Stundets</title>
</head>
<body>
    <form action="" method="get">
        @csrf
        <input type="text" name="search" placeholder="Cari nama...">
        <button type="submit">Cari</button>
    </form>
    <br>
    <a href="{{route('add')}}">Tambah Data Baru</a>
    @if (Session::get('success'))
        <p style="padding: 5px; background: green; color: white; margin: 10px;">{{Session::get('success')}}</p>
    @endif
    @foreach ($students as $student)
    <ol>
        <li>NIS : {{$student['nis']}}</li>
        <li>Nama : {{$student['nama']}}</li>
        <li>Rombel : {{$student['rombel']}}</li>
        <li>Rayon : {{$student['rayon']}}</li>
        <li>Aksi : <a href="{{route('edit', $student['id'])}}"></a> || Hapus</li>
    </ol>
    @endforeach
</body>
</html>