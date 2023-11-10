@extends('layouts.app')

@section('title', 'Input Job/Anumber')

@section('contents')

<div class="container-fluid">
    <div class="container-flex align-items-center justify-content-center text-center mb-3">
        <h1 class="mb-0">PROJECT LIST</h1>
        <h1 class="mb-1">MACHINING SECTION</h1>
    </div>

    <hr style="border-top-color: gray">

    <div class="text-left mb-3">
        <button type="button" class="btn btn-primary" id="addProject">
            Add Project
        </button>
    </div>

{{-- ini index tablenya --}}
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table-index">
            <thead class="table-primary">
                <tr>
                    <th class="col-sm-1 text-center">NO</th>
                    <th class="col-sm-2 text-center">PROJECT</th>
                    <th class="col-sm-2 text-center">ANUMBER</th>
                    <th class="col-sm-2 text-center">PART NAME</th>
                    <th class="col-md-1 text-center">ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 200%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                <form id="projectForm" name="projectForm" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="project_id" id="project_id">
                    <div class="mb-3 row">
                        <label for="Anumber" class="col-sm-3 col-form-label">Anumber :</label>
                        <div class="col-md">
                            <input type="text" class="form-control" name='Anumber' id="Anumber" 
                            onkeyup="checkAndFixAnumber()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="project" class="col-sm-3 col-form-label">Project :</label>
                        <div class="col-md">
                            <input type="text" class="form-control" name='project' id="project">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="part_name" class="col-sm-3 col-form-label">Part-Name :</label>
                        <div class="col-md">
                            <input type="text" class="form-control" name='part_name' id="part_name">
                        </div>
                    </div>
                </form>
                <!-- Akhir Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary tombol-update">Update</button>
                <button type="button" class="btn btn-primary tombol-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

@include('admin.script')

@endsection