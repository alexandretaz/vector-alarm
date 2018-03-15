@php
if(!empty($client->contatos_prioridade))
    $cp = $client->contatos_prioridade;
else
$cp =[];
@endphp
<div class="row">
    <div class="col-md-12">
        <p><a href="{{route('contato_prioridade.add',['clientId'=>$client->id])}}" class="btn btn-primary">Adicionar Contato Prioritario</a></p></p>
        <table class="table-responsive table-bordered table-striped" style="min-width: 100%">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Grau de Parentesco</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Telefone Comercial</th>
                <th>Telefone Residencial</th>
                <th>Ações</th>

            </tr>
            </thead>
            <tbody>
            @forelse($cp as $indexPrioritario=>$prioritarios)
                @if(!empty($prioritarios->nome))
                    <tr>
                        <td>{{ucwords($prioritarios->nome)}}</td>
                        <td>{{$prioritarios->parentesco_grau}}</td>
                        <td><a href="mailto:{{$prioritarios->email}}">{{$prioritarios->email}}</a></td>
                        <td>{{$prioritarios->tel_cel}}</td>
                        <td>{{$prioritarios->tel_com}}</td>
                        <td>{{$prioritarios->tel_res}}</td>
                        <td>
                            <ul class="list-group">
                                <li class="list-group-item"><a class="btn btn-info" href="{{route('contato_prioridade.edit',['clientId'=>$client->id, 'postion'=>$indexPrioritario])}}">Editar</a></li>
                                <li class="list-group-item"><a class="btn btn-danger" href="{{route('contato_prioridade.delete',['clientId'=>$client->id, 'position'=>$indexPrioritario])}}">Apagar</a></li>
                            </ul>
                        </td>
                    </tr>
                @endif
            @empty
                <td colspan="6">Nenhum Contato Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>