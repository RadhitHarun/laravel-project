@extends('layouts.app')

@section('title', 'Validasi Job')

@section('contents')

<div class="container-fluid">

    <div class="container-flex align-items-center justify-content-center text-center mb-3">
        <h1 class="mb-0">VALIDATION JOB</h1>
        <h1 class="mb-1">MACHINING SECTION</h1>
    </div>
    <hr style="border-top-color: gray">
    <div id="validationSuccessMessage" class="alert alert-success d-none">
        <p><strong>Success!</strong> | Job berhasil divalidasi.</p>
    </div>  

{{-- table valdiasi --}}
    <div class="table-responsive mb-5">
        <h3 style="color: black; font-size:18px" class="mt-3">*Job Yang Belom Divalidasi</h3>
        <table class="table table-bordered text-center" id="table-validasi">
            <thead class="table-primary">
                <tr>
                    <th class="col-sm-1 text-center">NO</th>
                    <th class="col-sm-2 text-center">PROJECT</th>
                    <th class="col-sm-2 text-center">ANUMBER</th>
                    <th class="col-sm-2 text-center">PART NAME</th>
                    <th class="col-sm-2 text-center">STATUS</th>
                    <th class="col-md-1 text-center">ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
    <hr style="border-width: 2px; border-color:black">
{{-- table validated --}}
    <div class="table-responsive">
        <h3 style="color: black; font-size:18px" class="mt-3">*Job Yang Sudah Divalidasi</h3>
        <table class="table table-bordered text-center" id="table-validated">
            <thead class="table-success">
                <tr>
                    <th class="col-sm-1 text-center">NO</th>
                    <th class="col-sm-1 text-center">PROJECT</th>
                    <th class="col-sm-2 text-center">ANUMBER</th>
                    <th class="col-sm-2 text-center">ID MACHINING</th>
                    <th class="col-sm-2 text-center">LEAD TIME</th>
                    <th class="col-sm-2 text-center">PART NAME</th>
                    <th class="col-sm-2 text-center">STATUS</th>
                </tr>
            </thead>
        </table>
    </div>
    
</div>

{{-- modal --}}
<div class="modal fade" id="validasiModal" tabindex="-1" role="dialog" aria-labelledby="validasiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="heading text-center" id="validasiModalLabel" style="color: black; font-size:25px"><strong>VALIDASI JOB</strong></h5>
            </div>
            <div class="modal-body">
                <form id="validasiForm">
                    @csrf
                    <input type="hidden" name="project_id" id="project_id">
                    <div id="validationErrorMessage" class="alert alert-danger d-none" style="font-size: 15px">
                        <p>Job belum bisa divalidasi, Lengkapi semua kebutuhan terlebih dahulu!.</p>
                    </div>                                      
                    <div class="mb-3 row">
                        <label for="id_job" class="col-sm-3 col-form-label">Anumber :</label>
                        <div class="col-md">
                            <input type="text" class="form-control" name='id_job' id="id_job" 
                            onkeyup="checkAndFixAnumber()" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="part_name" class="col-sm-3 col-form-label">Part Name</label>
                        <div class="col-md">
                            <input type="text" class="form-control" name='part_name' id="part_name" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lead_time" class="col-sm-3 col-form-label">Lead Time</label>
                        <div class="col-md">
                            <input type="text" class="form-control" name='lead_time' id="lead_time" 
                            placeholder="Masukan Lead Time" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_mch">Pilih Workstation:</label>
                        <select class="form-control" id="id_mch" name="id_mch">
                            <option selected disabled>Pilih Mesin Untuk Mengerjakan Job</option>
                            @foreach($idMchs as $idMch)
                                <option value="{{ $idMch }}">{{ $idMch }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label>Centang minimal satu opsi:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="ncSheet" name="options[]" value="ncSheet">
                            <label class="form-check-label" for="ncSheet">NC Sheet</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="casting" name="options[]" value="casting">
                            <label class="form-check-label" for="casting">Casting</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="gambar" name="options[]" value="gambar">
                            <label class="form-check-label" for="gambar">Gambar</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary" id="closeBtnValidasi" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnValidasi">Validasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('foreman.script')
@endsection