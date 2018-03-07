<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Dependentes</h2></div>
                <div class="panel-body">
                    @if(!empty($client->dependents))
                        <table class="table-striped table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Grau de Parentesco</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach($client->dependents as $dependent)
                                <tr>
                                    <td>{{$dependent->name}}</td>
                                    <td>{{$dependent->grau_parentesco}}</td>
                                    <td><a href="/client/{{$dependent->id}}/edit">Editar</a><br><a href="/client/{{$dependent->id}}/delete">Apagar</a></td>
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