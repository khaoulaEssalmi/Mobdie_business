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
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
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
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Name of project
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td>
                                                    {{$project->ID}}
                                                </td>
                                                <td>
                                                    {{$project->Nom}}
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="action[]" value="{{ $project->ID }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn badge badge-info">Soumettre</button>
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
