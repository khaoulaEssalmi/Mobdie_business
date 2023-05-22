@extends("backOffice.layout.panelAdmin")

@section("content-wrapper")
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Manager</h4>
                           <br><br>
                            <form class="forms-sample" method="POST" action="{{route("admin.man.add.submit")}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email address</label>
                                    <input type="email" class="form-control" id="Email" name="email"
                                           placeholder="Email">
                                    @error('email')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Email">CIN</label>
                                    <input type="text" class="form-control" id="cin" name="cin" placeholder="CIN">
                                    @error('cin')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="Address">
                                    @error('address')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Phone">Phone</label>
                                    <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Phone">
                                    @error('Phone')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Phone">Call quota</label>
                                    <input type="text" class="form-control" id="Call" name="Call" placeholder="Call">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2" name="button_clicked"
                                        value="validate">Submit
                                </button>
                                <button class="btn btn-light" name="button_clicked" value="cancel">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                        class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection

@section("script")

    <script src="{{asset("adminPanel")}}/js/typeahead.js"></script>
    <script src="{{asset("adminPanel")}}/js/file-upload.js"></script>

@endsection

