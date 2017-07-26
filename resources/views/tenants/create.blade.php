@extends('layouts.app')

@section('title', '| Add Buidling')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-building'></i> Add Tenant to {{ $building->name }}</h1>
    <hr>

    {{ Form::open(array('url' => 'tenants')) }}

    {{ Form::hidden('building_id', $building->id) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image') }}
    </div>

    <div class="form-group">
        {{ Form::label('floor', 'Floor') }}
        {{ Form::selectRange('floor', 1, 100) }}
    </div>

    <div class="form-group">
        {{ Form::label('unit', 'Unit') }}
        {{ Form::text('unit', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('phone', 'Phone') }}
        {{ Form::text('phone', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', '', array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection