@extends('template')
@section('content')
<div class ="container">
    <h1>Daftar Tabel Tugas</h1>

    <div class="card mt-3">
        <div class="card-header">
            <h4>Data Tabel</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="" class="btn btn-primary btn-sm">Tambah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $tasks)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$task->name}}</td>
                            <td>{{$task->status}}</td>
                            <td>{{$task->deadline}}</td>
                            <td>{{substr ($task->description, 0, '50')}}</td>
                            <td>
                                <a href=""class="btn btn-warning bt-sm">Edit</a>
                                <a href=""class="btn btn-danger bt-sm">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection