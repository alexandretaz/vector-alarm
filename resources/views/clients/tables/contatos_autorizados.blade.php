@php
if(!empty($client->contatos_autorizados))
    $ca = $client->contatos_autorizados;
else
    $ca =[];
@endphp
<div class="row">
    <div class="col-md-12">
        <p class="right"><a href="{{route('contato_autorizado.add',['clientId'=>$client->id])}}" class="btn btn-primary">Adicionar Contato Autorizado</a></p>
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
            @forelse($ca as $indexAutorizado=>$autorizados)
                @if(!empty($autorizados->nome))
                    <tr>
                        <td>{{ucwords($autorizados->nome)}}</td>
                        <td>{{$autorizados->parentesco_grau}}</td>
                        <td><a href="mailto:{{$autorizados->email}}">{{$autorizados->email}}</a></td>
                        <td>{{$autorizados->tel_cel}}</td>
                        <td>{{$autorizados->tel_com}}</td>
                        <td>{{$autorizados->tel_res}}</td>
                        <td>
                            <ul class="list-group">
                                <li class="list-group-item"><a class="btn btn-info" href="{{route('contato_autorizado.edit',['clientId'=>$client->id, 'position'=>$indexAutorizado])}}">Editar</a></li>
                                <li class="list-group-item"><a class="btn btn-danger" href="{{route('contato_autorizado.delete',['clientId'=>$client->id, 'position'=>$indexAutorizado])}}">Apagar</a></li>
                            </ul>
                        </td>
                    </tr>
                @endif
            @empty
                <td colspan="7">Nenhum Contato Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>