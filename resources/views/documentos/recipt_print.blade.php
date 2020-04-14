<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 0%;">
            </td>
            <td align="center">
                <h3>Pelos & Patas</h3>
                <h3>{{$itens[0]->nome}} {{$itens[0]->apelido}}</h3>
                <pre>
                Estrada Nacional EN1<br>
                Cell: (+258) 84 150 003 1<br>
                Fixo: (+258) 82 150 003 1<br>
                Email: pelosepatas@gmail.com<br>
                <br />
                Date: {{ date('d-M-Y') }}
                Estado: Pago
                </pre>

            <div class="invoice" >
                <h3>#{{$itens[0]->codigo_venda}}</h3>
                <table width="100%" align="left">
                    <thead>
                    <tr>
                        <th align="left">Descrição</th>
                        <th align="left">Quantidade</th>
                        <th align="left">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($t=0)
                    @php($n=0)
                    @if(null !== $itens)
                    @foreach($itens as $iten)
                    <tr>
                        <td>{{$iten->name}}</td>
                        <td>{{$iten->quantidade}}</td>
                        @php($st=($iten->preco_final*$iten->quantidade))
                        @php($n=$n+1)
                        <td>{{number_format(round($st,2), 2, ',', ' ')}} </td>
                        @php($t=$st+$t)
                    </tr>
                    @endforeach
                    @endif
                    </tbody>

                    <tfoot>
                    <tr>
                        <td align="left">Total</td>
                        <td align="left">{{$n}}</td>
                        <td align="left" class="gray">{{number_format(round($t,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">IVA</td>
                        <td align="left" class="gray">{{number_format(round($t*0.17,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">Sub-Total</td>
                        <td align="left" class="gray">{{number_format(round($t-($t*0.17),2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">Pago</td>
                        <td align="left" class="gray">{{number_format(round($trocos->total_pago,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">A Pagar</td>
                        <td align="left" class="gray">{{number_format(round($trocos->total_porpagar,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">Troco</td>
                        <td align="left" class="gray">{{number_format(round($trocos->total_troco,2), 2, ',', ' ')}} </td>
                    </tr>
                    </tfoot>
                </table>
            </div>


            </td>
            <td align="right" style="width: 00%;">
            </td>
        </tr>

    </table>
</div>


<br/>

</body>
</html>
