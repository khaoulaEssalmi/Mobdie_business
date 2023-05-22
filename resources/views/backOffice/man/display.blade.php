@extends("backOffice.layout.panelSuperAdmin")

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
                            <p class="card-description">
                                <a href="{{ route('superAdmin.managers.add') }}" class="btn btn-sm btn-outline-success">
                                    <i class="mdi mdi-plus-box"></i> <strong
                                        style="position: relative;top: -2px;font-size: 16px;">Ajouter</strong>
                                </a>
                            </p>
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
                                            Phone
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        {{--                                        <th>--}}
                                        {{--                                            Role--}}
                                        {{--                                        </th>--}}
                                        <th>
                                            Action
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
                                                {{$manager->phone}}
                                            </td>
                                            <td>
                                                {{$manager->address}}
                                            </td>
                                            {{--                                        <td>--}}
                                            {{--                                            <label for="" class="badge {{$man->role == 1 ? "badge-warning" : "badge-success" }}">{{$man->role == 1 ? "Editor" : "Moderator" }}</label>--}}
                                            {{--                                        </td>--}}
                                            <td>
                                                <form style="display: inline; margin-right: 10px" method="POST"
                                                      action="{{ route('superAdmin.managers.delete', ['cin' => $manager->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn badge badge-danger">Delete</button>
                                                </form>
                                                {{--                                            <form style="display: inline;" method="POST" action="">--}}
                                                {{--                                                @csrf--}}
                                                {{--                                                <input type="hidden" name="id" value="{{$man->CIN}}">--}}
                                                {{--                                                <input type="hidden" name="role" value="{{$man->role == 2 ? 1 : 2}}">--}}
                                                {{--                                                <button type="submit" class="btn badge badge-info">Modify --}}{{--{{$man->role == 2 ? "Editor" : "Moderator"}}--}}{{--</button>--}}
                                                {{--                                            </form>--}}
                                                <a href=""></a>
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
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span
                    class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                        class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection
