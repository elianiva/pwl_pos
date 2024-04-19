@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('item/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-1 control-label col-form-level">Filter:</div>
                            <div class="col-3">
                                <select name="kategori_id" id="kategori_id" class="form-control" required>
                                    <option value="">- Semua -</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <table
                class="table table-bordered table-striped table-hover table-sm"
                id="table_item"
            >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            const dataItem = $('#table_item').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('item/list') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data": function(d) {
                        d.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        ClassName: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "barang_kode",
                        ClassName: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "barang_nama",
                        ClassName: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "kategori.kategori_nama",
                        ClassName: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "harga_jual",
                        ClassName: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "harga_beli",
                        ClassName: "",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "action",
                        ClassName: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#kategori_id').change(function () {
                dataItem.ajax.reload();
            });
        });
    </script>
@endpush
