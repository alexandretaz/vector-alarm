@php
    $ca = $client->contatos_autorizados;
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
            @forelse($ca as $autorizados)
                @if(!empty($autorizados->nome))
                    <tr>
                        <td>{{ucwords($autorizados->nome)}}</td>
                        <td>{{$autorizados->parentesco_grau}}</td>
                        <td><a href="mailto:{{$autorizados->email}}">{{$autorizados->email}}</a></td>
                        <td>{{$autorizados->tel_cel}}</td>
                        <td>{{$autorizados->tel_com}}</td>
                        <td>{{$autorizados->tel_res}}</td>
                    </tr>
                @endif
            @empty
                <td colspan="6">Nenhum Contato Cadastrado</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>