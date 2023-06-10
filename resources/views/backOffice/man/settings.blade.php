@extends("backOffice.layout.panel")

@section("style")
    <link rel="stylesheet" href="{{asset("css/admin/profile.css")}}">
    <style>
        .ligne-separation {
            border: none;
            height: 1px;
            background-color: #000000;
            margin: 10px 0;
        }
    </style>
@endsection

@section("content-wrapper")
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="container light-style flex-grow-1 container-p-y">

        <h4 class="font-weight-bold py-3 mb-4" style="font-size: 24px;font-weight: bold;color: #333;text-transform: uppercase;padding-bottom: 0px;margin-bottom: 0px; margin-top: 50px !important;">
            Account settings
        </h4>

        <div class="cardd overflow-hidden" style="width: 70%;">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="test active" data-toggle="list"
                           href="#account-general">General</a>
                        <a class="test" data-toggle="list"
                           href="#account-change-password">Change password</a>
                        {{--                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">Social links</a>--}}
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content" >
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="{{asset("uploads/managers/avatars/" .  Auth::user()->picture )}}"
                                     width="130px" height="100px" alt="" class="d-block">
                                <div class="media-body ml-4" style=" border-bottom: 0px !important;">
                                    <form id="change-picture-form" style="display: inline" method="POST"
                                          action="{{ route('general.picture.change') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <label class="btn-upload">
                                            <i class="fas fa-upload" style="size:40px"></i>
                                            Upload new photo
                                            <input onchange="document.getElementById('change-picture-form').submit()"
                                                   type="file" name="images[]" multiple
                                                   class="account-settings-fileinput">
                                        </label> &nbsp;
                                    </form>
                                    <div class="text-light small mt-1" style="color: #0B0F32 !important; font-family: solid !important;">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                            <hr class="ligne-separation">
                            <form id="general" method="POST" action="{{ route('general.update.general') }}">
                                @csrf
                                <div class="card-body" style="border-top: 0px !important;">
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">Full Name</label>
                                        <input type="text" name="full_name" class="form-control mb-1"
                                               value="{{ Auth::user()->name}}" style="height: 30px; width:200px !important; border: 2px solid #000000 ;    ">
                                        @error('full_name')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">E-mail</label>
                                        <input type="text" name="email" class="form-control mb-1"
                                               value="{{Auth::user()->email}}" style="height: 30px; width:200px !important; border: 2px solid #000000; ">
                                        @error('email')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
{{--                                        <div class="alert alert-warning mt-3">--}}
{{--                                            Your email is not confirmed. Please check your inbox.<br>--}}
{{--                                            <a href="javascript:void(0)">Resend confirmation</a>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">Phone</label>
                                        <input type="text" name="phone" class="form-control mb-1"
                                               value="{{Auth::user()->phone}}" style="height: 30px; width:200px !important; border: 2px solid #000000 ;">
                                        @error('Phone')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">Address</label>
                                        <input type="text" name="address" class="form-control mb-1"
                                               value="{{Auth::user()->address}}" style="height: 30px; width:200px !important; border: 2px solid #000000 ;">
                                        @error('address')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn custom-button-style" name="button_clicked"
                                            value="save_changes" style="background-image: linear-gradient(45deg, #7690b9, #fff);">
                                        <i class="fas fa-check-circle fa-lg"></i>
                                        Save changes
                                    </button>&nbsp;
                                    <button type="submit" class="btn custom-button-style1" name="button_clicked" value="cancel" style="background-image: linear-gradient(45deg, #7690b9, #fff);">
                                        <i class="fas fa-times"></i>
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <form method="POST" action="{{ route('general.change_password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">Current password</label>
                                        <input name="password" type="password" class="form-control"  style="height: 30px; width:200px !important; border: 2px solid #000000 ;    ">
                                        @error('password')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">New password</label>
                                        <input name="new_pass" type="password" class="form-control"  style="height: 30px; width:200px !important; border: 2px solid #000000 ;    ">
                                        @error('new_pass')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">Repeat new password</label>
                                        <input name="new_pass_confirm" type="password" class="form-control"  style="height: 30px; width:200px !important; border: 2px solid #000000 ;    ">
                                        @error('new_pass_confirm')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn custom-button-style" name="button_clicked" style="background-image: linear-gradient(45deg, #7690b9, #fff);"
                                                value="save_changes">
                                            <i class="fas fa-check-circle fa-lg"></i>
                                            Save changes
                                        </button>&nbsp;
                                        <button type="submit" class="btn custom-button-style1" name="button_clicked" value="cancel" style="background-image: linear-gradient(45deg, #7690b9, #fff);">
                                            <i class="fas fa-times"></i>
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--                        <div class="tab-pane fade" id="account-social-links">--}}
                        {{--                            <div class="card-body pb-2">--}}

                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="form-label">Twitter</label>--}}
                        {{--                                    <input type="text" class="form-control" value="https://twitter.com/user">--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="form-label">Facebook</label>--}}
                        {{--                                    <input type="text" class="form-control" value="https://www.facebook.com/user">--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="form-label">Google+</label>--}}
                        {{--                                    <input type="text" class="form-control" value="">--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="form-label">LinkedIn</label>--}}
                        {{--                                    <input type="text" class="form-control" value="">--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label class="form-label">Instagram</label>--}}
                        {{--                                    <input type="text" class="form-control" value="https://www.instagram.com/user">--}}
                        {{--                                </div>--}}

                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
