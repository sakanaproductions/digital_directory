@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Tenants</h3></div>
                    <div class="panel-heading">Page {{ $tenants->currentPage() }} of {{ $tenants->lastPage() }}</div>
                    @foreach ($tenants as $tenant)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('tenants.show', $tenant->id ) }}"><b>{{ $tenant->name }}</b></a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $tenants->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection