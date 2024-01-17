@include('partials.header')
@include('partials.navbar')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
<div class="page-content-wrapper ">

    <div class="container-fluid">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Detail Pengguna</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $pengguna->nama }}</td>
                        </tr>
                        <tr>
                            <th>NO SIM</th>
                            <td>{{ $pengguna->no_sim }}</td>
                        </tr>
                        <!-- Tambahkan informasi pengguna lainnya sesuai kebutuhan -->
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
        
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end col -->
</div> <!-- end row -->

@include('partials.footer')
