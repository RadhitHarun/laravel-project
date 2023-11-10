            {{-- job status --}}
            <div class="row">
                <div class="col">
                    <div class="card shadow" style="border-color:black">
                        <div class="card-body">
                            <h4 class="card-title text-center"><strong>JOB STATUS</strong></h4>
                            <hr style="border-color:black; width:10rem; margin:auto; border-width:2px;">
                            <div class="row">
                                <div class="col" >
                                    <p class="card-text text-left mt-3">ID JOB :</p>
                                    <hr style="border-color:black">
                                    <p class="card-text text-left">ID MACHINING :</p>
                                    <hr style="border-color:black">
                                    <p class="card-text text-left">DIE PART :</p>
                                    <hr style="border-color:black">
                                    <p class="card-text text-left">TASK NAME :</p>
                                </div>
                                <div class="col">
                                    @if($ljkh)
                                    <p class="card-text text-left mt-3">TIME START : {{ $ljkh->start }}</p> 
                                    <hr style="border-color:black">
                                    <p class="card-text text-left">TIME END : {{ $ljkh->stop }}</p>
                                    @else
                                    <p class="card-tect text-left mt-3">TIME START : Belom ada job yang dimulai</p>
                                    <hr style="border-color:black">
                                    <p class="card-tect text-left mt-3">TIME END : Belom ada job yang dimulai</p>
                                    @endif
                                    <hr style="border-color:black">
                                    <p class="card-text text-left">TIME TAKEN :</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>