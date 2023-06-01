@extends("backOffice.layout.panelAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>

    </style>
@endsection


@section("content-wrapper")
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>
    @endif
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Managers List</h4>
                            <br><br>
                            <p class="card-description">
                                <a  class="add-manager-link" href="{{ route('admin.addManager') }}">
                                    <button class="add-manager-btn">
                                        <i class="fas fa-plus"></i> ADD Manager
                                    </button>
                                </a>
{{--                                <a href="{{ route('admin.addManager') }}" class="btn btn-sm btn-outline-success">--}}
{{--                                    <i class="mdi mdi-plus-box"></i> <strong--}}
{{--                                        style="position: relative;top: -2px;font-size: 16px;">Ajouter un manager</strong>--}}
{{--                                </a>--}}
                            </p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Full name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            CIN
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($managers as $manager)
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{asset("uploads/managers/avatars/" . $manager->picture)}}"
                                                     alt="image"/>
                                            </td>
                                            <td>
                                                {{$manager->name}}
                                            </td>
                                            <td>
                                                {{$manager->email}}
                                            </td>
                                            <td>
                                                {{$manager->CIN}}
                                            </td>

                                            <td>
                                                <form style="display: inline; margin-right: -40px" method="POST"
                                                      action="{{ route("admin.projects.to.managers",['cin'=> $manager->CIN] )}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button">
                                                    <i class="fas fa-tasks"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px">
                                                <form style="display: inline;margin-right: -40px" method="POST" action="{{ route("admin.man.showProjects",['cin'=>$manager->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button1">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px">
                                                <form style="display: inline; margin-right: -40px" method="POST" action="{{ route("admin.man.quota",['cin'=>$manager->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button4">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px">
                                                <form style="display: inline; margin-right: -40px" method="POST" action="{{ route("admin.man.showAnalysts",['cin'=>$manager->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button2">
                                                        <i class="fas fa-users"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px">
                                                <form style="display: inline; margin-right: -40px" method="POST" action="{{ route("admin.man.delete",['cin'=>$manager->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button3">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
{{--        <footer class="footer">--}}
{{--            <div class="d-sm-flex justify-content-center justify-content-sm-between">--}}
{{--                <span--}}
{{--                    class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a--}}
{{--                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>--}}
{{--                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i--}}
{{--                        class="ti-heart text-danger ml-1"></i></span>--}}
{{--            </div>--}}
{{--        </footer>--}}
        <!-- partial -->
    </div>
@endsection
