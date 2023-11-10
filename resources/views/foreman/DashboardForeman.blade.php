@extends('layouts.app')

@section('title', 'Current-Process')

@section('contents')
    <div class="container-fluid">
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow" style="border-radius: 15px">
                        <h2 class="text-center "><strong><i>CURRENT PROCESS - MACHINING</i></strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border-color: black">
        <div class="card shadow">
            <div class="card-body">
                <div class="row justify-content-center mb-3">
                    <div class="col-sm-3">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="card-title text-center"><strong>302</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin302)
                                <h4 class="text-center">{{ $mesin302->activity_name }}</h4>
                                <h6 class="text-center"style="background-color: 
                                {{ $mesin302->status === 'In progress' ? 'green' : 'red' }}">{{ $mesin302->status }}</h6>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="card-title text-center"><strong>303</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin303)
                                <h4 class="text-center">{{ $mesin303->status }}</h4>
                                <h6 class="text-center" style="background-color: 
                                {{ $mesin303->status === 'In progress' ? 'green' : 'red' }}">{{ $mesin303->status }}</h6>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="text-center"><strong>304</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin304)
                                <h4 class="text-center">{{ $mesin304->activity_name }}</h4>
                                <h6 class="text-center" style="background-color: 
                                {{ $mesin304->status === 'In progress' ? 'green' : 'red' }}">{{ $mesin304->status }}</h6>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-dark">
                            <div class="card-body">
                                <h3 class="text-center"><strong>317</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin317)
                                <p class="text-center">{{ $mesin317->activity_name }}</p>
                                <p class="text-center" style="background-color: 
                                {{ $mesin317->status === 'In progress' ? 'green' : 'red' }}">{{ $mesin317->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-sm-3">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="text-center"><strong>322</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin322)
                                <p class="text-center">{{ $mesin322->activity_name }}</p>
                                <p class="text-center" style="background-color: 
                                {{ $mesin322->status === 'In progress' ? 'green' : 'red' }}">{{ $mesin322->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="text-center"><strong>323</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin323)
                                <p class="text-center">{{ $msin323->activity_name }}</p>
                                <p class="text-center" style="background-color: 
                                {{ $mesin323->status === 'In progress' ? 'green' : 'red' }}">{{ $msin323->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="text-center"><strong>325</strong></h3>
                                <hr style="border-color: black">
                                @if($mesin325)
                                <p class="text-center">{{ $mesin325->activity_name }}</p>
                                <p class="text-center text-light" style="background-color: 
                                {{ $mesin325->status === 'In progress' ? 'green' : 'red' }}">{{ $mesin325->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card border-dark">
                            <div class="card-body">
                                <h3 class="text-center"><strong>MCR BIII</strong></h3>
                                <hr style="border-color: black">
                                @if($mesinMCRBIII)
                                <p class="text-center">{{ $mesinMCRBIII->activity_name }}</p>
                                <p class="text-center"style="background-color: 
                                {{ $mesinMCRBIII->status === 'In progress' ? 'green' : 'red' }}">{{ $mesinMCRBIII->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="card border-dark">
                            <div class="card-body">
                                <h3 class="text-center"><strong>OKAMOTO</strong></h3>
                                <hr style="border-color: black">
                                @if($mesinOkamoto)
                                <p class="text-center">{{ $mesinOkamoto->activity_name }}</p>
                                <p class="text-center" style="background-color: 
                                {{ $mesinOkamoto->status === 'In progress' ? 'green' : 'red' }}">{{ $mesinOkamoto->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card border-dark mb-2">
                            <div class="card-body">
                                <h3 class="text-center"><strong>EQUIPTOP</strong></h3>
                                <hr style="border-color: black">
                                @if($mesinEquiptop)
                                <p class="text-center">{{ $mesinEquiptop->activity_name }}</p>
                                <p class="text-center" style="background-color: 
                                {{ $mesinEquiptop->status === 'In progress' ? 'green' : 'red' }}">{{ $mesinEquiptop->status }}</p>
                                @else
                                <p class="text-center">Tidak Ada Task Saat Ini</p>
                                @endif
                                <a href="" class="btn btn-block btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection