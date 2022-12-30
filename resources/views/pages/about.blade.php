@extends('layouts.app')

@section('content')
<div class="h-100 d-flex align-items-center justify-content-center">
    <h1 class="md-3 px-10">Made By:</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 align-items-stretch">
            <div class="card mb-4">
                <div class="card-body text-center">
                            <img src= "/images/profile/default.png" class="figure-img img-fluid category" alt="Dev Image" width="150" height="150">
                        <h5>Miguel Tavares</h5>
                    </div>
              </div>
        </div>
        <div class="col-lg-4 align-items-stretch">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src= "/images/profile/default.png" class="figure-img img-fluid category" alt="Dev Image" width="150" height="150">
                    <h5>Domingos Santos</h5>
                </div>
              </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-4 align-items-stretch">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src= "/images/profile/default.png" class="figure-img img-fluid category" alt="Dev Image" width="150" height="150">
                        <h5>João Félix</h5>
                </div>
              </div>
        </div>
        <div class="col-lg-4 align-items-stretch ">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src= "/images/profile/default.png" class="figure-img img-fluid category" alt="Dev Image" width="150" height="150">
                        <h5>Gonçalo Ferreira</h5>
                </div>
              </div>
        </div>
        </div>
    </div>
</div>
@endsection