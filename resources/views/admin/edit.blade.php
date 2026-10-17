@extends('admin.admin')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-2 col-form-label">Name</label>
                                <div class="col-10">
                                    <input name="name" class="form-control" type="text" value="{{ $user->name }}"
                                        id="name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-2 col-form-label">Email</label>
                                <div class="col-10">
                                    <input name="email" class="form-control" type="text" value="{{ $user->email }}"
                                        id="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-2 col-form-label">Username</label>
                                <div class="col-10">
                                    <input name="username" class="form-control" type="text"
                                        value="{{ $user->username }}" id="username">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-2 col-form-label">Profile Image</label>
                                <div class="col-10">
                                    <input name="profile_image" class="form-control" type="file" id="image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-2 col-form-label"></label>
                                <div class="col-10">
                                    @if($user->profile_image)
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('storage/' . $user->profile_image) }}" alt="Card image cap">
                                    @else
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset('backend/assets/images/users/placeholder.png') }}"
                                        alt="Card image cap">
                                    @endif
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Profile">
                        </form>

                    </div>
                </div>
            </div><!-- end col -->
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
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