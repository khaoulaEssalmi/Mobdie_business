@extends("backOffice.layout.panelSuperAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{--    <style>--}}
    {{--.heho{--}}
    {{--    background-color: #F5F7FF !important;--}}
    {{--    margin-top: 70px;--}}
    {{--    font-size: 20px;--}}
    {{--     border: 1px solid #000;--}}
    {{--}--}}
    {{--    </style>--}}
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
                        <div class="card-body" style="border: none !important;">
                            <h4 class="card-title" style="color:#d57b00;">Admins List</h4>
                            <br><br>
                            <p class="card-description">
                                <a  class="add-manager-link" href="{{ route('superAdmin.addAdmin') }}">
                                    <button class="add-manager-btn" style="background-color: #d57b00 !important;">
                                        <i class="fas fa-plus"></i> ADD Admin
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
                                        <th style="color:#d57b00;">
                                            User
                                        </th>
                                        <th style="color:#d57b00;">
                                            Full name
                                        </th>
                                        <th style="color:#d57b00;">
                                            Email
                                        </th>
                                        <th style="color:#d57b00;">
                                            CIN
                                        </th >
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td class="py-1" >
                                                <img src="{{asset("uploads/managers/avatars/" . $admin->picture)}}"
                                                     alt="image"/>
                                            </td>
                                            <td style="font-size: 14px;font-weight: bold;">
                                                {{$admin->name}}
                                            </td>
                                            <td style="font-size: 14px;font-weight: bold;">
                                                {{$admin->email}}
                                            </td>
                                            <td style="font-size: 14px;font-weight: bold;">
                                                {{$admin->CIN}}
                                            </td>
                                            <td style="width:20px">
                                                <form style="display: inline; margin-right: -40px" method="POST" action="{{ route("superAdmin.admin.delete",['cin'=>$admin->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$admin->CIN}}">
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
    </div>
@endsection
