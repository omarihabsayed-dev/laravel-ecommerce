@php
use App\Models\Portfolio;
$portfolio = Portfolio::FindOrFail(1);
@endphp
@extends('admin.admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Edit Portfolio</h3>
                        </div>

                        <form method="POST" action="{{ route('portfolio.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $portfolio->id }}">

                            <div class="row mb-3">
                                <label for="name" class="col-2 col-form-label">Name</label>
                                <div class="col-10">
                                    <input name="name" class="form-control" type="text" value="{{ $portfolio->name }}"
                                        id="name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="title" class="col-2 col-form-label">Title</label>
                                <div class="col-10">
                                    <input name="title" class="form-control" type="text" value="{{ $portfolio->title }}"
                                        id="title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="long_description" class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <textarea id="elm1" name="long_description">{{ $portfolio->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-2 col-form-label">Portfolio Image</label>
                                <div class="col-10">
                                    <input name="image" class="form-control" type="file" id="image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-2 col-form-label"></label>
                                <div class="col-10">
                                    @if($portfolio->image)
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('storage/' . $portfolio->image) }}" alt="Portfolio image">
                                    @else
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('backend/assets/images/users/placeholder.png') }}"
                                        alt="Placeholder image">
                                    @endif
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Portfolio">
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        // Changed from #about_image to #image to match the new input ID
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection