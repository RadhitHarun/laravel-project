@extends('layouts.app')

@section('title', 'HOME')

@section('contents')
<style>
     .centered-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Mengisi tinggi seluruh viewport */
        }
</style>


<div class="container-fluid centered-text">
    <div class="row">
        <div class="col">
            <h1><strong><i>WELCOME TO MACHINING SECTION</i></strong></h1>
        </div>
    </div>
</div>
@endsection