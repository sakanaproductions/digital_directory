@extends('layouts.app')

@section('title', '| Add Building')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-building'></i> Add Building</h1>
    <hr>

    {{ Form::open(array('url' => 'buildings')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image') }}
    </div>

    <div class="form-group">
        {{ Form::label('floors', 'Floors') }}
        {{ Form::selectRange('floors', 1, 100) }}
    </div>

    <div class="form-group">
        {{ Form::label('address1', 'Address 1') }}
        {{ Form::text('address1', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('address2', 'Address 2') }}
        {{ Form::text('address2', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City') }}
        {{ Form::text('city', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('state', 'State') }}
        {{ Form::text('state', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('postal_code', __('buildings.postal_code')) }}
        {{ Form::text('postal_code', '', array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection