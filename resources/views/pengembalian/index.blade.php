@include('partials.header')
@include('partials.navbar')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
<div class="page-content-wrapper ">

    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        @if ($errors->first('message'))
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('message') }}
                            </div>
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-info" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                    @endif
                        <h4 class="mt-0 header-title">Data Pengembalian</h4>
                        
                        <!-- Button trigger modal -->
                            <!-- Button trigger modal -->
                      @if (Auth::user()->role != 'admin')
                      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                        Ajukan
                     </button>
                      @endif
                         
                         <!-- Modal -->
                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Ajukan Pengembalian</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <form action="{{ route('pengembalian.create') }}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                         <div class="modal-body">
                                             <div class="form-group">
                                                 <label for="judul">Nomor Polisi</label>
                                                 <input type="text" name="nopol" class="form-control" placeholder="Nomor Polisi">
                                             </div>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save changes</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                         
            <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Mobil</th>
                                <th>Biaya</th>
                                <th>Status</th>
                                @if (Auth::user()->role=='admin')
                                <th>User</th>
                                <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            @php
                                $no =1;
                            @endphp
                            <tbody>
                                @foreach ($datas as $data)
    <tr>
        <td>{{ $no }}</td>
        <td>{{ $data->tanggal_mulai }}</td>
        <td>{{ $data->tanggal_selesai }}</td>
        <td>{{ $data->mobil->model }} - {{ $data->mobil->nomor_plat }} </td>
        <td>{{ 'Rp ' . number_format($data->biaya_sewa, 0, ',', '.') }}</td>
        <td>
            @if($data->status == 0)
        <span class="badge badge-warning">Dipinjam</span>
    @else
    <span class="badge badge-success">Dikembalikan</span>
    @endif
        </td>
        @if (Auth::user()->role=='admin')
        <td>{{ $data->user->nama }}</td>
        <td>

            <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#N{{ $data->id }}">Delete</button>
           
           
        </td>
        @endif
    </tr>
    @php
        $no++;
    @endphp
    <div class="modal fade" id="N{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this {{ $data->nomor_plat }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="{{ route('pengembalian.delete',$data->id) }}">
                    @csrf
                    @method('Delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


                            
                        
                            </tbody>
                        </table>

                    </div>
                </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end col -->
</div> <!-- end row -->
<script>
    function toUpperCase() {
        var input = document.getElementById('no_plat');
        input.value = input.value.toUpperCase();
    }
</script>

@include('partials.footer')
