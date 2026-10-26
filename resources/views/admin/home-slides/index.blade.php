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
                            <h3 class="card-title">Edit Home Slides</h3>
                        </div>

                        <form method="POST" action="{{ route('home-slides.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $slides->id }}">

                            <div class="row mb-3">
                                <label for="title" class="col-2 col-form-label">Title</label>
                                <div class="col-10">
                                    <input name="title" class="form-control" type="text" value="{{ $slides->title }}"
                                        id="title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <input name="description" class="form-control" type="text"
                                        value="{{ $slides->description }}" id="description">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="video_url" class="col-2 col-form-label">Video URL</label>
                                <div class="col-10">
                                    <input name="video_url" class="form-control" type="text"
                                        value="{{ $slides->video_url }}" id="video_url">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="homepage_image" class="col-2 col-form-label">Home Image</label>
                                <div class="col-10">
                                    <input name="homepage_image" class="form-control" type="file" id="homepage_image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-2 col-form-label"></label>
                                <div class="col-10">
                                    @if($slides->homepage_image)
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('storage/' . $slides->homepage_image) }}" alt="Card image cap">
                                    @else
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('backend/assets/images/users/placeholder.png') }}"
                                        alt="Card image cap">
                                    @endif
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Home Slide">
                        </form>

                    </div>
                </div>
            </div><!-- end col -->
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#homepage_image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection