@extends('admin.layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h3 class="fw-bold">Inquiries</h3>
            <hr>
            <div class="row mb-3">

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
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $inquiry->created_at }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->subject }}</td>
                                <td>
                                    @if ($inquiry->status == 1)
                                        <span class="badge text-bg-success">Read</span>
                                    @else
                                        <span class="badge text-bg-info">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                        data-bs-toggle="dropdown">
                                        <i class="align-middle" data-feather="settings"></i>
                                    </a>

                                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block border p-1 rounded"
                                        href="#" data-bs-toggle="dropdown">
                                        <span class="text-dark">Action</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="align-middle me-1 text-warning" data-feather="file"></i><span
                                                class="align-middle">View</span></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="pages-profile.html"><i
                                                class="align-middle me-1 text-danger" data-feather="trash"></i><span
                                                class="align-middle">Delete</span></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Three is no data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class=" modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@push('script')
    <script type="module">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
