@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="form-group">
            <!-- Button trigger for login form modal -->
           @if (Auth::user()->is_admin == 1)
           <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"data-bs-target="#exampleModalLong">
               Input Kas
           </button>
           @endif
            <b> Saldo </b> <input type="text" disabled value="{{ format_decimal($saldo) }}">
            <br>
            <br>
            @if (session()->has('sukses'))
            <div class="alert alert-success alert-dismissible show fade">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!--login form Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Input Kas</h5>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="/tambah_data" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label>Deskripsi: </label>
                                <div class="form-group">
                                    <input type="text" name="deskripsi" class="form-control" placeholder="Tulis deskripsi nota" autocomplete="off" autofocus required>
                                    @error('deskripsi')
                                        <div class="alert alert-danger">{{ $message }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    @enderror
                                </div>
                                <label>Nominal: </label>
                                <div class="form-group">
                                    <input type="text" name="nilai" class="form-control" autocomplete="off" autofocus required>
                                    @error('nilai')
                                        <div class="alert alert-danger">{{ $message }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    @enderror
                                </div>
                                <label>Status: </label>
                                <div class="form-group">
                                    <div class="form-group">
                                        <select name="status" class="choices form-select">
                                            <option value="1">Pengeluaran</option>
                                            <option value="0">Pemasukan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary ml-1">
                                    Simpan
                                </button>
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Nominal</th>
                        <th>Dibuat Oleh</th>
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
                            <td>{{ date_formatted($list_kas->created_at ,"d F Y")}}</td>
                            <td>{{ $list_kas->deskripsi }}</td>
                            <td>{{ $list_kas->status == 1 ? "Pengeluaran" : "Pemasukan" }}</td>
                            <td style="text-align: right">{{ format_decimal($list_kas->nilai) }}</td>
                            <td>{{ $list_kas->name }}</td>
                            <td><a href="/hapus_kas/{{ $list_kas->id }}" onclick="hapus()"  class="btn btn-danger {{ Auth::user()->is_admin == 1 ? '' : 'disabled' }}"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function hapus() {
          alert("Yakin Hapus Data?");
        }
        </script>
@endsection