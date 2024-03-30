<!DOCTYPE html>
<html>
<head>
    <title>Nota Penarikan Saldo</title>
    <style>
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: right;
        }
        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            opacity: 0.2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/images/logo-icon-2.png') }}" width="100px" alt="Logo">
            <h4>Nota Penarikan Saldo</h4>
            <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas similique adipisci recusandae, corporis voluptatum at temporibus vitae? Quas reprehenderit</h5>
        </div>
        <div class="content">
            <p>Nama: {{ $user->nama_merchant }}</p>
            <p>Keterangan: {{ $user->keterangan }}</p>
            <p>Jumlah Penarikan: Rp. {{ $user->jumlah }}</p>
            <p>Tanggal Penarikan: {{ $user->created_at }}</p>
        </div>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
        <div class="watermark"><img src="{{ asset('upload/produk/1711620796.png') }}" width="100%" height="100%" alt=""></div>
    </div>
</body>
<script>
    window.onload = function() {
        window.print();
    }
</script>
</html>