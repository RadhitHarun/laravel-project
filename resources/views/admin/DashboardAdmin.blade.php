@extends('layouts.app')

@section('title', 'DASHBOARD')

@section('contents')
<div class="container-fluid">
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center"><strong><i>DASHBOARD MACHINING</i></strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border-color: black">
    </div>

    <div class="container">
        <div class="row justify-content-between mb-2">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-2">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection