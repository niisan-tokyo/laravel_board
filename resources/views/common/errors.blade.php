@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>入力値に以下の不正が発見されました</strong>
    <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
