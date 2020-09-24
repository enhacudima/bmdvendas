<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{$itens[0]->codigo_venda}}</title>

  <style>
    @page { size: 8cm 20cm portrait; }
  </style>

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
           //* margin: 5px;*/
        }
        .information table {
            /*padding: 10px;*/
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="">
            </td>
            <td align="center">
                <img src="{{ asset('imglogo/pp.jpg') }}" alt="Logo" width="150" class="logo"/><br><br>
                <i>{{$itens[0]->nome}} {{$itens[0]->apelido}}</i><br>
                <i>{{$itens[0]->nuit}}</i><br><br>

                Estrada Nacional EN1<br>
                Cell: (+258) 84 150 003 1<br>
                Fixo: (+258) 82 150 003 1<br>
                Email: pelosepatas@gmail.com<br>
                <br />
                Date: {{ date('d-M-Y H:m') }}<br>
                

            <div class="invoice" >
                <hr>
                <table width="100%" align="left">
                    <thead>
                    <tr>
                        <th align="left">Descrição</th>
                        <th align="left">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($t=0)
                    @php($n=0)
                    @if(null !== $itens)
                    @foreach($itens as $iten)
                    <tr>
                        <td>{{$iten->name}}
                            <br>
                            Uni : {{$iten->quantidade}}
                        </td>
                        @php($st=($iten->preco_final*$iten->quantidade))
                        @php($n=$n+$iten->quantidade)
                        <td>{{number_format(round($st,2), 2, ',', ' ')}} </td>
                        @php($t=$st+$t)
                    </tr>
                    @endforeach
                    @endif
                    </tbody>

                    <tfoot>

                    <tr>
                        <td>Total Uni: {{$n}}</td>
                        <td></td>
                    </tr>    
                    <tr>
                        <td align="left">Total Mt
                        </td>
                        <td align="left" class="gray">{{number_format(round($t,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>

                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left" class="gray"></td>
                    </tr>
                    <tr>
                        <td align="left">Pago Mt</td>
                        <td align="left" class="gray">{{number_format(round($trocos->total_pago,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left">A Pagar Mt</td>
                        <td align="left" class="gray">{{number_format(round($trocos->total_porpagar,2), 2, ',', ' ')}} </td>
                    </tr>
                    <tr>
                        <td align="left">Troco Mt</td>
                        <td align="left" class="gray">{{number_format(round($trocos->total_troco,2), 2, ',', ' ')}} </td>
                    </tr>
                    </tfoot>
                </table>

            </div>
            <hr>
             <i>{{Auth::user()->name}}: {{$itens[0]->codigo_venda}}</i><br>
             <i>Power By Evidevi 840 793 205</i>
            </td>
        </tr>

    </table>
</div>


<br/>

</body>
</html>
