@extends('admin.admin')

@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-body text-center border-bottom">
                        @if($user->profile_image)
                        <img class="rounded-circle avatar-xl mb-3" src="{{ asset('storage/' . $user->profile_image)  }}"
                            alt="{{ $user->name }}">
                        @else
                        <img class="rounded-circle avatar-xl mb-3"
                            src="{{ asset('backend/assets/images/users/placeholder.png') }}" alt="{{ $user->name }}">
                        @endif

                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Full Name</dt>
                            <dd class="col-sm-8">{{ $user->name }}</dd>

                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8">{{ $user->email }}</dd>

                            <dt class="col-sm-4">Username</dt>
                            <dd class="col-sm-8">{{ $user->username }}</dd>

                            <dt class="col-sm-4">Admin Since</dt>
                            <dd class="col-sm-8">{{ $user->created_at->format('M d, Y') }}</dd>
                        </dl>
                    </div>
                    <div class="card-body border-top text-end">
                        <a href="{{ route('admin.edit') }}" class="btn btn-info btn-rounded waves-effect waves-light">
                            <i class="ri-edit-line align-middle me-1"></i> Edit Profile
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection