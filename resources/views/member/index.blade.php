@extends('layouts.app')

@section('title', 'HOME')

@section('contents')

<style>
    .btn-blink{
        background-color: #4CAF50;
        color: white;
        animation: blink 1s linear infinite;
    }

    .btn-blink-disabled {
        /* Gaya berkedip saat dinonaktifkan */
        animation: blink 1s linear infinite;
    }
</style>

<div class="container-fluid">
    <div class="container justify-content-center my-3">
        <h1 class="text-center">MESIN : {{ auth()->user()->id_mch }}</h1>
    </div>
    <hr style="border-color: black">   

    <div class="row">
        {{-- section kiri --}}
        <div class="col-md-2">
            <div class="row mb-4">
                <div class="col">
                    <div class="card shadow" style="border-color:black">
                        <button id="btnJobStart" class="btn btn-lg btn-light btn-block text-center py-5 jobStart btn-blink btn-blink-disabled" data-id="{{ $ljkh->id }}" 
                            data-target="#startJobModal"><strong>JOB START</strong>
                        </button>                            
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="card shadow" style="border-color:black">
                        <button class="btn btn-lg btn-light btn-block text-center py-5 jobEnd" data-id="{{ $ljkh->id }}" 
                        style="color: black"><strong>JOB END</strong></button>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="card shadow" style="border-color: black">
                        <button class="btn btn-lg btn-danger text-center py-5 jobCancel" data-id="{{ $ljkh->id }}" 
                            style="color: white"><strong>CANCEL JOB</strong></button>
                    </div>
                </div>
            </div>
        </div>
        {{-- section tengah --}}
        <div class="col-md-8">
            {{-- current job --}}
            @if ($ljkh->status === 'ready' || $ljkh->status === 'In progress' || $ljkh->status === 'NPK')
            <div class="row mb-3">
                <div class="col-6">
                    <div class="card shadow" style="border-color:black">
                        <div class="card-body">
                            <h4 class="card-title text-center"><strong>CURRENT JOB</strong></h4>
                            <hr style="border-color:black; width:50%; margin:auto; border-width:2px;">
                            <p class="card-text text-left mt-3">PROJECT : <strong>{{ $ljkh->project }}</strong></p>
                            <hr style="border-color:black;">
                            <p class="card-text text-left mt-3">ID JOB : <strong>{{ $ljkh->id_job }}</strong></p>
                            <hr style="border-color:black;">
                            <p class="card-text text-left">ID MACHINING : <strong>{{ $ljkh->id_mch }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow" style="border-color:black; height:100%">
                        <div class="card-body ">
                            <h4 class="card-title text-center"><strong>JOB DESC</strong></h4>
                            <hr style="border-color:black; width:50%; margin:auto; border-width:2px;">
                            <p class="card-text text-left mt-3">DIE PART : <strong>{{ $ljkh->die_part }}</strong></p>
                            <hr style="border-color:black;">
                            <p class="card-text text-left">TASK NAME : <strong>{{ $ljkh->activity_name }}</strong></p>
                            <hr style="border-color:black;">
                            <p class="card-text text-left">STATUS : <strong>{{ $ljkh->status }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3 text-center">
                <div class="col-3">
                    <div class="card shadow" style="border-color:black;">
                        <div class="card-body">
                            <h7 class="card-title text-center"><strong>DATE START</strong></h7>
                            <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                            <p class="card-text text-center mt-3" style="font-size: 15px">{{ $ljkh->Date }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card shadow" style="border-color:black;">
                        <div class="card-body">
                            <h7 class="card-title text-center"><strong>TIME START</strong></h7>
                            <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                            <p class="card-text text-center mt-3" style="font-size: 15px">{{ $ljkh->start }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card shadow" style="border-color:black;">
                        <div class="card-body">
                            <h7 class="card-title text-center"><strong>LEAD TIME</strong></h7>
                            <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                            <p class="card-text text-center mt-3" style="font-size: 15px" data-id="{{ $jobList->id }}">{{ $jobList->lead_time }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card shadow" style="border-color:black;">
                        <div class="card-body">
                            <h7 class="card-title text-center"><strong>DURATION</strong></h7>
                            <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                            <p id="durationTime" class="card-text text-center mt-3" style="font-size: 15px">00:00:00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                @if ($ljkh->note)
                <div class="col">
                    <div class="card shadow" style="border-color: black">
                        <div class="card-body">
                            <h4 class="card-title text-center"><strong>INFORMASI SHIFT</strong></h4>
                            <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                            <h5 class="text-center mt-3">{{ $ljkh->note }}</h5>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                    <div class="card shadow" style="border-color: black">
                        <div class="card-body">
                            <h4 class="card-title text-center"><strong>INFORMASI SHIFT</strong></h4>
                            <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                            <h5 class="text-center mt-3">Tidak Ada Catatan Dari Shift Sebelumnya</h5>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @else
            <div class="row mb-3">
                <div class="col-6">
                    <div class="card shadow" style="border-color: black">
                        <div class="card-body">
                        <h4 class="card-title text-center"><strong>CURRENT JOB</strong></h4>
                        <hr style="border-color:black; margin:auto; width:50%; border-width:2px;">
                        <p class="card-text text-center mt-3">TIDAK ADA PEKERJAAN SAAT INI</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow" style="border-color:black">
                        <div class="card-body ">
                            <h4 class="card-title text-center"><strong>STATUS</strong></h4>
                            <hr style="border-color:black; width:50%; margin:auto; border-width:2px;">
                            <p class="card-text text-center mt-3">TIDAK ADA PEKERJAAN SAAT INI</p> 
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        {{-- section kanan --}}
        <div class="col-md-2">
            <div class="row mb-4">
                <div class="col">
                    <div class="card shadow" style="border-color:black">
                        <button id="btnAutoRun" class="btn btn-lg btn-primary btn-block text-center py-5 autoRun btn-blinkAutoRun"
                        style="color: white"><strong>AUTO RUN</strong></button>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <button href="#" class="btn btn-warning text-center py-5 btn-block" style="color: black; border-color:black; padding: 0;" 
                            data-toggle="modal" data-target="#downtimeModal"><strong>DOWNTIME</strong></button>
                        </div>
                        <div class="col-md-6">
                            <button href="#" class="btn btn-secondary text-center py-5 btn-block" style="color: white; border-color:black" 
                            data-toggle="modal" data-target="#idleModal"><strong>IDLE</strong></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="card shadow" style="border-color: black">
                        <button href="#" class="btn btn-lg text-center py-5 jobList" style="color: black" data-id="{{ $ljkh->job_id }}">
                            <strong>JOB LIST</strong></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function() {
        var blinkInterval;

        function startBlink() {
            blinkInterval = setInterval(function() {
                $('.jobStart').toggleClass('btn-blink');
            }, 500);
        }

        function stopBlink() {
            clearInterval(blinkInterval);
            $('.jobStart').removeClass('btn-blink');
        }

        $('.jobStart').on('click', function(e) {
            e.preventDefault();
            startBlink()
        });

        $('.jobEnd').on('click', function(e) {
            e.preventDefault();
            stopBlink();
        });
    });
</script> --}}

@include('member.modal')
@include('member.script')

@endsection
