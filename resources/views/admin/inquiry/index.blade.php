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
                                <h3 class=" font-weight-bold">Inquiries</h3>
                                <form action="{{ route('inquiries.index') }}" method="GET" class="d-inline-block">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" aria-describedby="button-addon1" value="{{ request('search') }}" name="search">
                                        <div class="input-group-prepend">
                                          <button class="btn border" type="button" id="button-addon1"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped table-hover border rounded">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>DateTime</th>
                                                <th>From</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($inquiries as $key=>$inquiry)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $inquiry->created_at }}</td>
                                                    <td>{{ $inquiry->name }}</td>
                                                    <td>{{ $inquiry->subject }}</td>
                                                    <td class="status">
                                                        @if ($inquiry->status == 1)
                                                            <span class="badge badge-success">Read</span>
                                                        @else
                                                            <span class="badge badge-info">Unread</span>
                                                        @endif
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn border dropdown-toggle" href="#" data-boundary="window"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item view-inquiry"
                                                                    data-id="{{ $inquiry->id }}" data-toggle="modal"
                                                                    data-target="#staticBackdrop" form="makeread"
                                                                    data-link="{{ route('inquiries.show', $inquiry->id) }}">
                                                                    <i class="text-warning ti-file"></i> View</a>
                                                                <div class="dropdown-divider"></div>
                                                                <form action="{{ route('inquiries.destroy', $inquiry->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="dropdown-item" id="idelete" type="submit"> <i
                                                                            class="text-danger ti-trash"></i>
                                                                        Delete</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr >
                                                    <td colspan="6" class="text-center">Three is no data.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $inquiries->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Inquiry</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="font-weight-bold">Inquirier : <span class="font-weight-normal"
                                        id="iname"></span></p>
                                <p class="font-weight-bold">Email : <span class="font-weight-normal" id="iemail"></span>
                                </p>
                                <p class="font-weight-bold">Subject : <span class="font-weight-normal"
                                        id="isubject"></span></p>
                                <p class="font-weight-bold">Message</p>
                                <p class="font-weight-normal" id="imessage"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="read-button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                title: 'Are you sure to delete this inquiry?',
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
            
            $('.view-inquiry').on("click",function (e) {  
            $(this).closest('tr').find('.status').html('<span class="badge badge-success">Read</span>')
            let link = $(this).attr('data-link')
            $.get(link,function(data){
                $('#iname').html(data.name)
                $('#iemail').html(data.email)
                $('#isubject').html(data.subject)
                $('#imessage').html(data.message)
                })
            })
        });
        
    </script>
@endpush
