@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Configurações do Alarme (todos os tempos aqui devem ser escritos em segundos)</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('config.update') }}">
                            {{ csrf_field() }}
                            @if(!empty($config->id))
                                <input type="hidden" name="id" value="{{$config->id}}">
                            @endif
                            <div class="form-group{{ $errors->has('start_panic') ? ' has-error' : '' }}">
                                <label for="startPanic" class="col-md-4 control-label">Tempo para enviar a primeira marcação de pânico</label>

                                <div class="col-md-6">
                                    <input id="starPanic" type="number" class="form-control" name="start_panic" value="{{$config->start_panic}}" required>


                                    @if ($errors->has('start_panic'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_panic') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('start_help') ? ' has-error' : '' }}">
                                <label for="startHelp" class="col-md-4 control-label">Tempo para enviar a primeira marcação de ajuda</label>

                                <div class="col-md-6">
                                    <input id="starHelp" type="number" class="form-control" name="start_help" value="{{$config->start_help}}" required>


                                    @if ($errors->has('start_help'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_help') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('updated_panic') ? ' has-error' : '' }}">
                                <label for="updatePanic" class="col-md-4 control-label">Tempo para atualizar a posição de um alarme de pânico</label>

                                <div class="col-md-6">
                                    <input id="updatePanic" type="number" class="form-control" name="update_panic" value="{{$config->update_panic}}" required>


                                    @if ($errors->has('update_panic'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('update_panic') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('update_help') ? ' has-error' : '' }}">
                                <label for="updateHelp" class="col-md-4 control-label">Tempo para atualizar a posição de um alarme de ajuda</label>

                                <div class="col-md-6">
                                    <input id="starhelp" type="number" class="form-control" name="update_help" value="{{$config->update_help}}" required>


                                    @if ($errors->has('update_help'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('update_help') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tell_to_call') ? ' has-error' : '' }}">
                                <label for="tellToCall" class="col-md-4 control-label">Telefone para a chamada de ajuda</label>

                                <div class="col-md-6">
                                    <input id="tellToCall" type="string" class="form-control" name="tell_to_call" value="{{$config->tell_to_call}}" required>


                                    @if ($errors->has('tell_to_call'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tell_to_call') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Gravar Configuração
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
