@extends("backOffice.layout.panelAdmin")

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
                                            Comment
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($appels as $appel)
                                        <tr>
                                            <td>
                                                {{$appel->Date_appel}}
                                            </td>
                                            <td>
                                                {{$appel->Commentaire }}
                                            </td>
{{--                                            <td>--}}
{{--                                                <form style="display: inline; margin-right: -40px" method="POST"--}}
{{--                                                      action="#">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="id" value="">--}}
{{--                                                    <button type="submit" class="btn badge badge-danger">Call</button>--}}
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
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Today Call</h4>
                                <br><br>
                                <form class="forms-sample" method="POST" action="{{route("manager.submitFormCall",['PrId'=>$Pr->ID])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="call1">Date of call </label>
                                        <input type="date" class="form-control" id="call1" name="call1">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <input type="text" class="form-control" id="comment" name="comment">
                                    </div>
                                    <div class="form-group">
                                        <label for="call2">Date of next call</label>
                                        <input type="date" class="form-control" id="call2" name="call2">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="button_clicked" value="validate">
                                        Validate the call
                                    </button>
                                    <br><br>
                                        <button type="submit" class="btn btn-primary mr-2" name="button_clicked" value="mark">
                                            Mark as complete
                                        </button>
                                </form>
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
