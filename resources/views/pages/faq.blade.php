@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center align-items-center my-5">
    <h1 class="md-3 justify-content-center px-10">FAQ</h1>
</div>
<div class="row row-cols-1 row-cols-md-3">
    <div class="col-6 mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <h5 class="card-title">How much time do I have to pay for my items?</h5>
          <p class="card-text">All items must be paid in full within 24 hours of winning the item.</p>
        </div>
      </div>
    </div>
    <div class="col-6 mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <h5 class="card-title">Do you ship items?</h5>
          <p class="card-text">We do not provide shipping, however we will prepare items for shipping and load trucks for a fee. While it is the buyer’s responsibility to arrange shipping, we are happy to provide resources to help facilitate the process.</p>
        </div>
      </div>
    </div>
    <div class="col-md mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <h5 class="card-title">Can you help me sell my equipment?</h5>
          <p class="card-text">We are a full service company that will make every effort to help you sell your equipment.</p>
        </div>
      </div>
    </div>
</div>
</div>
@endsection