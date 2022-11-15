@extends('layouts.app')

@section('content')
<div>This is the {{ Auth::user()->name }} Page</div>
@endsection