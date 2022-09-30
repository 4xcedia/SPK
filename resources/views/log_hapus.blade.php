@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        @if (session()->has('sukses'))
            <div class="alert alert-success alert-dismissible show fade">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Nominal</th>
                        <th>Dihapus Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($kas as $list_kas)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ date_formatted($list_kas->deleted_at ,"d F Y")}}</td>
                            <td>{{ $list_kas->deskripsi }}</td>
                            <td>{{ $list_kas->status == 1 ? "Pengeluaran" : "Pemasukan" }}</td>
                            <td style="text-align: right">{{ format_decimal($list_kas->nilai) }}</td>
                            <td>{{ $list_kas->name }}</td>
                            <td><a href="/undo_kas/{{ $list_kas->id }}" onclick="undo()"  class="btn btn-danger {{ Auth::user()->is_admin == 1 ? '' : 'disabled' }}"><i class="fa-solid fa-rotate-left"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function undo() {
          alert("Yakin Ingin Mengembalikan Data?");
        }
    </script>
@endsection