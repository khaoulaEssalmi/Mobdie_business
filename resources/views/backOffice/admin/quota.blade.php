@extends("backOffice.layout.panelAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("css/admin/profile.css")}}">
@endsection

@section("content-wrapper")
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="container light-style flex-grow-1 container-p-y">

        <div class="" style="width: 80%; margin-left: 70px;">
            <div class="row no-gutters row-bordered row-border-light">
                <div {{--class="col-md-2 pt-0"--}} >
{{--                    <div class="list-group list-group-flush account-settings-links">--}}
{{--                        <a class="list-group-item list-group-item-action active custom-link-style" data-toggle="list">Manager informations </a>--}}
{{--                    </div>--}}
                </div>
                <div class="col-md-100">
                    <div class="tab-content1">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body1 media align-items-center custom-border">
                                <img src="{{asset("uploads/managers/avatars/" .  $user->picture )}}" width="130px" height="100px" alt="" class="d-block">

                            </div>
                            <br><br>

                            <form id="general" method="POST" action="{{ route('admin.man.change.quota',['cin'=>$user->CIN]) }}">
                                @csrf
                                <div class="card-body2">
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">
                                            <i class="fas fa-user"></i>
                                            &nbsp; Full Name
                                        </label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="full_name" class="my-custom-class"
                                               value="{{ $user->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;"><i class="fas fa-spinner"></i>
                                            &nbsp; Nombre de projets en cours
                                        </label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="address" class="my-custom-class"
                                               value="{{ $total  }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;">
                                            <i class="fas fa-check-circle"></i>
                                            &nbsp; Nombre de projets terminés </label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="address" class="my-custom-class"
                                               value="{{ $total1  }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" style="font-family: solid ; font-size: 15px;"><i class="fas fa-phone"></i>
                                            &nbsp; Quota d'appels </label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="appels" class="my-custom-class"
                                               value="{{  $quota  }}">
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn custom-button-style" name="button_clicked" value="save_changes">
                                        <i class="fas fa-check-circle fa-lg"></i>
                                        Save Changes
                                    </button>
{{--                                    <button type="submit" class="btn btn-primary" name="button_clicked" value="save_changes">--}}
{{--                                        Save changes--}}
{{--                                    </button>&nbsp;--}}
                                    <button type="submit" class="btn custom-button-style1" name="button_clicked" value="cancel">
                                        <i class="fas fa-times"></i>
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
