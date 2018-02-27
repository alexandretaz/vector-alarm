@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if(!$contract->id)Novo @else Editar @endif Contrato</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('contract.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('client_cnpj') ? ' has-error' : '' }}">
                                <label for="cnpjField" class="col-md-4 control-label">CNPJ</label>

                                <div class="col-md-6">
                                    <input id="cnpjField" type="text" class="form-control" name="client_cnpj" required>

                                    @if ($errors->has('client_cnpj'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('client_cnpj') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('client_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Razão Social</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="client_name" value="{{ old('client_name') }}" required autofocus>

                                    @if ($errors->has('client_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('client_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('client_alias') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Nome Fantasia</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="client_alias" value="{{ old('client_alias') }}" required>

                                    @if ($errors->has('client_alias'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('client_alias') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('number_of_connections') ? ' has-error' : '' }}">
                                <label for="profile.cellnumber" class="col-md-4 control-label">Número de Vips:</label>

                                <div class="col-md-6">
                                    <input id="profileCellnumber" type="text" class="form-control" name="number_of_connections" required>

                                    @if ($errors->has('number_of_connections'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('number_of_connections') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Gravar Contrato
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection