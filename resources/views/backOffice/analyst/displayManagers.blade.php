@extends("backOffice.layout.panelAnalyst")

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
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{auth()->user()->name }} 's List Managers</h4>

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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($managers as $manager)
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{asset("uploads/managers/avatars/" . $manager->picture)}}"
                                                     alt="image"/>
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$manager->name}}
                                            </td>
{{--                                            <td>--}}
{{--                                                {{$manager->email}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                {{$manager->CIN}}--}}
{{--                                            </td>--}}

                                            <td style="font-size: 12px; font-weight: bold;">
                                                <form style="display: inline; margin-right: -40px" method="POST"
                                                      action="{{ route("analyst.manager.projects",['cin'=> $manager->CIN] )}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn badge badge-danger custom-icon11" style="font-size: 14px !important;">
                                                        &nbsp;
                                                        <i class="fas fa-project-diagram" style="font-size: 14px !important;"></i>
                                                        &nbsp;
                                                        <b>
                                                            Projects
                                                        </b>
                                                        &nbsp;
                                                    </button>
                                                </form>
                                            </td>
{{--                                            <td>--}}
{{--                                                <form style="display: inline;margin-right: -40px" method="POST" action="{{ route("admin.man.showProjects",['cin'=>$manager->CIN]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">--}}
{{--                                                    <button type="submit" class="btn badge badge-warning">Show Projects</button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <form style="display: inline; margin-right: -40px" method="POST" action="{{ route("admin.man.quota",['cin'=>$manager->CIN]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">--}}
{{--                                                    <button type="submit" class="btn badge badge-success">Call quota</button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <form style="display: inline; margin-right: -60px" method="POST" action="{{ route("admin.man.showAnalysts",['cin'=>$manager->CIN]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">--}}
{{--                                                    <button type="submit" class="btn badge badge-info">Show Analysts</button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <form style="display: inline; margin-right: -60px" method="POST" action="{{ route("admin.man.delete",['cin'=>$manager->CIN]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">--}}
{{--                                                    <button type="submit" class="btn badge badge-info">Delete</button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
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
{{--        <!-- partial -->--}}
    </div>
@endsection
