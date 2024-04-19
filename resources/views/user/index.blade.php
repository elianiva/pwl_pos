@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
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
                            <div class="col-1 control-label col-form-lavel">Filter:</div>
                            <div class="col-3">
                                <select name="level_id" id="level_id" class="form-control" required>
                                    <option value="">- Semua -</option>
                                    @foreach($levels as $item)
                                        <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <table
                class="table table-bordered table-striped table-hover table-sm"
                id="table_user"
            >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            var dataUser = $('#table_user').DataTable({
                serverSide: true, serverSide: true, if you want to use server side processing
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex", sequence number of laravel datatable addIndexColumn()
                        ClassName: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "username",
                        ClassName: "",
                        orderable: true, orderable: true, if you want this column to be sortable
                        searchable: true searchable: true, if you want this column to be searchable
                    }, {
                        data: "name",
                        ClassName: "",
                        orderable: true, orderable: true, if you want this column to be sortable
                        searchable: true searchable: true, if you want this column to be searchable
                    }, {
                        data: "level.level_nama",
                        ClassName: "",
                        orderable: false, orderable: true, if you want this column to be sortable
                        searchable: false searchable: true, if you want this column to be searchable
                    }, {
                        data: "action",
                        ClassName: "",
                        orderable: false, orderable: true, if you want this column to be sortable
                        searchable: false searchable: true, if you want this column to be searchable
                    }
                ]
            });
        });

        $('#level_id').change(function () {
            dataUser.ajax.reload();
        });
    </script>
@endpush
