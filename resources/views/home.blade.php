@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <h1>1</h1>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->isContractAdmin())
                        <h2>2</h2>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->isParentUser())
                        <h3>3</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
