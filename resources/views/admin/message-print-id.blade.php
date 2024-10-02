<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
           font-family: Arial, sans-serif;
           margin: 0;
       }
       .container {
           max-width: 800px;
           margin: auto;
       }
       .header {
           text-align: center;
           margin-bottom: 20px;
       }
       .content {
           text-align: justify;
       }
       .footer {
           margin-top: 50px;
           text-align: right;
       }
       .signature {
           margin-top: 40px;
           text-align: center;
       }
       .info {
           display: flex;
       }
       .info label {
           width: 120px;
           display: inline-block;
       }
   </style>
</head>
<body>
    <title>Surat Keterangan Bebas Perpustakaan</title>
    <div class="container">
        <div class="header">
            <h2>Surat Keterangan Bebas Perpustakaan</h2>
        </div>
        <div class="content">
            <p>Dengan ini kami menyatakan bahwa:</p>
            <div class="info">
                <label>Nomor Induk</label>
                <span>: {{ $user->id }}</span>
            </div>
            <div class="info">
                <label>Nama</label>
                <span>: {{ $user->username }}</span>
            </div>
            <div class="info">
                <label>Kelas</label>
                <span>: {{ $user->class }}</span>
            </div>
            <p>Telah menyelesaikan semua kewajiban sebagai anggota perpustakaan sekolah, termasuk pengembalian seluruh buku yang dipinjam dan penyelesaian denda yang ada.</p>
            <p>Surat keterangan ini berlaku sebagai bukti bahwa yang bersangkutan sudah bebas dari kewajiban perpustakaan sekolah.</p>
        </div> 
        <?php foreach ($admin as $item): ?>
            <?php if ($item->role_id === 1): ?>
                <div class="footer">
                    <p>{{ now()->isoFormat('DD MMMM Y') }}</p><br><br><br>
                    {{-- <p>( _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ )</p> --}}
                    <p>{{ $item->username }}</p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>
</html>
       
