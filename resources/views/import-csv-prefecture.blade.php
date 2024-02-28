<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (!empty(session('message')))
        @foreach (session('message') as $message)
            <div class="bg-blue-100 border-blue-500 text-blue-700 border-l-4 p-4 my-2">
                <p>{{ $m }}</p>
            </div>
        @endforeach
    @endif

    <form action="/import-csv-prefecture" method="post" enctype="multipart/form-data">
        @csrf
        <div class="dropArea">
            <input type="file" name="file">
        </div>
        <button type="submit">インポート</button>
    </form>
</body>

</html>

<script>
    const dropArea = document.getElementById('dropFile')


</script>

<style>
    .dropArea {
        width: 500px;
        height: 300px;
        border: 1px dashed
    }

    .dropArea input[type="file"] {
        width: 100px;
        padding: calc(300px / 2) calc( (100% - 100px) / 2 );;
    }
</style>