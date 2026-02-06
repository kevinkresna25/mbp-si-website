<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - {{ $monthName }} {{ $year }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 11px; color: #333; line-height: 1.5; }

        .header { text-align: center; margin-bottom: 25px; border-bottom: 3px solid #059669; padding-bottom: 15px; }
        .header h1 { font-size: 20px; color: #059669; margin-bottom: 3px; }
        .header h2 { font-size: 14px; color: #666; font-weight: normal; }
        .header p { font-size: 10px; color: #999; margin-top: 5px; }

        .section-title { font-size: 13px; font-weight: bold; color: #059669; margin: 20px 0 10px; padding-bottom: 5px; border-bottom: 1px solid #d1d5db; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th { background-color: #059669; color: white; font-weight: bold; text-align: left; padding: 8px 10px; font-size: 10px; text-transform: uppercase; }
        td { padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 10px; }
        tr:nth-child(even) td { background-color: #f9fafb; }

        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .text-green { color: #059669; }
        .text-red { color: #dc2626; }

        .summary-table td { padding: 8px 10px; }
        .summary-table .total-row { background-color: #ecfdf5; font-weight: bold; }
        .summary-table .total-row td { border-top: 2px solid #059669; font-size: 11px; }

        .balance-box { background-color: #ecfdf5; border: 2px solid #059669; border-radius: 5px; padding: 15px; text-align: center; margin: 15px 0; }
        .balance-box .amount { font-size: 22px; font-weight: bold; color: #059669; }
        .balance-box .label { font-size: 10px; color: #666; text-transform: uppercase; letter-spacing: 1px; }

        .footer { margin-top: 30px; text-align: center; font-size: 9px; color: #999; border-top: 1px solid #e5e7eb; padding-top: 10px; }

        .two-col { overflow: hidden; }
        .col-left { float: left; width: 48%; }
        .col-right { float: right; width: 48%; }

        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h1>MASJID BUKIT PALMA</h1>
        <h2>Laporan Keuangan Bulanan</h2>
        <p>Periode: {{ $monthName }} {{ $year }} | Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Total Balance --}}
    <div class="balance-box">
        <div class="label">Total Saldo Keseluruhan</div>
        <div class="amount">Rp {{ number_format($balances['total_balance'], 0, ',', '.') }}</div>
    </div>

    {{-- Balance per Category --}}
    <div class="section-title">Saldo Per Kategori ZISWAF</div>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th class="text-right">Total Pemasukan</th>
                <th class="text-right">Total Pengeluaran</th>
                <th class="text-right">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($balances['categories'] as $cat)
                <tr>
                    <td class="font-bold">{{ $cat['label'] }}</td>
                    <td class="text-right text-green">Rp {{ number_format($cat['debit'], 0, ',', '.') }}</td>
                    <td class="text-right text-red">Rp {{ number_format($cat['credit'], 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($cat['balance'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #ecfdf5;">
                <td class="font-bold" style="border-top: 2px solid #059669;">TOTAL</td>
                <td class="text-right font-bold text-green" style="border-top: 2px solid #059669;">Rp {{ number_format($balances['total_debit'], 0, ',', '.') }}</td>
                <td class="text-right font-bold text-red" style="border-top: 2px solid #059669;">Rp {{ number_format($balances['total_credit'], 0, ',', '.') }}</td>
                <td class="text-right font-bold" style="border-top: 2px solid #059669;">Rp {{ number_format($balances['total_balance'], 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    {{-- Monthly Summary --}}
    <div class="section-title">Ringkasan {{ $monthName }} {{ $year }}</div>
    <table class="summary-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th class="text-right">Pemasukan</th>
                <th class="text-right">Pengeluaran</th>
                <th class="text-right">Saldo Bulan Ini</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report['summary'] as $key => $item)
                <tr>
                    <td>{{ $item['label'] }}</td>
                    <td class="text-right text-green">Rp {{ number_format($item['debit'], 0, ',', '.') }}</td>
                    <td class="text-right text-red">Rp {{ number_format($item['credit'], 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td class="font-bold">TOTAL BULAN INI</td>
                <td class="text-right font-bold text-green">Rp {{ number_format($report['total_debit'], 0, ',', '.') }}</td>
                <td class="text-right font-bold text-red">Rp {{ number_format($report['total_credit'], 0, ',', '.') }}</td>
                <td class="text-right font-bold">Rp {{ number_format($report['total_debit'] - $report['total_credit'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Transaction Details --}}
    @if($report['transactions']->count() > 0)
    <div class="section-title">Detail Transaksi {{ $monthName }} {{ $year }}</div>
    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 10%;">Jenis</th>
                <th style="width: 15%;">Kategori</th>
                <th style="width: 30%;">Keterangan</th>
                <th style="width: 15%;" class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report['transactions'] as $trx)
                <tr>
                    <td>{{ $trx->tanggal->format('d/m/Y') }}</td>
                    <td>
                        <span class="{{ $trx->type->value === 'debit' ? 'text-green' : 'text-red' }}">
                            {{ $trx->type->label() }}
                        </span>
                    </td>
                    <td>{{ $trx->category_ziswaf->label() }}</td>
                    <td>{{ $trx->category_detail }}{{ $trx->keterangan ? ' - ' . $trx->keterangan : '' }}</td>
                    <td class="text-right font-bold {{ $trx->type->value === 'debit' ? 'text-green' : 'text-red' }}">
                        Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; color: #999; padding: 20px;">Tidak ada transaksi pada periode ini.</p>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem Informasi Masjid Bukit Palma.</p>
        <p>Laporan ini bersifat transparan dan dapat diakses oleh seluruh jamaah.</p>
    </div>
</body>
</html>
