<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Perbaikan PJU</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: 'times new roman';
            font-size: 12px;
        }

        .page_break {
            page-break-before: always;
        }

        table.table_custom th,
        table.table_custom td {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid;
            padding: 5px;
            width: 100%;
        }
    </style>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> --}}
</head>

<body>
    <main class="mt-0">
        {{-- laporan masyarakat --}}
        <table class="" style="font-size: 16px; padding:5px; width:100%; border:0px;">
            <tr>
                <td style="width: 30%">
                    <img style="width: 100%;" src="{{ public_path('img') }}/logo.png">
                </td>
                <td class="text-center" style="width: 50%"><b>TAMAN WISATA<br>
                        LOTUS GARDEN</b><br>
                    Merauke - Papua Selatan
                </td>
                <td style="width: 30%"></td>
            </tr>
        </table>
        <hr style="border: 1px solid black;">
        <div class="my-3">
            <strong>Laporan Pemesanan Tiket</strong>
        </div>

        <table class="table_custom" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Kunjungan</th>
                    <th>code</th>
                    <th>Nama</th>
                    <th>No. HP/WA</th>
                    <th>Dewasa</th>
                    <th>Anak-anak</th>
                    <th>Harga</th>
                    <th>Booking</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->barcode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->jumlah_dewasa }}</td>
                        <td>{{ $item->jumlah_anak }}</td>
                        <td>Rp{{ number_format($item->total_harga) }}</td>
                        <td>
                            <ol style="padding-left:10px;font-size:10px;">
                                @foreach (App\Models\TiketItems::with(['fasilitas'])->where('id_tiket', $item->id)->get() as $list)
                                    <li>{{ $list->fasilitas->nama }}</li>
                                @endforeach
                            </ol>
                            @if (App\Models\TiketItems::with(['fasilitas'])->where('id_tiket', $item->id)->count() == 0)
                                -
                            @endif
                        </td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </main>

</body>

</html>
