@for ($cp = 0; $cp < 5; $cp++)
    @php
        if(isset($client->contatos_prioridade[$cp])){
            $contato_prioridade = $client->contatos_prioridade[$cp];
        }
        else{
            $contato_prioridade = new \stdClass();
            $contato_prioridade->nome = null;
            $contato_prioridade->parentesco_grau = null;
            $contato_prioridade->tel_com = null;
            $contato_prioridade->tel_cel = null;
            $contato_prioridade->tel_res = null;
            $contato_prioridade->email= null;
        }
        $contato_prioridadeLabel = $cp+1;
    @endphp
    <h4>
        <a @if($cp==0) class="collapsed" @endif role="button" data-toggle="collapse" data-parent="#actel_resdion" href="#heading{{$contato_prioridadeLabel}}"
           aria-expanded="@if($cp==0) true @else false @endif" aria-controls="heading{{$contato_prioridadeLabel}}">
            Contato em Ordem de Prioridade {{$contato_prioridadeLabel}}
        </a>
    </h4>
    <div class="form-group">
        <label for="contato_ordem" class="col-md-4 control-label">Ordem</label>

        <div class="col-md-6">
            <input id="cpPlate" type="number" class="form-control"
                   name="client[contatos_prioridade][{{$cp}}][nome]" value="{{$contato_prioridadeLabel}}">
        </div>
    </div>
    <div class="form-group">
        <label for="cpPlate" class="col-md-4 control-label">Nome</label>

        <div class="col-md-6">
            <input id="cpPlate" type="text" class="form-control"
                   name="client[contatos_prioridade][{{$cp}}][nome]" value="{{$contato_prioridade->nome}}">
        </div>
    </div>
    <div class="form-group">
        <label for="cpparentesco_email" class="col-md-4 control-label">Parentesco/Grau</label>

        <div class="col-md-6">
            <input id="cpparentesco_email" type="text" class="form-control"
                   name="client[contatos_prioridade][{{$cp}}][parentesco_grau]" value="{{$contato_prioridade->parentesco_grau}}">
        </div>
    </div>
    <div class="form-group">
        <label for="cptel_com" class="col-md-4 control-label">Telefone Comercial</label>

        <div class="col-md-6">
            <input id="cptel_com" type="text" class="form-control"
                   name="client[contatos_prioridade][{{$cp}}][tel_com]" value="{{$contato_prioridade->tel_com}}">
        </div>
    </div>
    <div class="form-group">
        <label for="cptel_cel" class="col-md-4 control-label">Telefone Celular</label>

        <div class="col-md-6">
            <input id="cptel_cel" type="text" class="form-control" name="client[contatos_prioridade][{{$cp}}][tel_cel]"
                   value="{{$contato_prioridade->tel_cel}}">
        </div>
    </div>
    <div class="form-group">
        <label for="cptel_res" class="col-md-4 control-label">Telefone Residencial</label>

        <div class="col-md-6">
            <input id="cptel_res" type="text" class="form-control" name="client[contatos_prioridade][{{$cp}}][tel_res]"
                   value="{{$contato_prioridade->tel_res}}">
        </div>
    </div>
    <div class="form-group">
        <label for="cpemail" class="col-md-4 control-label">Email</label>

        <div class="col-md-6">
            <input id="cpemail" type="text" class="form-control" name="client[contatos_prioridade][{{$cp}}][email]"
                   value="{{$contato_prioridade->email}}">
        </div>
    </div>
@endfor
