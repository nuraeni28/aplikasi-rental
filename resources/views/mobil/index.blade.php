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
                        <h4 class="mt-0 header-title">Data Mobil</h4>
                        
                        <!-- Button trigger modal -->
                        @if (Auth::user()->role=='admin')
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                            Create
                         </button>
                         @endif
                         <!-- Modal -->
                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Buat Data Mobil</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <form action="{{ route('mobil.create') }}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                         <div class="modal-body">
                                             <div class="form-group">
                                                 <label for="judul">Merek</label>
                                                 <input type="text" name="merek" class="form-control" placeholder="Merek">
                                             </div>
                                             <div class="form-group">
                                                <label for="model">Model</label>
                                                <input type="text" name="model" class="form-control"  placeholder="Model">
                                            </div>
                                            <div class="form-group">
                                                <label for="matkul">Nomor Polisi</label>
                                                <input type="text" name="no_plat" id="no_plat" class="form-control" placeholder="Nomor Plat" oninput="toUpperCase()">
                                            </div>
                                             <div class="form-group">
                                                <label for="matkul">Tarif</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="tarif" class="form-control" id="tarifInput" placeholder="Tarif" oninput="formatCurrency(this)">
                                                </div>
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
                                <th>Merek</th>
                                <th>Model</th>
                                <th>Nomor Polisi</th>
                                <th>Tarif</th>
                                @if (Auth::user()->role=='admin')
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
        <td>{{ $data->merek }}</td>
        <td>{{ $data->model }}</td>
        <td>{{ $data->nomor_plat }}</td>
        <td>{{ 'Rp ' . number_format($data->tarif_sewa, 0, ',', '.') }}</td>
        @if (Auth::user()->role=='admin')
        <td>
            
            <button class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#Edit-{{ $data->id }}">Edit</button>
            <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#N{{ $data->id }}">Delete</button>
            <div class="modal fade" id="Edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Mobil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('mobil.edit',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Merek</label>
                                    <input value="{{ $data->merek }}" type="text" name="merek" class="form-control" placeholder="Merek">
                                </div>
                                <div class="form-group">
                                   <label for="model">Model</label>
                                   <input value="{{ $data->model }}" type="text" name="model" class="form-control"  placeholder="Model">
                               </div>
                                <div class="form-group">
                                    <label for="matkul">Nomor Plat</label>
                                    <input value="{{ $data->nomor_plat }}" type="text" id="no_plat" name="no_plat" class="form-control" placeholder="Nomor Plat" oninput="toUpperCase()">
                                </div>
                               
                                <div class="form-group">
                                   <label for="matkul">Tarif</label>
                                   <div class="input-group">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">Rp</span>
                                       </div>
                                       <input type="text" value="{{ $data->tarif_sewa }}" name="tarif" class="form-control" id="tarifInput" placeholder="Tarif" oninput="formatCurrency(this)">
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
                <form id="deleteForm" method="POST" action="{{ route('mobil.delete',$data->id) }}">
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
