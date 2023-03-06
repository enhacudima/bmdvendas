<div class="panel panel-default">

    <div class="panel-heading">
        <h4>vendas</h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tipo de venda</th>
            <th scope="col">Detalhes</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($client->vendas))
        @foreach($client->vendas as $cil)
            @if(!empty($cil->caixa))
                <tr>
                <td>
                    <a class="btn btn btn-success btn-xs" href="{{action('ClienteController@clienteshow', $cil->id)}}">
                        <i class="fa fa-eye fa-fw"></i> {{$cil->codigo_venda}}
                    </a>
                </td>
                <td>{{$cil->form_type}}</td>
                <td>
                    <table class="table  table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Peço</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                    @foreach ($cil->caixa as $key => $produt )
                                        <td>{{++$key}}</td>
                                        <td>{{$produt->produtos->name}}</td>
                                        <td>{{$produt->produtos->brand}}</td>
                                        <td>{{$produt->quantidade}}</td>
                                        <td>{{$produt->price_unit}}</td>
                                        <td>{{$produt->quantidade * $produt->price_unit }}</td>
                                    @endforeach
                            </tr>
                        </tbody>
                    </table>
                </td>
                </tr>
            @endif
        @endforeach
        @endif
        </tbody>
    </table>
    </div>
</div>
</div>

<script>

    $(document).ready(function() {
        $('#reclatodas').DataTable( {

            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 0, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print'
            ],

        }
        );
    } );
</script>
