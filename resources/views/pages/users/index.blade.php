@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>
                <div class="section-header-button">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Users</a></div>
                    <div class="breadcrumb-item">All Users</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Users</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <form action="{{ route('users.index') }}" method="GET">
                                        <div class="input-group">
                                            <select name="role" class="form-control selectric">
                                                <option value="">-- Pilih Role --</option>
                                                <option value="">All</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}"
                                                        {{ request('role') == $role ? 'selected' : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="float-right">
                                    <form method="GET" action="{{ route('users.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search users"
                                                name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            {{-- <th>Created At</th> --}}
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($users as $user)
                                            <tr>

                                                <td>
                                                    <div class="avatar-item mb-0">
                                                        <img alt="image" src="{{ asset('img/avatar/avatar-5.png') }}"
                                                            class="img-fluid" data-toggle="tooltip"
                                                            title="{{ $user->name }}" width="40px">
                                                    </div>
                                                </td>
                                                <td>{{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->role }}
                                                </td>
                                                {{-- <td>{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y H:i') }}
                                                </td> --}}
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        @if (auth()->user()->role == 'admin' && auth()->user()->id != $user->id && $user->role != 'admin')
                                                            <a href='{{ route('users.edit', $user->id) }}'
                                                                class="btn btn-primary btn-action mr-1"
                                                                data-toggle="tooltip" title="Edit"><i
                                                                    class="fas fa-pencil-alt"></i></a>

                                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger btn-action"
                                                                    data-toggle="tooltip" title="Delete"
                                                                    onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            @if (auth()->user()->role != 'staff' && $user->role == 'admin')
                                                                <span class="text-muted">Dilarang!</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('users.edit', $user->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $users->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
