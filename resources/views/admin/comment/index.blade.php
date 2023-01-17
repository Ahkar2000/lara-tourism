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
                                <h3 class=" font-weight-bold">Comments</h3>
                                <form action="{{ route('comments.index') }}" method="GET" class="d-inline-block">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Comment" aria-describedby="button-addon1" value="{{ request('search') }}" name="search">
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
                                                <th>User Name</th>
                                                <th>Package Name</th>
                                                <th>Comment</th>
                                                <th>DateTime</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($comments as $key=>$comment)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td class="user-name">{{ $comment->user->name }}</td>
                                                    <td class="package-name">{{ $comment->package->name }}</td>
                                                    <td>{{ Str::limit($comment->comment, 50, '...') }}</td>
                                                    <td class="date-time">{{ $comment->created_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn border dropdown-toggle" href="#" data-boundary="window"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item view-comment"
                                                                    data-id="{{ $comment->id }}" data-toggle="modal"
                                                                    data-target="#staticBackdrop"
                                                                    data-link="{{ route('comments.show', $comment->id) }}">
                                                                    <i class="text-warning ti-file"></i> View</a>
                                                                <div class="dropdown-divider"></div>
                                                                <form action="{{ route('comments.destroy', $comment->id) }}"
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
                                    {{ $comments->links() }}
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
                                <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="font-weight-bold">User Name : <span class="font-weight-normal"
                                        id="name"></span></p>
                                <p class="font-weight-bold">Pacakge Name : <span class="font-weight-normal" id="package"></span>
                                </p>
                                <p class="font-weight-bold">DateTime : <span class="font-weight-normal"
                                        id="created-at"></span></p>
                                <p class="font-weight-bold">Comment</p>
                                <p class="font-weight-normal" id="comment"></p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                title: 'Are you sure to delete this comment?',
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
            
            $('.view-comment').on("click",function (e) {  
            let userName = $(this).closest('tr').find('.user-name').html()
            let packageName = $(this).closest('tr').find('.package-name').html()
            let dateTime = $(this).closest('tr').find('.date-time').html()
            let link = $(this).attr('data-link')
            $.get(link,function(data){
                $('#name').html(userName)
                $('#package').html(packageName)
                $('#created-at').html(dateTime)
                $('#comment').html(data.comment)
                })
            })
        });
        
    </script>
@endpush
