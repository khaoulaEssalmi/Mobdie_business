@extends("backOffice.layout.panelAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>

    </style>
@endsection


@section("content-wrapper")
    @if(Session::has('success'))

        <script>
            Toastify({
                text: '{{ Session::get('success') }}',
                duration: 3000, // Durée du toast en millisecondes
                close: true, // Afficher le bouton de fermeture du toast
                gravity: 'top', // Position du toast (top, bottom, left, right)
                position: 'center', // Position horizontale du toast (left, center, right)
                backgroundColor: '#28a745', // Couleur de fond du toast
                stopOnFocus: true, // Arrêter le toast lorsqu'il est survolé ou en focus
            }).showToast();
        </script>
    @endif
    <div class="main-panel">
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border: none;">
                            <h4 class="card-title" style="color: #7c3eac">Analysts List</h4>
                            <br><br>
                            <p class="card-description">
                                <a  class="add-manager-link" href="{{ route('admin.addAnalyst') }}">
                                    <button class="add-manager-btn" style="background-color: #7c3eac">
                                        <i class="fas fa-plus"></i> ADD Analyst
                                    </button>
                                </a>
                            </p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="color: #7c3eac">
                                            User
                                        </th>
                                        <th style="color: #7c3eac">
                                            Full name
                                        </th>
                                        <th style="color: #7c3eac">
                                            Email
                                        </th>
                                        <th style="color: #7c3eac">
                                            CIN
                                        </th>
                                        <th style="color: #7c3eac">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($analysts as $analyst)
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{asset("uploads/managers/avatars/" . $analyst->picture)}}"
                                                     alt="image"/>
                                            </td>
                                            <td style="font-weight: bold; font-size: 14px;">
                                                {{$analyst->name}}
                                            </td>
                                            <td style="font-weight: bold; font-size: 14px;">
                                                {{$analyst->email}}
                                            </td>
                                            <td style="font-weight: bold; font-size: 14px;">
                                                {{$analyst->CIN}}
                                            </td>

                                            <td>
                                                <form style="display: inline; margin-right: 10px" method="POST"
                                                      action="{{ route("admin.managers.to.analysts",['cin'=> $analyst->CIN] )}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$analyst->CIN}}">
                                                    <button type="submit" class="btn btn-affect-managers">
                                                        <i class="fas fa-users" style="font-size: 18px !important;"></i> &nbsp;&nbsp; <p style="font-size: 14px !important; padding-top: 7px;"><b>Affect Managers</b></p>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px">
                                                <form style="display: inline; margin-right: -40px" method="POST" action="{{ route("admin.analyst.delete",['cin'=>$analyst->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$analyst->CIN}}">
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
