<html>
    <head>
        <title>Berita Acara</title>
    </head>
    <body>
        <center>
            <h2>Berita Acara</h2>
        </center>
        @php
        $username = \App\Models\User::find($pengembalian->id_pemilik_barang)->first()->name;

    @endphp
        <p style="font-size: 20px">Perihal : Peminjaman {{ $pengembalian->nama_alat }} milik {{ $username }}</p>
        <p style="font-size: 20px">Pada hari ini tanggal {{ $pengembalian->tanggal_selesai }} dilakukan pengembalian alat oleh {{ $pengembalian->nama_peminjam }} yang telah disetujui oeleh pemilik alat {{$username}} dalam keadaan {{ $pengembalian->kondisi_pengembalian }}.</p>
        {{-- <br> --}}
        <p style="font-size: 20px">Demikian Berita Acara ini dibuat untuk digunakan sebagaimana mestinya.</p>
        <p style="font-size: 20px">Makassar {{ $pengembalian->tanggal_pengembalian }}</p>

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
                    <center> {{ $pengembalian->nama_peminjam }}</center>
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
                    <center>{{ $username }}</center>
                </td>
              
            </tr>
           
        </table>
    </body>
</html>
