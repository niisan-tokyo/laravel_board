<html>
<head>
    <meta charset="utf-8"/>
</head>
<body>
    <h1>掲示板の修正</h1>
    @include('common.errors')
    <form action="/boards/update" method="post" enctype="multipart/form-data" >
        {!! csrf_field() !!}
        タイトル<input type="text" name="title" value="{{ $board->title }}"><br>
        本文<textarea name="content" value="{{ $board->content }}"></textarea>
        画像<input type="file" name="image" /><br>
        <input type="hidden" name="id" value="{{ $board->id }}" >
        <input type="submit" value="送信">
    </form>

</body>
</html>
