@for ($ca = 0; $ca < 5; $ca++)
    @php
        if(isset($client->contatos_prioridade[$ca])){
            $contatos_autorizados = $client->contatos_autorizados[$ca];
        }
        else{
            $contatos_autorizados = new \stdClass();
            $contatos_autorizados->nome = null;
            $contatos_autorizados->parentesco_grau = null;
            $contatos_autorizados->tel_com = null;
            $contatos_autorizados->tel_cel = null;
            $contatos_autorizados->tel_res = null;
            $contatos_autorizados->email= null;
        }
        $contatos_autorizadosLabel = $ca+1;
    @endphp
    <h4>
        <a @if($ca==0) class="collapsed" @endif role="button" data-toggle="collapse" data-parent="#actel_resdion" href="#heading{{$contatos_autorizadosLabel}}"
           aria-expanded="@if($ca==0) true @else false @endif" aria-controls="heading{{$contatos_autorizadosLabel}}">
            Contato em Ordem de Prioridade {{$contatos_autorizadosLabel}}
        </a>
    </h4>
    <div class="form-group">
        <label for="contato_ordem" class="col-md-4 control-label">Ordem</label>

    </div>
    <div class="form-group">
        <label for="caNome" class="col-md-4 control-label">Nome</label>

        <div class="col-md-6">
            <input id="caNome" type="text" class="form-control"
                   name="client[contatos_autorizados][{{$ca}}][nome]" value="{{$contatos_autorizados->nome}}">
        </div>
    </div>
    <div class="form-group">
        <label for="caparentesco_email" class="col-md-4 control-label">Parentesco/Grau</label>

        <div class="col-md-6">
            <input id="caparentesco_email" type="text" class="form-control"
                   name="client[contatos_autorizados][{{$ca}}][parentesco_grau]" value="{{$contatos_autorizados->parentesco_grau}}">
        </div>
    </div>
    <div class="form-group">
        <label for="catel_com" class="col-md-4 control-label">Telefone Comercial</label>

        <div class="col-md-6">
            <input id="catel_com" type="text" class="form-control"
                   name="client[contatos_autorizados][{{$ca}}][tel_com]" value="{{$contatos_autorizados->tel_com}}">
        </div>
    </div>
    <div class="form-group">
        <label for="catel_cel" class="col-md-4 control-label">Telefone Celular</label>

        <div class="col-md-6">
            <input id="catel_cel" type="text" class="form-control" name="client[contatos_autorizados][{{$ca}}][tel_cel]"
                   value="{{$contatos_autorizados->tel_cel}}">
        </div>
    </div>
    <div class="form-group">
        <label for="catel_res" class="col-md-4 control-label">Telefone Residencial</label>

        <div class="col-md-6">
            <input id="catel_res" type="text" class="form-control" name="client[contatos_autorizados][{{$ca}}][tel_res]"
                   value="{{$contatos_autorizados->tel_res}}">
        </div>
    </div>
    <div class="form-group">
        <label for="caemail" class="col-md-4 control-label">Email</label>

        <div class="col-md-6">
            <input id="caemail" type="text" class="form-control" name="client[contatos_autorizados][{{$ca}}][email]"
                   value="{{$contatos_autorizados->email}}">
        </div>
    </div>
@endfor
