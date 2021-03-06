<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Dependentes</h2></div>
                <div class="panel-body">
                    <p><a href="{{route('client.dependent.add', ['clientId'=> $client->id])}}" class="btn btn-primary">Adicionar Dependente</a> </p>
                    @if(!empty($client->dependents))
                        <table class="table-striped table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Grau de Parentesco</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach($client->dependents as $dependent)
                                <tr>
                                    <td>{{$dependent->code}}</td>
                                    <td>{{$dependent->name}}</td>
                                    <td>{{$dependent->grau_parentesco}}</td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item"> <a href="/client/{{$dependent->id}}/edit" class="btn btn-primary">Editar</a></li>
                                            <li class="list-group-item"><a class="btn btn-danger" href="/client/{{$dependent->id}}/delete">Apagar</a></li>
                                        </ul>
                                    </td>

                                </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>