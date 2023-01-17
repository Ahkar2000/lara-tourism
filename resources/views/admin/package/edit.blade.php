@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <section id="main-content">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title pr d-flex justify-content-between align-items-center">
                                <h3 class="mb-0 font-weight-bold">Update Package</h3>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form id="update-form" action="{{ route('packages.update',$package->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                </form>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Package Name</label>
                                        <input form="update-form" name="name" value="{{ old('name', $package->name) }}" type="text"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Location</label>
                                        <input form="update-form" name="location" value="{{ old('location', $package->location) }}"
                                            type="address" class="form-control @error('location') is-invalid @enderror">
                                        @error('location')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Price</label>
                                        <input form="update-form" name="price" value="{{ old('price', $package->price) }}" type="number"
                                            class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Description</label>
                                        <textarea form="update-form" name="description" class="form-control @error('description') is-invalid @enderror" rows="30"
                                            style="height: 150px;">{{ old('description', $package->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <label for="" class=" font-weight-bold">Photos</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input form="update-form" multiple name="photos[]" type="file"
                                                class="custom-file-input @error('photos') is-invalid @enderror"
                                                id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @error('photos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @foreach ($package->photos as $photo)
                                            <div class="col-3">
                                                <div class="container-img">
                                                    <img src="{{ asset('storage/500/' . $photo->name) }}" class="image-show w-100 rounded">
                                                    <div class="middle-img">
                                                      <div class="">
                                                        <form action="{{ route('photos.destroy',$photo->id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-sm btn-danger" id="idelete">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </form>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <a href="{{ route('packages.index') }}" class="btn border rounded-0">Back</a>
                                        <button class="btn btn-primary border-0 rounded-0" type="submit" style="background-color: #868e96;">Update</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="module">
        $(document).ready(function() {

            $('#idelete').on("click",function(e){
                e.preventDefault()
                Swal.fire({
                title: 'Are you sure to delete this photo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('form').trigger('submit')
                }
                })
            })
        });
        
    </script>
@endpush
