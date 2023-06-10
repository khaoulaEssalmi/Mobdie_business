@extends("backOffice.layout.panelAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>

    </style>
@endsection

@section("content-wrapper")
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="main-panel">
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="border:none !important;">
                        <div class="card-body" style="border:none !important;">
                            <h4 class="card-title" style="color: #7c3eac">
                                {{ $user->name }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Total des projets: {{ $total }}
                            </h4>
                            <form method="POST" action="{{ route('admin.projects.submit',['cin' => $user->CIN] )}}">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="color: #7c3eac">
                                                ID
                                            </th>
                                            <th style="color: #7c3eac">
                                                Name of project
                                            </th>
                                            <th style="color: #7c3eac">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td style="font-size: 12px; font-weight: bold;">
                                                    {{$project->ProjetID}}
                                                </td>
                                                <td style="font-size: 12px; font-weight: bold; padding-right: 10px; margin-right: 10px">
                                                    {{$project->NomPr}}
                                                </td>
                                                <td >
                                                    <input type="checkbox" name="action[]" value="{{ $project->ProjetID }}" class="custom-checkbox">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn custom-button-style " style="background-image: linear-gradient(to right, #727EE9, #AD5DEC);">
                                    <i class="fas fa-check-circle fa-lg" style="font-size: 15px !important;"></i>
                                    <b style="font-size: 13px;">Soumettre</b>
                                </button>
                            </form>
                            {{--                            <p class="card-description">--}}
                            {{--                                <a href="{{ route('superAdmin.managers.add') }}" class="btn btn-sm btn-outline-success">--}}
                            {{--                                    <i class="mdi mdi-plus-box"></i> <strong--}}
                            {{--                                        style="position: relative;top: -2px;font-size: 16px;">Ajouter</strong>--}}
                            {{--                                </a>--}}
                            {{--                            </p>--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>--}}
{{--                                            {{ $user->name }}--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                          Total des projets : {{ $total }}--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                </table>--}}

{{--                            </div>--}}
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
