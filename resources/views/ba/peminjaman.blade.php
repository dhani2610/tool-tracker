<html>
    <head>
        <title>Berita Acara</title>
    </head>
    <body>
        <center>
            <h2>Berita Acara</h2>
        </center>
        @php
        $username = \App\Models\User::where('id',$peminjaman->id_pemilik_barang)->first()->name;

        @endphp
        <p style="font-size: 20px">Peminjaman {{ $peminjaman->nama_alat }} milik {{ $username }}</p>
        <p style="font-size: 20px">Pada hari ini tanggal {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->translatedFormat('d F Y') }} dilakukan peminjaman alat oleh {{ $peminjaman->nama_peminjam }} yang telah disetujui oleh pemilik alat {{$username}} dalam keadaan {{ $peminjaman->kondisi_alat }} Alat tersebut akan digunakan mulai  {{  \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->translatedFormat('d F Y') }} sampai dengan  {{  \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->translatedFormat('d F Y') }}.</p>
        {{-- <br> --}}
        <p style="font-size: 20px">Demikian Berita Acara ini dibuat untuk digunakan sebagaimana mestinya.</p>
        <p style="font-size: 20px">Makassar     </p>

        <table style="width:100%">
            <tr>
                <td>
                    <center>
                        Diserahkan Oleh
                    </center>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>{{ $username }}</center>
                </td>
                <td>
                    <center>
                        Diterima Oleh
                    </center>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>{{ $peminjaman->nama_peminjam }}</center>
                </td>
              
            </tr>
           
        </table>
    </body>
</html>
