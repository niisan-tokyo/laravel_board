<html>
<head>
    <meta charset="utf-8"/>
</head>
<body>
    <h1>掲示板のテスト</h1>
    @foreach($boards as $board)
    <h3><a href="/boards/edit/{{ $board->id }}">{{ $board->title }}</a></h3>
    <p>{{ $board->content }}</p>
    @if($board->image)
    <p><img src="/imgs/{{ $board->image }}"></p>
    @endif
    @endforeach

<a href="/boards/new">新規投稿</a>
</body>
</html>
