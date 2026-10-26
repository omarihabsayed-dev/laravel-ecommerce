@extends('admin.admin')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <h3 class="card-title">Edit Footer Page</h3>
                        </div>

                        <form method="POST" action="{{ route('footer.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $footer->id }}">

                            <div class="row mb-3">
                                <label for="number" class="col-2 col-form-label">Number</label>
                                <div class="col-10">
                                    <input name="number" class="form-control" type="text" value="{{ $footer->number }}"
                                        id="number">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short_description" class="col-2 col-form-label">Short Description</label>
                                <div class="col-10">
                                    <textarea name="short_description" class="form-control" id="short_description"
                                        rows="5">{{ $footer->short_description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-2 col-form-label">Address</label>
                                <div class="col-10">
                                    <input name="address" class="form-control" type="text"
                                        value="{{ $footer->address }}" id="address">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-2 col-form-label">Email</label>
                                <div class="col-10">
                                    <input name="email" class="form-control" type="email" value="{{ $footer->email }}"
                                        id="email">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="facebook" class="col-2 col-form-label">Facebook</label>
                                <div class="col-10">
                                    <input name="facebook" class="form-control" type="text"
                                        value="{{ $footer->facebook }}" id="facebook">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="twitter" class="col-2 col-form-label">Twitter</label>
                                <div class="col-10">
                                    <input name="twitter" class="form-control" type="text"
                                        value="{{ $footer->twitter }}" id="twitter">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="copyright" class="col-2 col-form-label">Copyright</label>
                                <div class="col-10">
                                    <input name="copyright" class="form-control" type="text"
                                        value="{{ $footer->copyright }}" id="copyright">
                                </div>
                            </div>


                            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light"
                                value="Update Footer">
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection