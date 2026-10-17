@extends('admin.admin')

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Change Password</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.update.password') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="oldpassword" class="col-2 col-form-label">Old Password</label>
                                <div class="col-10">
                                    <input name="oldpassword"
                                        class="form-control @error('oldpassword') is-invalid @enderror" type="password"
                                        id="oldpassword">
                                    @error('oldpassword')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newpassword" class="col-2 col-form-label">New Password</label>
                                <div class="col-10">
                                    <input name="newpassword"
                                        class="form-control @error('newpassword') is-invalid @enderror" type="password"
                                        id="newpassword">
                                    @error('newpassword')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirm_password" class="col-2 col-form-label">Confirm Password</label>
                                <div class="col-10">
                                    <input name="confirm_password"
                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                        type="password" id="confirm_password">
                                    @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Change Password">
                        </form>

                    </div>
                </div>
            </div><!-- end col -->
        </div>

    </div>
</div>
@endsection