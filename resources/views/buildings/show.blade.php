@extends('layouts.app')

@section('title', '|', $building->name)

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-building'></i>{{ $building->name }}</h1>
    <a href="{{ action('TenantController@create', ['building' => $building->id]) }}"><i class="fa fa-user-plus"></i>Add Tenant</a><br>
    <hr>

    <address>
        <i class="fa fa-map-marker"></i>
        {{ $building->address1 }}<br>
        @if (isset($building->address2)) 
            {{ $building->address2 }}<br>
        @endif
        {{ $building->city }}, {{ $building->state }} {{ $building->postal_code }}<br>
        <i class="fa fa-phone"></i> <br>
        <i class="fa fa-envelope"></i> <br>

    </address>

    <h2><i class='fa fa-user'></i>Tenants</h2>
    @foreach ($building->tenants as $tenant)
        Floor: {{ $tenant->floor }}<br>
        Unit {{ $tenant->unit }}: {{ $tenant->name }}<br>
    @endforeach
</div>

@endsection