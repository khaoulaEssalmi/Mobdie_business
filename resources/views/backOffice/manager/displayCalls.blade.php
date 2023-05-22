@extends("backOffice.layout.panelManager")

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
                            <h4 class="card-title">Calls List</h4>
                            <br><br>
{{--                            <p class="card-description">--}}
{{--                                <a href="{{ route('admin.addManager') }}" class="btn btn-sm btn-outline-success">--}}
{{--                                    <i class="mdi mdi-plus-box"></i> <strong--}}
{{--                                        style="position: relative;top: -2px;font-size: 16px;">Ajouter un manager</strong>--}}
{{--                                </a>--}}
{{--                            </p>--}}
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            CandidatID
                                        </th>
                                        <th>
                                            FUll Name
                                        </th>
                                        <th>
                                            Projet
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($candidats as $candidat)
                                        <tr>
                                            <td>
                                                {{$candidat->CandidatID}}
                                            </td>
                                            <td>
                                                {{$candidat->Nom}} {{$candidat->Prenom}}
                                            </td>
                                            <td>
                                                {{$candidat->NomPr }}
                                            </td>
                                            <td>
                                                <form style="display: inline; margin-right: -40px" method="POST"
                                                      action="{{route('manager.callCandidat',['ProjetID'=>$candidat->ID])}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="">
                                                    <button type="submit" class="btn badge badge-danger">Call</button>
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
