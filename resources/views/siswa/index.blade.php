@extends('layout/aplikasi')
@section('konten')
<a href="/siswa/create" class="btn btn-primary"> + | Tambah Data Siswa</a>
<table class="table">
<thead>
<tr>
    <th>Foto</th>
    <th>Nomor Induk</th>
    <th>Nama </th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
    @foreach ($data as $item)
<tr>
    <td>
        @if ($item->foto)
            <img src="{{ url('foto').'/'.$item->foto }}" style="max-width:50px; max-height:50px">
        @endif
    </td>
    <td>{{$item->nomor_induk}}</td>
    <td>{{$item->nama}}</td>
    <td>{{$item->alamat}}</td>
   <td>
    <a href="{{ url('/siswa/'.$item->nomor_induk) }}" class="btn btn-secondary btn-sm">Detail</a>
    <a href="{{ url('/siswa/'.$item->nomor_induk.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ '/siswa/'.$item->nomor_induk }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data?')"> 
        @csrf
        @method('DELETE')
        <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
    </form>
</td>
</tr>
@endforeach
</tbody>
</table>
{{$data->links()}}

@endsection