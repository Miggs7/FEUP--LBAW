@extends('layouts.app')

{{-- Only logged users should see profiles --}}
@if (!Auth::user())
    @php die(header('Location: /'));
    echo 'This is not your profile!'
    @endphp
@endif

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $user = App\Http\Controllers\UserController::getUserById($id);
@endphp

@section('content')
<div>This is the {{ $user['name']}}'s Profile Page</div>
@endsection