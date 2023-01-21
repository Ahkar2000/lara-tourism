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
                                <a href="{{ route('packages.index') }}" class="btn btn-primary border-0 rounded-0"
                                    type="submit" style="background-color: #868e96;">Back</a>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($package->photos as $key => $photo)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}"
                                                            data-interval="2000">
                                                            <a class="venobox" href="{{ asset('storage/1000/' . $photo->name) }}">
                                                                <img src="{{ asset('storage/500/' . $photo->name) }}"
                                                                    class="d-block w-100">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button style="background: none; border: none;"
                                                    class="carousel-control-prev" type="button"
                                                    data-target="#carouselExampleInterval" data-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                                <button style="background: none; border: none;"
                                                    class="carousel-control-next" type="button"
                                                    data-target="#carouselExampleInterval" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </button>
                                            </div>
                                            <hr>
                                            <span class="badge badge-warning text-center"><i
                                                    class="bi bi-tag-fill"></i>{{ $package->price }}</span>
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
                                    <h4 class="font-weight-bold mb-2">Comments  ( <span
                                        id="total-comments">{{ $package->comments->count() }}</span> ) </h4>
                                    <div class="comment-container">

                                    </div>
                                    @if ($package->comments->count() > 5)
                                        <div class="text-center" id="cload">
                                            <p>
                                                <a id="load-more" href="" class="text-dark">
                                                    <i class="bi bi-arrow-clockwise"></i> Load more comments
                                                </a>
                                            </p>
                                        </div>
                                        <div class="text-center d-none mb-3" id="spinner">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                            </div>
                                            <span>Loading...</span>
                                        </div>
                                    @endif
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
    <script>
        var page = 1;
        $('#load-more').on('click', function(e) {
            $('#cload').removeClass('d-block').addClass('d-none')
            e.preventDefault()
            page++;
            loadMoreData(page);
        })

        fetchData()
        $('.venobox').venobox()

        function fetchData() {
            $.get('{{ route('showRelatedComments', $package->id) }}', function(d) {
                $.each(d.data, function(a, b) {
                    $('.comment-container').append(
                        `
                        <div class="border rounded p-3 mb-3 d-flex align-items-top justify-content-between">
                            <div>
                                <div class="d-flex align-items-center">
                                <h5 class="font-weight-bold"><i class="ti-user mr-2"></i>${b.user.name}</h5>
                                <small class="mb-1 ml-2">${b.created_at.replace('T',' ').substr(0,19)}</small>    
                                </div>
                                <p class="mb-0">${b.comment}</p>
                            </div>
                            <div class="dropdown">
                                <a href="#" data-boundary="window"
                                    role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <form action="{{ url('/admin/comments') }}/${b.id}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="dropdown-item" id="idelete" type="submit"> <i
                                        class="text-danger ti-trash"></i>
                                        Delete</button>
                                </div>
                            </div>
                        </div>
                        `
                    )
                })
            })
        }

        function loadMoreData(page) {
            $('#spinner').removeClass('d-none').addClass('d-block')
            $.get('{{ route('showRelatedComments', $package->id) }}' + '?page=' + page, function(d) {
                $('#spinner').removeClass('d-block').addClass('d-none')
                $.each(d.data, function(a, b) {
                    $('.comment-container').append(
                        `
                        <div class="border rounded p-3 mb-3 d-flex align-items-top justify-content-between">
                            <div>
                                <div class="d-flex align-items-center">
                                <h5 class="font-weight-bold"><i class="ti-user mr-2"></i>${b.user.name}</h5>
                                <small class="mb-1 ml-2">${b.created_at.replace('T',' ').substr(0,19)}</small>    
                                </div>
                                <p class="mb-0">${b.comment}</p>
                            </div>
                            <div class="dropdown">
                                <a href="#" data-boundary="window"
                                    role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <form action="{{ url('/admin/comments') }}/${b.id}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="dropdown-item" id="idelete" type="submit"> <i
                                        class="text-danger ti-trash"></i>
                                        Delete</button>
                                </div>
                            </div>
                        </div>
                        `
                    )
                })
                if (page > $('#total-comments').html() / 5) {
                    $('#cload').removeClass('d-block').addClass('d-none')
                } else {
                    $('#cload').removeClass('d-none').addClass('d-block')
                }
            })

        }
    </script>
@endpush
