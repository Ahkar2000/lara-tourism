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
                                <h3 class="font-weight-bold">Detail</h3>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($package->photos as $key=>$photo)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-interval="2000">
                                                            <a href="{{ asset('storage/1000/'.$photo->name) }}">
                                                                <img src="{{ asset('storage/500/'.$photo->name) }}" class="d-block w-100">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button style="background: none; border: none;" class="carousel-control-prev" type="button" data-target="#carouselExampleInterval" data-slide="prev">
                                                  <span class="carousel-control-prev-icon" ></span>
                                                  <span class="sr-only">Previous</span>
                                                </button>
                                                <button style="background: none; border: none;" class="carousel-control-next" type="button" data-target="#carouselExampleInterval" data-slide="next">
                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                  <span class="sr-only">Next</span>
                                                </button>
                                            </div>
                                            <hr>
                                            <span class="badge badge-warning text-center"><i class="bi bi-tag-fill"></i>{{ $package->price }}</span>
                                        </div>
                                        <div class="col-lg-7">
                                            <h4 class="font-weight-bold mb-0">{{ $package->name }}</h4>
                                            <hr>
                                            <p class="text-mute mb-0">Location : {{ $package->location }}</p>
                                            <h4 class="font-weight-bold">Description</h4>
                                            <p class="font-weight-bold">{{ $package->description }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4 class="font-weight-bold mb-0">Comments (0)</h4>
                                    <a href="{{ route('packages.index') }}" class="btn btn-secondary btn-large float-right">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
