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
                                <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="150">
                                    <div class="box" style="padding: 0px;">
                                        <div id="carouselExample" class="carousel slide">
                                            <div class="carousel-inner">
                                                @foreach ($package->photos as $key => $photo)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        <a href="{{ asset('storage/1000/' . $photo->name) }}"
                                                            class="venobox">
                                                            <img src="{{ asset('storage/500/' . $photo->name) }}"
                                                                class="d-block w-100">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExample" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExample" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                    <hr class="border-danger">
                                    <div class="box text-start d-flex align-items-center justify-content-between"
                                        style="box-shadow: none;">
                                        <div class="text-danger"><i class="bi bi-tag-fill me-1"></i>{{ $package->price }}
                                        </div>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="btn-custom1">Book Now</a>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <h4 class="fw-bold mb-0">{{ $package->name }}</h4>
                                    <hr class="border-danger">
                                    <span
                                        class="badge text-bg-info text-capitalize rounded-0">{{ $package->category->name }}</span>
                                    <br>
                                    <small class="fw-light mb-0">Location : {{ $package->location }}</small>
                                    <h4 class="fw-bold">Description</h4>
                                    <p class="">{{ $package->description }}</p>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade rounded-0" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-0">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Book Now</h1>
                                                <button type="button" class="btn-close rounded-0" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="book-form" action="{{ route('userBook') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">Number of People</label>
                                                        <input type="number" min="1" max="50" name="quantity"
                                                            class="form-control seat">
                                                    </div>
                                                    <div class="my-3">
                                                        <label class="form-label">Booking Date</label>
                                                        <input type="date" min="{{ now()->format('Y-m-d') }}"
                                                            name="schedule" class="form-control">
                                                    </div>
                                                    <div class="mt-3">
                                                        <label class="form-label">Where should we pick you up?</label>
                                                        <select name="place_id" class="form-control">
                                                            @forelse ($places as $place)
                                                                <option value="{{ $place->id }}"
                                                                    class="text-capitalize">{{ $place->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="my-3 col-6">
                                                            <label class="form-label">Choose a vehicle</label>
                                                            <select name="vehicle_id"
                                                                class="form-control" id="vehicle" required>
                                                                <option disabled selected>Choose a vehicle</option>
                                                                @forelse ($vehicles as $vehicle)
                                                                    @if ($vehicle->status == 1)
                                                                        <option data-price="{{ $vehicle->price }}"
                                                                            data-seat="{{ $vehicle->seat }}"
                                                                            value="{{ $vehicle->id }}"
                                                                            class="text-capitalize">{{ $vehicle->model }}
                                                                            ( {{ $vehicle->seat }} seats )</option>
                                                                    @endif
                                                                @empty
                                                                    <option class="text-capitalize">Not Avaliable</option>
                                                                @endforelse
                                                            </select>

                                                        </div>
                                                        <div class="my-3 col-6">
                                                            <label class="form-label">Vehicle's Price</label>
                                                            <input type="number" disabled class="form-control v-price"
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @auth
                                                        <div class="text-end mt-3">
                                                            <button style="border: none!important;"
                                                                class="btn-custom1">Book</button>
                                                        </div>
                                                    @else
                                                        <p>
                                                            Please <a href="{{ route('login') }}">Login</a> or <a
                                                                href="{{ route('register') }}">Register</a> to book.
                                                        </p>
                                                    @endauth
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade rounded-0" id="voucher" tabindex="-1"
                                aria-labelledby="voucher-modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-0 w-auto">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="voucher-modal">Booking Voucher</h1>
                                            <button type="button" class="btn-close rounded-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ms-2">
                                                <span class=" fw-bolder me-3">Booking ID:</span>
                                                <span class="booking-id"></span>
                                            </div>
                                            <div class="ms-2">
                                                <span class=" fw-bolder me-3">DateTime:</span>
                                                <span class="booking-date"></span>
                                            </div>
                                            <div class="ms-2">
                                                <span class=" fw-bolder me-3">Destination Place:</span>
                                                <span class="place"></span>
                                            </div>
                                            <div class="ms-2">
                                                <span class=" fw-bolder me-3">Vehicle:</span>
                                                <span class="vehicle-model"></span>
                                            </div>
                                            @auth
                                                <div class="ms-2">
                                                    <span class=" fw-bolder me-3">UserName:</span>
                                                    <span>{{ Auth::user()->name }}</span>
                                                </div>
                                            @endauth

                                            <table class="table">
                                                <thead>
                                                    <th>Package Name</th>
                                                    <th>Schedule</th>
                                                    <th>People</th>
                                                    <th>Price</th>
                                                    <th>Vehicle's Price</th>
                                                    <th>Amount</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="package"></td>
                                                        <td class="text-nowrap schedule"></td>
                                                        <td class="people"></td>
                                                        <td class="price"></td>
                                                        <td class="v-price"></td>
                                                        <td class="amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class=" fw-bolder total">Total</span>
                                                        </td>
                                                        <td>
                                                            <span class=" fw-bolder total-amount"></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-danger">
                            <h4 class="fw-bold mb-2">Reviews ( <span
                                    id="total-comments">{{ $package->comments->count() }}</span> )</h4>
                            <div class="comment-container">

                            </div>
                            @if ($package->comments->count() > 5)
                                <div class="text-center" id="cload">
                                    <p>
                                        <a id="load-more" href="" class="text-dark">
                                            <i class="bi bi-arrow-clockwise"></i> Load more reviews
                                        </a>
                                    </p>
                                </div>
                                <div class="text-center d-none mb-3" id="spinner">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                    </div>
                                    <span>Loading...</span>
                                </div>
                            @endif
                            <div class="text-center">
                                @auth
                                    <form action="{{ route('userComment') }}" method="POST" id="comment">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                                            <input type="text" class="form-control" id="content" name="comment"
                                                placeholder="Say Something" aria-describedby="button-addon2">
                                            <button style="border-radius: 0!important;" class="btn btn-danger send-btn"
                                                type="submit" id="button-addon2" disabled="disabled">
                                                <i class="bi bi-send"></i>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <p>
                                        Please <a href="{{ route('login') }}">Login</a> or <a
                                            href="{{ route('register') }}">Register</a> to give a review.
                                    </p>
                                @endauth
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
        $(document).ready(function() {

            //comment button disable to empty input
            $('#button-addon2').prop('disabled', true);

            function validateNextButton() {
                var buttonDisabled = $('#content').val().trim() === '';
                $('#button-addon2').prop('disabled', buttonDisabled);
            }
            $('#content').on('keyup', validateNextButton);
            //end
            fetchData()
            //comment load start
            var page = 1;

            $('#load-more').on('click', function(e) {
                $('#cload').removeClass('d-block').addClass('d-none')
                e.preventDefault()
                page++;
                loadMoreData(page);

            })

            //comment ajax start
            $('#comment').on('submit', function(e) {
                e.preventDefault()
                $('.send-btn').html(`
                    <div class="spinner-border spinner-border-sm" role="status">
                `)
                let input = $(this).serialize()
                $.post($(this).attr('action'), input, function(data) {
                    $('#button-addon2').prop('disabled', true);
                    $('#total-comments').html('{{ $package->comments->count() + 1 }}')
                    $('.send-btn').html(`
                        <i class="bi bi-send"></i>
                    `)
                    $('#comment')[0].reset()
                    $('.comment-container').prepend(
                        `
                        <div class="border rounded-0 p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <h5 class="fw-bold"><i class="bi bi-person"></i>${data[1]}</h5>
                                <small class="fw-lighter mb-1 ms-2">${moment(new Date(data[0].created_at)).format('YYYY-MM-DD HH:m:s')}</small>    
                            </div>
                            <small class="mb-0">${data[0].comment}</small>
                        </div>
                        `
                    )
                })
            })
        });

        //booking ajax
        $('#book-form').on('submit', function(e) {
            e.preventDefault()
            let input = $(this).serialize()
            $.post($(this).attr('action'), input, function(data) {
                $('#book-form')[0].reset()
                $('.modal').modal('hide')
                $('#voucher').modal('show')
                $('.booking-id').html(data[0].booking_code)
                $('.place').html(data[2])
                $('.v-price').html(data[4])
                $('.schedule').html(data[0].schedule)
                $('.booking-date').html(moment(new Date(data[0].created_at)).format('YYYY-MM-DD HH:m:s'))
                $('.package').html(data[1].name)
                $('.people').html(data[0].quantity)
                $('.price').html(data[1].price)
                $('.amount').html(data[0].amount)
                $('.vehicle-model').html(data[3])
                $('.total-amount').html(data[0].amount)
            })
        })

        //end

        //function for selected value
        $('#vehicle').on('change', function() {
            var i = $('#vehicle option:selected').attr('data-price');
            $('.v-price').val(i)
        })

        //function for seat 
        $('.seat').on('change', function() {
            let seatNo = $('.seat').val()
            if(seatNo > Number($('#vehicle option:selected').attr('data-seat'))){
                $('#vehicle').val('')
                $('.v-price').val('')
            }
            $('#vehicle > option').each(function(a) {
                if (seatNo > Number($(this).attr('data-seat'))) {
                    $(this).attr('hidden', 'hidden')
                } else {
                    $(this).removeAttr('hidden')
                }
            });
        })

        //venobox start
        $('.venobox').venobox();
        //venobox end

        //function for comment load more
        function loadMoreData(page) {
            $('#spinner').removeClass('d-none').addClass('d-block')
            $.get('{{ route('showRelatedComments', $package->id) }}' + '?page=' + page, function(d) {
                $('#spinner').removeClass('d-block').addClass('d-none')
                $.each(d.data, function(a, b) {
                    $('.comment-container').append(
                        `
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <h5 class="fw-bold"><i class="bi bi-person"></i>${b.user.name}</h5>
                                <small class="fw-lighter mb-1 ms-2">${moment(new Date(b.created_at)).format('YYYY-MM-DD HH:m:s')}</small>    
                            </div>
                            <small class="mb-0">${b.comment}</small>
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
        //end

        //function for comment fetch
        function fetchData() {
            $.get('{{ route('showRelatedComments', $package->id) }}', function(d) {
                $.each(d.data, function(a, b) {
                    $('.comment-container').append(
                        `
                        <div class="border rounded-0 p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <h5 class="fw-bold"><i class="bi bi-person"></i>${b.user.name}</h5>
                                <small class="fw-lighter mb-1 ms-2">${moment(new Date(b.created_at)).format('YYYY-MM-DD HH:m:s')}</small>    
                            </div>
                            <small class="mb-0">${b.comment}</small>
                        </div>
                        `
                    )
                })
            })
        }
        //end
    </script>
@endpush
