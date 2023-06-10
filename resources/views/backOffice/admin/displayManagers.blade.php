@extends("backOffice.layout.panelAdmin")

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
                        <div class="card-body" style="border: none;">
                            <h4 class="card-title" style="color: #7c3eac">Managers List</h4>
                            <br><br>
                            <p class="card-description">
                                <a  class="add-manager-link" href="{{ route('admin.addManager') }}">
                                    <button class="add-manager-btn" style="background-color: #7c3eac">
                                        <i class="fas fa-plus"></i> ADD Manager
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
                                            <td style="font-weight: bold; font-size: 14px;">
                                                {{$manager->name}}
                                            </td>
                                            <td style="font-weight: bold; font-size: 14px;">
                                                {{$manager->email}}
                                            </td>
                                            <td style="font-weight: bold; font-size: 14px;">
                                                {{$manager->CIN}}
                                            </td>

                                            <td >
                                                <form style="display: inline; margin-right: -40px" method="POST"
                                                      action="{{ route("admin.projects.to.managers",['cin'=> $manager->CIN] )}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button">
                                                    <i class="fas fa-tasks"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px; padding-right: 20px;">
                                                <form style="display: inline;margin-right: -40px" method="POST" action="{{ route("admin.man.showProjects",['cin'=>$manager->CIN]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$manager->CIN}}">
                                                    <button type="submit" class="btn custom-button1">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="width:20px; padding-right: 40px;">
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
    </div>
@endsection
