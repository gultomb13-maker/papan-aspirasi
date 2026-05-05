<!DOCTYPE html>
<html>
<head>
    <title>Papan Aspirasi</title>
</head>
<body>

<h1>Papan Aspirasi Kampus</h1>

@foreach ($aspirations as $aspiration)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <h3>{{ $aspiration->title }}</h3>
        <small>Kategori: {{ $aspiration->category->name }}</small>
        <p>{{ $aspiration->content }}</p>
    </div>
@endforeach

</body>
</html>