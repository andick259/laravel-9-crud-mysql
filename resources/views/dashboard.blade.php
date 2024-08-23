@extends('layout/aplikasi')
@section('konten')

<h1> Welcome to Dashboard</h1>
<p>{{ $user->username }}</p>
<p><a href="/logout">Logout</a></p>
@endsection