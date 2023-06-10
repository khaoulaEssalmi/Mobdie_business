@extends("backOffice.layout.panelAdmin")

@section("content-wrapper")
    <script>
            @if ($errors->any()){
            Swal.fire({
                title: 'Validation error',
                html: '<ol>@foreach ($errors->all() as $error)  <b>{{ $error }}</b><br>@endforeach</ol>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
        @endif
    </script>
    <div class="main-panel">
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="tab-content2">
                        <div class="cardy">
                            <div class="card-body3 ">
                                <h4 class="card-title">Add Manager</h4>
                                <br><br>
                                <form class="forms-sample" method="POST" action="{{route("admin.analyst.add.submit")}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="name"  style="font-family: solid ; font-size: 15px;">Full Name</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="my-custom-class" style="width: 200px !important;" id="name" name="name" placeholder="Name">
                                        {{--                                    @error('name')--}}
                                        {{--                                    <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
                                        {{--                                        <strong>{{ $message }}</strong>--}}
                                        {{--                                    </span>--}}
                                        {{--                                    @enderror--}}
                                    </div>
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="Email"  style="font-family: solid ; font-size: 15px;">Email address</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="email" class="my-custom-class" style="width: 200px !important;" id="Email" name="email"
                                               placeholder="Email">
                                        {{--                                    @error('email')--}}
                                        {{--                                    <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
                                        {{--                                        <strong>{{ $message }}</strong>--}}
                                        {{--                                    </span>--}}
                                        {{--                                    @enderror--}}
                                    </div>
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="Email"  style="font-family: solid ; font-size: 15px;">CIN</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="my-custom-class" style="width: 200px !important;" id="cin" name="cin" placeholder="CIN">
                                        {{--                                    @error('cin')--}}
                                        {{--                                    <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
                                        {{--                                        <strong>{{ $message }}</strong>--}}
                                        {{--                                    </span>--}}
                                        {{--                                    @enderror--}}
                                    </div>
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="password"  style="font-family: solid ; font-size: 15px;">Password</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="password" class="my-custom-class" style="width: 200px !important;" id="password" name="password"
                                               placeholder="Password">
                                        {{--                                    @error('password')--}}
                                        {{--                                    <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
                                        {{--                                        <strong>{{ $message }}</strong>--}}
                                        {{--                                    </span>--}}
                                        {{--                                    @enderror--}}
                                    </div>
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="address"  style="font-family: solid ; font-size: 15px;">Address</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="my-custom-class" style="width: 200px !important;" id="address" name="address"
                                               placeholder="Address">
                                        {{--                                    @error('address')--}}
                                        {{--                                    <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
                                        {{--                                        <strong>{{ $message }}</strong>--}}
                                        {{--                                    </span>--}}
                                        {{--                                    @enderror--}}
                                    </div>
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="Phone"  style="font-family: solid ; font-size: 15px;">Phone</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="my-custom-class" style="width: 200px !important;" id="Phone" name="Phone" placeholder="Phone">
                                        @error('Phone')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    &nbsp;&nbsp;&nbsp;&nbsp;--}}
                                    {{--                                    <label for="Phone"  style="font-family: solid ; font-size: 15px;">Call quota</label>--}}
                                    {{--                                    <br>--}}
                                    {{--                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
                                    {{--                                    <input type="text" class="my-custom-class" style="width: 200px !important;" id="Call" name="Call" placeholder="Call">--}}
                                    {{--                                </div>--}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="submit" class="btn custom-button-style"  name="button_clicked"
                                            value="validate">
                                        <i class="fas fa-check"></i> Submit
                                    </button>
                                    <button type="submit" class="btn custom-button-style1" name="button_clicked" value="cancel">
                                        <i class="fas fa-times"></i>
                                        Cancel
                                    </button>
                                    <br>
                                    <p style=" color: transparent;">Ce texte est invisible.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")

    <script src="{{asset("adminPanel")}}/js/typeahead.js"></script>
    <script src="{{asset("adminPanel")}}/js/file-upload.js"></script>

@endsection

