@php
    $cp = $client->contatos_prioridade;
@endphp
<div class="row">
    <div class="col-md-12">
        <table class="table-responsive table-bordered table-striped" style="min-width: 100%">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Grau de Parentesco</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Telefone Comercial</th>
                <th>Telefone Residencial</th>

            </tr>
            </thead>
            <tbody>
            @forelse($cp as $prioritarios)
                @if(!empty($prioritarios->nome))
                    <tr>
                        <td>{{ucwords($prioritarios->nome)}}</td>
                        <td>{{$prioritarios->parentesco_grau}}</td>
                        <td><a href="mailto:{{$prioritarios->email}}">{{$prioritarios->email}}</a></td>
                        <td>{{$prioritarios->tel_cel}}</td>
                        <td>{{$prioritarios->tel_com}}</td>
                        <td>{{$prioritarios->tel_res}}</td>
                    </tr>
                @endif
            @empty
                <td colspan="6">Nenhum Contato Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>