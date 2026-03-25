<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $billing->nomor_transaksi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
            margin-top: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: #fff;
            border-radius: 8px;
        }
        .invoice-header {
            border-bottom: 2px solid #0056b3;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .invoice-title {
            color: #0056b3;
            font-weight: bold;
        }
        @media print {
            body { background-color: #fff; margin: 0; }
            .invoice-box { box-shadow: none; border: none; padding: 0; }
            .btn-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="invoice-box">
        <div class="d-flex justify-content-between align-items-center mb-4 btn-print">
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">Kembali</a>
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                <i class="bx bx-printer"></i> Cetak / Simpan PDF
            </button>
        </div>

        <div class="invoice-header d-flex justify-content-between">
            <div>
                <h2 class="invoice-title mb-0">INVOICE</h2>
                <p class="text-muted mb-0">#{{ $billing->nomor_transaksi }}</p>
                <div class="mt-2">
                    <span class="badge {{ $billing->payment_status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ $billing->payment_status == 'paid' ? 'LUNAS' : 'BELUM DIBAYAR' }}
                    </span>
                </div>
            </div>
            <div class="text-end">
                <h4 class="mb-0 fw-bold">WorkSmart ID</h4>
                <p class="text-muted mb-0">Jl. Teknologi No.1, Jakarta</p>
                <p class="text-muted mb-0">cs@worksmart.id</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6">
                <h6 class="text-muted">Ditagihkan Kepada:</h6>
                <h5 class="fw-bold mb-1">{{ $perusahaan->nama_perusahaan }}</h5>
                <div>{!! nl2br(e($perusahaan->deskripsi)) !!}</div>
                <div>{{ $perusahaan->kecamatan }}, {{ $perusahaan->kabupaten }}, {{ $perusahaan->provinsi }}</div>
                <div>WA: {{ $perusahaan->no_wa }}</div>
            </div>
            <div class="col-sm-6 text-sm-end mt-4 mt-sm-0">
                <h6 class="text-muted">Detail Tagihan:</h6>
                <div><strong>Tgl Pesanan:</strong> <br>{{ $billing->created_at->format('d/m/Y H:i') }}</div>
                @if($billing->payment_status == 'paid' && $billing->tanggal_bayar)
                    <div class="mt-2"><strong>Tgl Lunas:</strong> <br>{{ $billing->tanggal_bayar->format('d/m/Y H:i') }}</div>
                @endif
                @if($billing->status == 'expired')
                    <div class="mt-2 text-danger"><strong>Status:</strong> Kedaluwarsa</div>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="text-start">Deskripsi Layanan</th>
                        <th class="text-end" width="30%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>{{ $billing->tipe }}</strong><br>
                            <small class="text-muted">{{ $billing->keterangan }}</small>
                        </td>
                        <td class="text-end align-middle">
                            Rp {{ number_format($billing->nominal, 0, ',', '.') }},-
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-end fs-5">Total Tagihan:</th>
                        <th class="text-end fs-5 text-primary">Rp {{ number_format($billing->nominal_total, 0, ',', '.') }},-</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($billing->payment_status == 'unpaid' && $billing->status != 'expired')
            <div class="alert alert-info mt-4">
                <h6 class="alert-heading fw-bold">Instruksi Pembayaran Manual:</h6>
                <p class="mb-1">Silakan transfer sesuai nominal <strong>Rp {{ number_format($billing->nominal_total, 0, ',', '.') }},-</strong> ke salah satu rekening berikut:</p>
                <ul class="mb-1">
                    <li><strong>Bank BCA:</strong> 123-456-7890 (A/N PT WorkSmart Indonesia)</li>
                    <li><strong>Bank Mandiri:</strong> 098-765-4321 (A/N PT WorkSmart Indonesia)</li>
                </ul>
                <p class="mb-0 text-sm">Gunakan Nomor Transaksi (<strong>{{ $billing->nomor_transaksi }}</strong>) sebagai berita transfer.</p>
            </div>
        @endif

        <div class="text-center mt-5">
            <p class="text-muted">Terima kasih telah menggunakan layanan WorkSmart.</p>
        </div>
    </div>
</div>

<script>
    // Auto-open print dialog when viewing invoice if desired
    // window.onload = function() { window.print(); }
</script>
</body>
</html>
