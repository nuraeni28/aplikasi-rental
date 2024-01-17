@include('partials.header')
@include('partials.navbar')
        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <h2>Selamat Datang {{ Auth::user()->name }}</h2>
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="col-3 align-self-center">
                                        <div class="round">
                                        <i class="mdi mdi-car"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-center text-center">
                                        <div class="m-l-10">
                                            <h5 class="mt-0 round-inner">{{ $mobil }}</h5>
                                            <p class="mb-0 text-muted">Mobil</p>                                                                 
                                        </div>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                   @if (Auth::user()->role=='admin')
                   <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                </div>
                                <div class="col-6 align-self-center text-center">
                                    <div class="m-l-10">
                                        <h5 class="mt-0 round-inner">{{ $pengguna }}</h5>
                                        <p class="mb-0 text-muted">Pengguna</p>                                                                 
                                    </div>
                                </div>
                                <div class="col-3 align-self-end align-self-center">
                                    <h6 class="m-0 float-right text-center text-danger"> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                       
                   @endif
                        </div>          
                                                               
                    </div><!-- container -->
                    

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                © 2023 Upi
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->
@include('partials.footer')