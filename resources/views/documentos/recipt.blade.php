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
                Data: {{ date('d-M-Y') }}
                Estado: Pago
                </pre>


            </td>
            <td align="center">
                <img src="{{ asset('imglogo/pp.jpg') }}" alt="Logo" width="100" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">

                <h3>{{config('company.name')}}</h3>
                <pre>
                    {{config('company.address')}}
                    @if(config('company.contact'))  Cell: {{config('company.contact')}} <br> @endif
                    @if(config('company.fax'))  Fax: {{config('company.fax')}} <br> @endif
                    @if(config('company.country'))  {{config('company.country')}} <br> @endif
                    @if(config('company.email'))  Email: {{config('company.email')}} <br> @endif
                    @if(config('company.nuit'))  {{config('company.nuit')}} <br> @endif
                    Operador: {{Auth::user()->name}}
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
            @php($n=$n+$iten->quantidade)
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
            <td align="left" class="gray">0 Mt</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td align="left"></td>
            <td align="left">Sub-Total</td>
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
                {{config('company.name')}}
            </td>
        </tr>

    </table>
</div>
</body>
</html>
