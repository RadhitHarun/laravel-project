@extends('layouts.app')

@section('title', 'LJKH')

@section('contents')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-center">
        <h1 class="text-center mt-3">LEMBAR JAM KERJA HARIAN</h1>
    </div>
    <hr style="border-top-color:gray">
    
    <div class="text-between mb-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <a href="{{ route('admin.addLJKH') }}" class="btn btn-primary"><i class="fas fa-plus"></i>  Add LJKH</a>
                <a href="{{ route('admin.exportLJKH') }}" class="btn btn-success"><i class="fas fa-download"></i>  Export</a>
                <a href="#" class="btn btn-danger btnImport"><i class="fas fa-upload"></i>  Import</a>
            </div>

            {{-- Search bar --}}
            <div class="col-4">
                <form id="searchForm" action="{{ route('admin.ljkh') }}" method="GET">
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

    {{-- table LJKH --}}
    <div class="table-responsive" id="table-container">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th class="align-middle">#</th>
                    <th class="align-middle">DATE</th>
                    <th class="align-middle">ID MACHINING</th>
                    <th class="align-middle">ID SUB</th>
                    <th class="align-middle">ID JOB</th>
                    <th class="align-middle">WORK CENTER</th>
                    <th class="align-middle">TASK NAME</th>
                    <th class="align-middle">PRODUCTION HOUR</th>
                    <th class="align-middle">START</th>
                    <th class="align-middle" width="80px">ITU</th>
                    <th class="align-middle">ACTION</th>
                </tr>
            </thead>

            <tbody class="text-center">
                @if($ljkh->count() > 0)
                    @foreach($ljkh as $l)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $l->Date }}</td>
                            <td class="align-middle">{{ $l->id_mch }}</td>  
                            <td class="align-middle">{{ $l->sub }}</td>  
                            <td class="align-middle">{{ $l->id_job }}</td>  
                            <td class="align-middle">{{ $l->work_ctr }}</td>  
                            <td class="align-middle">{{ $l->activity_name }}</td>  
                            <td class="align-middle">{{ $l->prod_hour }}</td>  
                            <td class="align-middle">{{ $l->start }}</td>  
                            <td class="align-middle">{{ $l->itu }}</td>      
                            <td class="align-middle">
                                <div class="row ">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.editLJKH', $l->id) }}" type="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.deleteLJKH', $l->id) }}" method="POST" type="button" class="btn btn-danger btn-group-sm p-0" onsubmit="return confirm('Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-0"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="20">Tidak Ada Task Hari Ini</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $ljkh->links() }}
        </div>
    </div>
</div>

@include('profile.importModal')
    
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