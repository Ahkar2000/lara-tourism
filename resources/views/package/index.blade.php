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
                                <div class="d-flex align-content-center justify-content-between">
                                    <div>
                                        @if (request()->is('filter-packages*'))
                                            <span class="fs-4">Filtered By : </span>
                                            <span class="text-black-50 fs-4">{{ $category->name }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="btn-group me-3">
                                            <button type="button" class="btn btn-outline-danger rounded-0 dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Category
                                            </button>
                                            <ul class="dropdown-menu rounded-0">
                                                <li><a class="dropdown-item" href="{{ route('showPackages') }}">See All</a></li>
                                                @foreach ($categories as $c)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('packageByCategory', $c->slug) }}">{{ $c->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <form action="{{ route('showPackages') }}" method="GET">
                                            <div class="input-group">
                                                <input value="{{ request('search') }}" type="text" class="form-control rounded-0" name="search"
                                                    placeholder="Search Package" aria-label="Search Package"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-outline-danger rounded-0" type="submit"
                                                    id="button-addon2">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div>
                                    @forelse ($packages as $package)
                                        <div class="card rounded-0 mb-3 shadow shadow-sm">
                                            <div class="card-body d-flex">
                                                <div class="me-4">
                                                    <img src="{{ asset('storage/500/' . $package->photos->first()->name) }}"
                                                        class="w-100">
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="me-2">{{ $package->name }}</h4>
                                                        <span
                                                            class="badge text-bg-info rounded-0 mb-2">{{ $package->category->name }}</span>
                                                    </div>
                                                    <p class="fst-italic">
                                                        {{ Str::limit($package->description, 300, '...') }}
                                                    </p>
                                                    <div class="box text-start d-flex align-content-center justify-content-between"
                                                        style="box-shadow: none;">
                                                        <div class="btn-custom2"><i
                                                                class="bi bi-tag-fill me-1"></i>{{ $package->price }}
                                                        </div>
                                                        <a href="{{ route('userShow', $package->slug) }}"
                                                            class="btn-custom1">View Package <i
                                                                class="bi bi-arrow-right"></i></a>
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
