@extends("backOffice.layout.panelManager")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>
        .hello{
            background-image: linear-gradient();
        }
    </style>
@endsection


@section("content-wrapper")
    <script>
            @if ($errors->any()){
            Swal.fire({
                title: 'Date error',
                html: '<b>{{ $errors->first() }}</b>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
        @endif
    </script>
    <div class="main-panel">
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border:none !important;">
                            <h4 class="card-title"> {{ $Pr->NomPr }}'s Calls list</h4>
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
                                            Date of call
                                        </th>
                                        <th>
                                            Agreed elements
                                        </th>
                                        <th>
                                            Elements discussed
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($appels as $appel)
                                        <tr>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{ $appel->Date_appel}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$appel->Elements_convenus }}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                {{$appel->Elements_discutes }}
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
        <div class="main-panel" >
            <div class="content-wrapper" >
                <div class="row" style="width:530px !important;">
                    <div class="col-12 grid-margin stretch-card" style="width:500px !important;margin-left:100px;">
                        <div class="card" >
                            <div class="card-body " style="width:500px !important; border: none !important;">
                                <h4 class="card-title">Today Call: {{ $Telephone}}</h4>
{{--                                <br><br>--}}
                                <form class="forms-sample"  style="width:500px !important;" method="POST" action="{{route("manager.submitFormCall",['PrId'=>$Pr->ProjetID,'AppelID'=>$AppelID])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="agreed" style="font-family: solid ; font-size: 15px;">Agreed elements </label>
                                        <input type="text" class="form-control" id="agreed" name="agreed" value="{{ old('agreed') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="discussed" style="font-family: solid ; font-size: 15px;">Elements discussed</label>
                                        <input type="text" class="form-control" id="discussed" name="discussed" value="{{ old('discussed') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="appreciation" style="font-family: solid ; font-size: 15px;">Appreciation</label>
                                        <input type="text" class="form-control" id="appreciation" name="appreciation" value="{{ old('appreciation') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="call2" style="font-family: solid ; font-size: 15px;">Date of next call</label>
                                        <input type="date" class="form-control" id="call2" name="call2">
{{--                                        @error('call2')--}}
{{--                                        <span class="text-danger">{{ $message }}</span>--}}
{{--                                        @enderror--}}
                                    </div>

                                    <button type="submit" class="btn custom-button-style hello" style="margin-left: 290px !important;     background-image: linear-gradient(45deg, #727ee9, #fff);" name="button_clicked" value="validate">
                                        <i class="fas fa-thumbs-up" style="font-size: 17px !important;"></i>
                                        <b>Validate the call</b>
                                    </button>
                                    <br><br>
                                        <button type="submit" class="btn custom-button-style hello" style="margin-left: 290px !important;     background-image: linear-gradient(45deg, #727ee9, #fff);" name="button_clicked" value="mark">
                                            <i class="far fa-check-circle" style="font-size: 17px !important;"></i>
                                            <b>Mark as complete</b>
                                        </button>
                                </form>
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
