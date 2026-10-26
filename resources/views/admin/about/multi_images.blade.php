@extends('admin.admin')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Edit Multi Images</h3>
                        </div>

                        <form method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="multi_image" class="col-2 col-form-label">Upload Images</label>
                                <div class="col-10">
                                    <input name="multi_image[]" class="form-control" type="file" id="multi_image"
                                        multiple>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-2 col-form-label">Current Images</label>
                                <div class="col-10">
                                    <div class="d-flex flex-wrap gap-2">

                                        @forelse($images as $image)
                                        @if(is_array($image->multi_image))
                                        @foreach($image->multi_image as $imgPath)
                                        <div
                                            style="position: relative; display: inline-block; margin-right: 10px; margin-bottom: 10px;">
                                            <img src="{{ asset('storage/' . $imgPath) }}"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                class="rounded avatar-lg" alt="Card image cap">
                                        </div>
                                        @endforeach
                                        @else
                                        <div
                                            style="position: relative; display: inline-block; margin-right: 10px; margin-bottom: 10px;">
                                            <img src="{{ asset('storage/' . $image->multi_image) }}"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                class="rounded avatar-lg" alt="Card image cap">
                                        </div>
                                        @endif
                                        @empty
                                        <p>No multi images found.</p>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Multi Images">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection