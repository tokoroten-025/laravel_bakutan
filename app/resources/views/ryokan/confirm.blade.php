<!-- 削除確認画面 -->
<h2>アカウント削除の確認</h2>
<p>本当にアカウントを削除しますか？この操作は取り消せません。</p>
<form action="{{ route('delete.confirm') }}" method="POST">
    @csrf
    <button type="submit">削除する</button>
    <a href="{{ route('home') }}">キャンセル</a>
</form>
