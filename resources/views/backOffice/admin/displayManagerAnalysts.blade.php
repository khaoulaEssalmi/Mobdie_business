@extends("backOffice.layout.panelAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>

    </style>
@endsection


@section("content-wrapper")
{{--    @if(Session::has('success'))--}}
{{--        <script>--}}
{{--            Toastify({--}}
{{--                text: '{{ Session::get('success') }}',--}}
{{--                duration: 3000, // Durée du toast en millisecondes--}}
{{--                close: true, // Afficher le bouton de fermeture du toast--}}
{{--                gravity: 'top', // Position du toast (top, bottom, left, right)--}}
{{--                position: 'center', // Position horizontale du toast (left, center, right)--}}
{{--                backgroundColor: '#28a745', // Couleur de fond du toast--}}
{{--                stopOnFocus: true, // Arrêter le toast lorsqu'il est survolé ou en focus--}}
{{--            }).showToast();--}}
{{--        </script>--}}
{{--    @endif--}}
    <div class="main-panel">
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border:none !important;">
                            <h4 class="card-title" style="color: #7c3eac"> List of {{ $user->name }}'s analysts</h4>
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
                                        <th>

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
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$analyst->name}}
                                            </td>
                                            <td>
                                                <form style="display: inline; margin-right: -40px" method="POST"
                                                      action="{{ route("admin.deleteAnalyst",['cinMan'=>$user->CIN,'cinAna'=> $analyst->CIN] )}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$analyst->CIN}}">
                                                    <button type="submit" class="btn badge  btn-delete"><i class="fas fa-trash" style="font-size:17px"></i></button>
                                                </form>
                                            </td>
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
{{--         n--}}
        <!-- partial -->
    </div>
@endsection
