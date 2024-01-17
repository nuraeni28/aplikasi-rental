@include('partials.header')

    <body class="fixed-left">

        <!-- Begin page -->
        {{-- <div class="accountbg"></div> --}}
        <div class="wrapper-page">

            <div class="card">
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
                <div class="img-container">
                    <h3 class="text-center mt-0 m-b-15">
                        Register Account ReM0
                    </h3>
                    <img class="image-login" src="{{ asset('assets/images/logo-rental.png') }}"  alt="Logo">
                </div>
                  

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="nama" type="text" required="" placeholder="Nama">
                                    @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                              
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="alamat" type="text" required="" placeholder="Alamat">
                                    @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="no_sim" type="text" required="" placeholder="No SIM">
                                    @error('no_sim')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="no_hp" type="text" required="" placeholder="No Telepon">
                                    @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                               
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row text-center">
                                <div class="col-sm-12 m-t-20">
                                    <a href="{{ Route('login') }}" class="text-muted"><i class="mdi mdi-account"></i> <small>Log In</small></a>
                                </div>
                                
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

@include('partials.footer')