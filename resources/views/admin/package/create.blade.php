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
                                <h3 class="mb-0 font-weight-bold">Add Package</h3>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Package Name</label>
                                        <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Location</label>
                                        <input name="location" value="{{ old('location') }}" type="address" class="form-control @error('location') is-invalid @enderror">
                                        @error('location')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Price</label>
                                        <input name="price" value="{{ old('price') }}" type="number" class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="30" style="height: 150px;" >{{ old('description') }}</textarea>
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
                                          <input multiple name="photos[]" type="file" class="custom-file-input @error('photos') is-invalid @enderror" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @error('photos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                      </div>
                                    <div class="form-group float-right">
                                        <a href="{{ route('packages.index') }}" class="btn border rounded-0">Back</a>
                                        <button class="btn btn-primary border-0 rounded-0" type="submit" style="background-color: #868e96;">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection