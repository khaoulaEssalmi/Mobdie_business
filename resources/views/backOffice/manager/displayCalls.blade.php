@extends("backOffice.layout.panelManager ")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>
        .mycardtitle{
            font-size: 30px;
            /*color: violet !important;*/
        }
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
                            <h4 class="card-title mycardtitle">Calls List</h4>
                            <br><br>

                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            CandidatID
                                        </th>
                                        <th>
                                            Full Name
                                        </th>
                                        <th>
                                            Projet
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($candidats as $candidat)
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$candidat->CandidatID}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$candidat->Nom}} {{$candidat->Prenom}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$candidat->NomPr }}
                                            </td>
                                            <td>
                                                <form style="display: inline; margin-right: -40px" method="POST"
                                                      action="{{route('manager.callCandidat',['ProjetID'=>$candidat->ProjetID,'Telephone'=>$candidat->Telephone,'AppelID'=>$candidat->AppelID])}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="">
                                                    <button type="submit" class="btn badge badge-danger custom-icon11" >
                                                        <i class="mdi mdi-phone" style="font-size: 16px !important;"> <b>Call</b></i>
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
