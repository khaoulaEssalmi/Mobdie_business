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

        <div class="card overflow-hidden" style="width: 90%;">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-2 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                           href="#account-general">Manager Informations </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="{{asset("uploads/managers/avatars/" .  $user->picture )}}" width="130px" height="100px" alt="" class="d-block">

{{--                                <div class="media-body ml-4">--}}

{{--                                </div>--}}
                            </div>
                            <hr class="border-light m-0">

                            <form id="general" method="POST" action="{{ route('admin.manager.change.quota',['cin'=>$user->CIN]) }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="full_name" class="form-control mb-1"
                                               value="{{ $user->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nombre de projets en cours </label>
                                        <input type="text" name="address" class="form-control mb-1"
                                               value="{{ $total  }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nombre de projets terminés </label>
                                        <input type="text" name="address" class="form-control mb-1"
                                               value="{{ $total1  }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Quota d'appels </label>
                                        <input type="text" name="appels" class="form-control mb-1"
                                               value="{{  $quota  }}">
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary" name="button_clicked" value="save_changes">
                                        Save changes
                                    </button>&nbsp;
                                    <button type="submit" class="btn btn-default" name="button_clicked" value="cancel">
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
