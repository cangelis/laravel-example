@if(Session::has('errors'))
<div>
    @foreach (Session::get('errors')->all() as $error)
    <p>* {{ $error }}</p>
    @endforeach
</div>
@endif