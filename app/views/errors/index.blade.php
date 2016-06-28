@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h1>Oops!</h1>
    </div>

    <div class='well'>ERROR: {{ $exception->getMessage() }}</div>

@stop