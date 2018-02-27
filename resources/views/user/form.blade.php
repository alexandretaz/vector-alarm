@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Usuário</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}
                        @if(!empty($user->id))
                            <input type="hidden" name="id" value="{{$user->id}}">
                            @endif
                        <div class="form-group{{ $errors->has('profile.full_name') ? ' has-error' : '' }}">
                            <label for="profile.full_name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="profileFullName" type="text" class="form-control" name="profile[full_name]" @if(isset($user->profile->full_name)) value="{{$user->profile->full_name}}" @endif required>

                                @if ($errors->has('profile.full_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('profile.full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email}}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contract-select" class="col-md-4 control-label">Contrato</label>
                            <div class="col-md-6">
                                <select id="contract-select" class="form-control" name="contract_id">
                                    <option value="0">Grupo Vector</option>
                                    @foreach(App\Contract::all() as $contract)

                                    <option value="{{$contract->id}}" @if($contract->id === $user->contract_id) selected="selected" @endif>{{$contract->client_alias}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile.photo') ? ' has-error' : '' }}">
                            <label for="profile.photo" class="col-md-4 control-label">Photo:</label>

                            <div class="col-md-6">
                                <input id="profilePhoto" type="file" class="form-control" name="profile[photo]" @if(isset($user->profile->photo)) value="{{$user->profile->photo}}" @endif>

                                @if ($errors->has('profile.photo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('profile.photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile.cellnumber') ? ' has-error' : '' }}">
                            <label for="profile.cellnumber" class="col-md-4 control-label">Cellphone:</label>

                            <div class="col-md-6">
                                <input id="profileCellnumber" type="text" class="form-control" name="profile[cellnumber]" @if(isset($user->profile->cellnumber)) value="{{$user->profile->cellnumber}}" @endif required>

                                @if ($errors->has('profile.cellnumber'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('profile.cellnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Gravar Usuário
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
