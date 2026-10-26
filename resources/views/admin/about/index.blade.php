@extends('admin.admin')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Edit About Page</h3>
                        </div>

                        <form method="POST" action="{{ route('about.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $about->id }}">

                            <div class="row mb-3">
                                <label for="title" class="col-2 col-form-label">Title</label>
                                <div class="col-10">
                                    <input name="title" class="form-control" type="text" value="{{ $about->title }}"
                                        id="title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short_title" class="col-2 col-form-label">Short Title</label>
                                <div class="col-10">
                                    <input name="short_title" class="form-control" type="text"
                                        value="{{ $about->short_title }}" id="short_title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short_description" class="col-2 col-form-label">Short Description</label>
                                <div class="col-10">
                                    <textarea name="short_description" class="form-control" id="short_description"
                                        rows="5">{{ $about->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="long_description" class="col-2 col-form-label">Long Description</label>
                                <div class="col-10">
                                    <textarea id="elm1"
                                        name="long_description">{{ $about->long_description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="about_image" class="col-2 col-form-label">About Image</label>
                                <div class="col-10">
                                    <input name="about_image" class="form-control" type="file" id="about_image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-2 col-form-label"></label>
                                <div class="col-10">
                                    @if($about->about_image)
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('storage/' . $about->about_image) }}" alt="Card image cap">
                                    @else
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('backend/assets/images/users/placeholder.png') }}"
                                        alt="Card image cap">
                                    @endif
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update About Page">
                        </form>

                    </div>
                </div>
            </div><!-- end col -->
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#about_image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection