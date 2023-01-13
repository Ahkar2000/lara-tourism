@extends('layouts.app')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <section id="main-content">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row">
                                <div class="text-center">
                                    <h4 class="fw-bolder mb-4">Tour Packages</h4>
                                </div>
                                <div>
                                    @forelse ($packages as $package)
                                        <div class="card rounded-0 mb-3 shadow shadow-sm">
                                            <div class="card-body d-flex">
                                                <div class="me-4">
                                                    <img src="{{ asset('storage/500/'.$package->photos->first()->name) }}" class="w-100">
                                                </div>
                                                <div>
                                                    <h4>{{ $package->name }}</h4>
                                                    <p class="fst-italic">
                                                        {{ Str::limit($package->description, 300, '...') }}
                                                    </p>
                                                    <div class="box text-start d-flex align-content-center justify-content-between"
                                                        style="box-shadow: none;">
                                                        <div class="btn-custom2"><i
                                                                class="bi bi-tag-fill me-1"></i>{{ $package->price }}
                                                        </div>
                                                        <a href="{{ route('userShow',$package->slug) }}" class="btn-custom1">View Package <i class="bi bi-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center">
                                            <p>There is no packages avaliable.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
