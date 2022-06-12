<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Invoice num') }}: {{ $recibo->id }}</title>


    <style>
        @font-face {
            font-family: 'Helvetica';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
        }

        body {
            font-family: Helvetica, sans-serif;
            margin-top: 20px;
        }

        #invoice {
            padding: 0px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }
    </style>


</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">

                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;">
                                            <img src="{{ $user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
                                                width="80" alt="">
                                        </a>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            {{ $user->name }}
                                        </h2>
                                        <div class="email"><a
                                                href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </div>

                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">

                                    <div class="col invoice-to">
                                        <h1 class="invoice-id">{{ __('Invoice num') }}: {{ $recibo->id }}</h1>
                                        <div class="date">{{ __('Date of Invoice') }}:
                                            {{ $recibo->data }}
                                        </div>
                                        <div>
                                            <p>{{ __('Payment details') . ': ' . $tipo_pagamento . ' (' . $ref_pagamento . ')' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{ __('Seat') }}</th>
                                            <th class="text-left">{{ __('Session') }}</th>
                                            <th class="text-right">{{ __('Price no IVA') }}</th>
                                            <th class="text-right">{{ __('% IVA') }}</th>
                                            <th class="text-right">{{ __('Total(With IVA)') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bilhetes as $bilhete)
                                            <tr>
                                                <td class="no">
                                                    {{ $bilhete->lugar->fila . $bilhete->lugar->posicao }} </td>
                                                <td class="text-left">
                                                    <h3>
                                                        {{ $bilhete->sessao->filme->titulo }}
                                                    </h3>
                                                    <p>
                                                        {{ date('d F Y', strtotime($bilhete->sessao->data)) }},
                                                        {{ date('H:i', strtotime($bilhete->sessao->horario_inicio)) }}
                                                    </p>
                                                </td>
                                                <td class="unit">{{ $bilhete->preco_sem_iva }} €</td>
                                                <td class="qty">{{ $conf->percentagem_iva }}%</td>
                                                <td class="total">
                                                    {{ number_format($bilhete->preco_sem_iva * (1 + $conf->percentagem_iva / 100), 2) }}
                                                    €
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{ __('Subtotal') }}</td>
                                            <td>{{ $recibo->preco_total_sem_iva }} €</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{ __('Taxes') }}</td>
                                            <td>{{ $recibo->iva }} €
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{ __('Total(With IVA)') }}</td>
                                            <td>{{ $recibo->preco_total_com_iva }} €</td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="thanks">
                                    <h3>{{ __('Thank you for choosing us!') }}</h3>
                                </div>


                            </main>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
