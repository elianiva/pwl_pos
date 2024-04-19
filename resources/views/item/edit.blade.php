@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($category)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</H5>
                    The data you are looking for was not found.
                </div>
                <a href="{{ url('category') }}" class="btn btn-sm btn-default mt2">Kembali</a>
            @else
                <form
                    method="POST" action="{{ url('/category/'.$category->category_id) }}"
                    class="form-horizontal"
                >
                    @csrf
                    {!! method_field('PUT')!!} <!-- add this line for edits that need the PUT -->
                    method
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Level</label>
                        <div class="col-11">
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option value="">- Pilih Level -</option>
                                @foreach($categories as $item)
                                    <option
                                        value="{{ $item->level_id }}"
                                        @if($item->level_id == $category->level_id) selected @endif>{{ $item->level_nama }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">categoryname</label>
                        <div class="col-11">
                            <input
                                type="text" class="form-control" id="categoryname"
                                name="categoryname" value="{{ old('categoryname', $category->categoryname) }}" required
                            >
                            @error('categoryname')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        < class="col-1 control-label col-form-label" >Nama</label>
                        <div class="col-11">
                            <input
                                type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $category->nama) }}" required
                            >
                            @error('nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Password</label>
                        <div class="col-11">
                            <input
                                type="password" class="form-control" id="password"
                                name="password"
                            >
                            @error('password')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @else
                                <small class="form-text text-muted">Ignore (do not fill in) if you
                                    do not want to change the password category.</small>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a
                                class="btn btn-sm btn-default ml-1" href="{{ url('category') }}"
                            >Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
