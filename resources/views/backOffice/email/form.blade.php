@extends("backOffice.layout.panelAnalyst")

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
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{auth()->user()->name }} 's List Managers</h4>
                            <div class="container">
                                <h2>Envoyer un e-mail</h2>

                                <form action="{{ route('analyst.sendEmail1') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="subject">Sujet</label>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" class="form-control" rows="5" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
