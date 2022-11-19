@extends('layouts.app')

{{-- Only logged users should see profiles --}}

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $manager = App\Http\Controllers\ManagerController::getManagerById($id);
@endphp

@section('content')
  <section id="about-section" class="pt-5 pb-5">
    <div class="container wrapabout">
        <div class="red"></div>
        <div class="row">
            <div class="col-lg-6 align-items-center justify-content-left d-flex mb-5 mb-lg-0">
                <div class="blockabout">
                    <div class="blockabout-inner text-center text-sm-start">
                        <div class="title-big pb-3 mb-3">
                            <h3>{{ $manager['name']}}</h3>
                        </div>
                        <p class="description-p text-muted pe-0 pe-lg-0">
                           Email: {{ $manager['email']}}
                        </p>
                        <a href="#" class="btn rey-btn mt-3">See More</a>
                    </div>
                </div>
            </div>
</section>
        
@endsection
