@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Buildings</h3></div>
                    <div class="panel-heading">Page {{ $buildings->currentPage() }} of {{ $buildings->lastPage() }}</div>
                    @foreach ($buildings as $bldg)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('buildings.show', $bldg->id ) }}"><b>{{ $bldg->name }}</b></a>
                                <a href="{{ action('TenantController@create', ['building' => $bldg->id]) }}" class="pull-right"><i class="fa fa-user-plus"></i></a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $buildings->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection