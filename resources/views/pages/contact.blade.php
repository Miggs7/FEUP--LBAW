@extends('layouts.app')

@section('content')


<div class="container">
<div class="d-flex justify-content-center align-items-center my-5">
<h1 class="md-3 justify-content-center" id="contact">Contact Us</h1>
</div>
<div class="row row-cols-1 row-cols-md-3">
    <div class="col-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Address</h5>
          <p class="card-text">1234 Street Name</p>
          <p class="card-text">City, ST 12345</p>
        </div>
      </div>
    </div>
    <div class="col-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Phone</h5>
          <p class="card-text">(123) 456-7890</p>
          <p></p>
        </div>
      </div>
    </div>
    <div class="col-md mb-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Email</h5>
          <p class="card-text">onlineauctions@auction.com</p>
          <p></p>
        </div>
      </div>
    </div>
</div>
</div>

@endsection