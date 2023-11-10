<!-- Modal Downtime -->
<div class="modal fade" id="downtimeModal" tabindex="-1" role="dialog" aria-labelledby="downtimeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header shadow d-flex justify-content-center bg-danger">
                <h2 class="modal-title text-light"><strong>DOWNTIME</strong></h2>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        {{-- dowintime --}}
                        <div class="col-6 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000001" data-keterangan="Crane Trouble">Crane Trouble</button>
                        </div>
                        <div class="col-6 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000002" data-keterangan="Machine Trouble">Machine Trouble</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000003" data-keterangan="Tool Trouble">Tool Trouble</button>
                        </div>
                        <div class="col-6 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000004" data-keterangan="Data Trouble">Program Trouble</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000005" data-keterangan="Support Subcontract">Support Subcontract</button>
                        </div>
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000006" data-keterangan="Project Preparation">Project Preparation</button>
                        </div>
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-danger waves-effect text-center py-3" 
                            data-dismiss="modal" data-id-activity="G000007" data-keterangan="Design & lain-lain">Design & lain-lain</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal idle --}}
<div class="modal fade" id="idleModal" tabindex="-1" role="dialog" aria-labelledby="idleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header shadow d-flex justify-content-center bg-secondary">
                <h2 class="modal-title text-light"><strong>IDLE</strong></h2>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect text-center py-3"
                            data-dismiss="modal" data-id-activity="N000005" data-keterangan="Istirahat">Istirahat</button>
                        </div>
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect text-center py-3"
                            data-dismiss="modal" data-id-activity="N000001" data-keterangan="Meeting">Meeting</button>
                        </div>
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect text-center py-3"
                            data-dismiss="modal" data-id-activity="N000002" data-keterangan="Training">Training</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect text-center py-3"
                            data-dismiss="modal" data-id-activity="N000004" data-keterangan="5S(Cleaning Area)" style="font-size: 20px">5S(Cleaning Area)</button>
                        </div>
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect text-center py-3"
                            data-dismiss="modal" data-id-activity="N000006" data-keterangan="Management Work">Management Work</button>
                        </div>
                        <div class="col-4 mb-3">
                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect text-center py-3"
                            data-dismiss="modal" data-id-activity="N000007" data-keterangan="Technical Support">Technical Support</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="text-center">
                                <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect"
                                data-dismiss="modal" data-id-activity="N000003" data-keterangan="SS">SS</button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-center">
                                <button type="button" class="btn btn-lg btn-block btn-outline-secondary waves-effect"
                                data-dismiss="modal" data-id-activity="N000003" data-keterangan="QCC">QCC</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Notifikasi -->
<div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header shadow d-flex justify-content-center" style="background-color: rgb(0, 163, 150)">
                <h4 class="modal-title text-light"><strong>NOTIFIKASI</strong></h4>
            </div>
            <div class="modal-body">
                <strong><p style="font-size: 30px" class="text-center text-danger" id="keteranganNotifikasi"></p></strong>
            </div>
            <div class="container-fluid">
                <div class="row mb-3 justify-content-center">
                    <div class="col-8">
                        <button type="submit" class="btn btn-block btn-outline-success waves-effect" id="btnSelesai">Selesai</button>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-block btn-outline-primary waves-effect" id="btnTutupDI">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Start Job -->
<div class="modal fade" id="startJobModal" tabindex="-1" role="dialog" aria-labelledby="startJobModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header shadow d-flex justify-content-center" style="background-color: rgb(0, 163, 150)">
                <h4 class="modal-title text-light" id="taskName"><strong>PILIH TASK</strong></h4>
            </div>
            <div class="modal-body">
                {{-- mch --}}
                @if(Auth()->user()->sub === 'MCH')
                <form id="anForm">
                    @csrf
                    <input type="hidden" name="job_id" id="job_id">

                    <div class="row justify-content-center mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="card" style="border-color: rgb(209, 209, 209)">
                                    <label for="project" class="form-label text-center mt-2" style="font-size: 22px; color:black">PROJECT</label>
                                    <p class="text-center">{{ $ljkh->project }}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card" style="border-color: rgb(209, 209, 209)">
                                    <label for="Anumber" class="form-label text-center mt-2" style="font-size: 22px; color:black">ANUMBER</label>
                                    <p class="text-center">{{ $ljkh->id_job }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="row mb-3">
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-outline-info waves-effect" data-dismiss="modal" data-activity_name="BOBOK">BOBOK</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-outline-info waves-effect" data-dismiss="modal" data-activity_name="Milling Machine Work">Milling Machine Work</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-outline-info waves-effect" data-dismiss="modal" data-activity_name="Mach 2D">Mach 2D</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-outline-info waves-effect" data-dismiss="modal" data-activity_name="Mach 3D">Mach 3D</button>
                            </div>
                        </div>
                    </div>
                    @else
                    {{-- pref --}}
                    <div class="row justify-content-center">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-lg btn-block btn-primary" data-dismiss="modal" data-activity_name="Drill">Drill</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-lg btn-block btn-primary" data-dismiss="modal" data-activity_name="Setting">Setting</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- modal notif Start Job --}}
<div class="modal fade" id="notifModalStart" tabindex="-1" role="dialog" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <strong>
                            <p style="font-size: 30px;" class="text-center text-warning">SUCCESS! JOB DIMULAI</p>
                        </strong>
                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" id="btnTutupStart">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal End Job -->
<div class="modal fade" id="endJobModal" tabindex="-1" role="dialog" aria-labelledby="endJobModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content text-center">
            <div class="modal-header shadow d-flex justify-content-center mb-2 bg-info">
                <h4 class="modal-title text-light" id="taskName"><strong>AKHIRI PEKEJERAAN?</strong></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="endJobForm">
                    <input type="hidden" name="job_id" id="job_id">
                    <div class="row mb-3 justify-content-center text-center">
                        <div class="col">
                            <div class="card" style="border-color: rgb(209, 209, 209)">
                                <label for="project" class="form-label text-center mt-2" style="font-size: 22px; color:black">PROJECT</label>
                                <p class="text-center">{{ $ljkh->project }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="border-color: rgb(209, 209, 209)">
                                <label for="Anumber" class="form-label text-center mt-2" style="font-size: 22px; color:black">ANUMBER</label>
                                <p class="text-center">{{ $ljkh->id_job }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="border-color: rgb(209, 209, 209)">
                                <label for="activity_name" class="form-label text-center mt-2" style="font-size: 22px; color:black">TASK NAME</label>
                                <p class="text-center">{{ $ljkh->activity_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mb-3 justify-content-center">
                    <div class="col-6">
                        <button type="submit" class="btn btn-block btn-outline-info waves-effect" id="nextShift">Dilanjut pada shift berikutnya?</button>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-block btn-outline-info waves-effect" id="btnEndJob">YA</button>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-block btn-outline-danger waves-effect" data-dismiss="modal" id="btnTutupEndJob">TIDAK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- notif job end --}}
<div class="modal fade" id="notifModalEnd" tabindex="-1" role="dialog" aria-labelledby="notifModalEndLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header shadow d-flex justify-content-center mb-2 bg-success">
                <h4 class="modal-title text-light" id="taskName"><strong>JOB COMPLETE!</strong></h4>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-outline-secondary btn-block waves-effect" data-dismiss="modal" id="btnTutupEnd">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- modal message for next shift --}}
<div class="modal fade" id="nextShiftModal" tabindex="-1" role="dialog" aria-labelledby="nextShiftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content text-center">
            <div class="modal-header shadow d-flex justify-content-center" style="background-color: rgb(0, 163, 150)">
                <h4 class="modal-title text-light"><strong>Masukan Informasi Untuk Shift Berikutnya</strong></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="job_id" id="job_id">
                <div class="row mb-2 justify-content-center">
                    <div class="col">
                        <div class="card" style="border-color: rgb(209, 209, 209)">
                            <div class="card-body">
                                <h5 class="card-title text-center"><strong>INFORMASI SHIFT</strong></h5>
                                <input type="text" name="note" id="inputInfoShift" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mb-3 justify-content-center">
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-danger" id="btnNextShift">SELESAI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan Job List -->
<div class="modal fade" id="jobListModal" tabindex="-1" role="dialog" aria-labelledby="jobListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
        <div class="modal-content text-center">
            <div class="modal-header shadow justify-content-center" style="background-color: rgb(0, 163, 150)">
                <h1 class="modal-title text-light" id="jobListModalLabel"><strong>JOB LIST</strong></h1>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="table-jobList" style="width: 100%">
                        <thead class="table-primary">
                            <tr>
                                <th class="col-sm-1 text-center">NO</th>
                                <th class="col-sm-3 col-md-2 text-center">PROJECT</th>
                                <th class="col-sm-3 col-md-2 text-center">ANUMBER</th>
                                <th class="col-sm-3 col-md-2 text-center">DIE PART</th>
                                <th class="col-md-1 text-center">ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnCloseJob" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Auto RUn -->
<div class="modal fade" id="modalAutorun" tabindex="-1" role="dialog" aria-labelledby="autoRunModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header shadow d-flex justify-content-center bg-primary">
                <h4 class="modal-title text-light" id="taskName"><strong>AUTO RUN</strong></h4>
            </div>
            <div class="modal-body">
                {{-- <form id="AutoRun" method="POST">
                    @csrf --}}
                    <div class="container">
                        <input type="hidden" name="job_id" id="job_id">
                        <div class="mb-3 row justify-content-center text-center">
                            <div class="col">
                                <div class="card" style="border-color: rgb(209, 209, 209)">
                                    <label for="project" class="form-label text-center mt-2" style="font-size: 22px; color:black">PROJECT</label>
                                    <p class="text-center">{{ $ljkh->project }}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card" style="border-color: rgb(209, 209, 209)">
                                    <label for="Anumber" class="form-label text-center mt-2" style="font-size: 22px; color:black">ANUMBER</label>
                                    <p class="text-center">{{ $ljkh->id_job }}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card" style="border-color: rgb(209, 209, 209)">
                                    <label for="die_part" class="form-label text-center mt-2" style="font-size: 22px; color:black">DIE PART</label>
                                    <p class="text-center">{{ $ljkh->die_part }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <button type="button" class="btn btn-block btn-outline-primary waves-effect" 
                                    data-dismiss="modal" data-activity_name="NPK Mach 2D">Mach 2D</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-block btn-outline-primary waves-effect" 
                                    data-dismiss="modal" data-activity_name="NPK Mach 3D">Mach 3D</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-block btn-outline-primary waves-effect" 
                                    data-dismiss="modal" data-activity_name="NPK Milling Machine Work">Milling Machine Work</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>

{{-- notif autoRun --}}
<div class="modal fade" id="notifModalAutoRun" tabindex="-1" role="dialog" aria-labelledby="notifModalAutoRunLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <strong>
                            <p style="font-size: 30px;" class="text-center text-danger">AUTO RUN BERJALAN!</p>
                        </strong>
                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" id="btnAutoRun">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
