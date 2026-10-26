@php
@extends('admin.admin')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Edit Category</h3>
                        </div>

                        <form method="POST" action="{{ route('category.update', $BlogCategory) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="category" class="col-2 col-form-label">Name</label>
                                <div class="col-10">
                                    <input name="category" class="form-control" type="text"
                                        value="{{ $BlogCategory->category }}" id="category">
                                    @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Category">
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection