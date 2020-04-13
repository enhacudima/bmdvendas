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
            background-color: #60A7A6;
            color: #FFF;
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
            <td align="left" style="width: 40%;">
                <h3>{{$itens[0]->nome}} {{$itens[0]->apelido}}</h3>
                <pre>
Estrada Nacional EN1
Cell: (+258) 84 150 003 1<br>
Fixo: (+258) 82 150 003 1<br>
Email: pelosepatas@gmail.com<br>
<br />
Date: {{ date('d-M-Y') }}
Estado: Pago
</pre>


            </td>
            <td align="center">
                <img src="{{ asset('imglogo/pp.jpg') }}" alt="Logo" width="200" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">

                <h3>Pelos & Patas</h3>
                <pre>
                    https://pataspelos.com

                    Av. de Moçambique,
                    Bairro do Zimpeto
                    Maputo Cidade
                    Moçambique
                </pre>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>Recibo #{{$itens[0]->codigo_venda}}</h3>
    <table width="100%" align="left">
        <thead>
        <tr>
            <th align="left">Descrição</th>
            <th align="left">Codigo</th>
            <th align="left">Preço Únitario</th>
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
            <td>{{$iten->codigoproduto}}</td>
            <td>{{number_format(round($iten->preco_final,2), 2, ',', ' ')}}</td>
            <td>{{$iten->quantidade}}</td>
            @php($st=($iten->preco_final*$iten->quantidade))
            @php($n=$n+1)
            <td>{{number_format(round($st,2), 2, ',', ' ')}} Mt</td>
            @php($t=$st+$t)
        </tr>
        @endforeach
        @endif
        </tbody>

        <tfoot>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left">Total</td>
            <td align="left">{{$n}}</td>
            <td align="left" class="gray">{{number_format(round($t,2), 2, ',', ' ')}} Mt</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
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
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left"></td>
            <td align="left" class="gray"></td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left">IVA</td>
            <td align="left" class="gray">{{number_format(round($t*0.17,2), 2, ',', ' ')}} Mt</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left">Sub-Total</td>
            <td align="left" class="gray">{{number_format(round($t-($t*0.17),2), 2, ',', ' ')}} Mt</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
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
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left"></td>
            <td align="left" class="gray"></td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left">Pago</td>
            <td align="left" class="gray">{{number_format(round($trocos->total_pago,2), 2, ',', ' ')}} Mt</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left">A Pagar</td>
            <td align="left" class="gray">{{number_format(round($trocos->total_porpagar,2), 2, ',', ' ')}} Mt</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left">Troco</td>
            <td align="left" class="gray">{{number_format(round($trocos->total_troco,2), 2, ',', ' ')}} Mt</td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Pelos & Patas
            </td>
        </tr>

    </table>
</div>
</body>
</html>
