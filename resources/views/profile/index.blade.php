@extends('layouts.app')

@section('title', 'USER')

@section('contents')
<div class="container-fluid">
    <div class="container-flex align-items-center justify-content-center text-center mb-3 mt-3">
        <h1 class="mb-0 mt-4">USER</h1>
        <h1 class="mb-1">MACHINING SECTION</h1>
    </div>
    <hr style="border-top-color:gray">
    
    <div class="text-between mb-3">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('profile.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>    Add User</a>
            </div>
            <div class="col-6">
                <form id="searchForm" action="{{ route('profile') }}" method="GET">
                    <input type="text" id="searchInput" class="form-control" name="search" value="{{ $search }}" placeholder="Search...">
                </form>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Success !</strong> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th width="10px">#</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>STATUS</th>
                    <th width="50px">ACTION</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if($user->count() > 0)
                    @foreach($user as $u)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $u->name }}</td>
                            <td class="align-middle">{{ $u->email }}</td>
                            <td class="align-middle">{{ $u->level }}</td>   
                            <td class="align-middle">
                                <div class="row mb-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('profile.edit', $u->id) }}" type="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('profile.destroy', $u->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger m-0"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="15">There's Nothing In Here</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $user->links() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                $('#searchForm').submit();
            });
        });
    </script>
@endpush
