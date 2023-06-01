@extends("backOffice.layout.panelAnalyst")
@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
@endsection
@section("content-wrapper")
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>
    @endif
    <div class="main-panel">
        <div class="content-wrapper" style="height: 70px !important;">
            <div class="row" style="width: 0px !important; background-color: transparent !important;">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="width: 300px !important; background-color: transparent !important; border: none !important;">
                            <p class="card-description" style="width: 300px !important; background-color: transparent !important;">
                                <a href="{{ route('analyst.sendEmailToManager',['cin'=>$user->CIN ]) }}" class="btn send-evaluation-button" style="">
                                    <i class="fas fa-paper-plane" style="position: relative; top: -2px; font-size: 20px;"></i>
                                    <span style="position: relative; top: -2px; font-size: 15px;">Send Evaluation to Manager</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        display: inline-block; text-decoration: none; padding: 6px 12px; border: 1px solid #28a745; border-radius: 4px; background-color: #fff; color: #28a745; font-size: 16px; font-weight: bold;--}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $user->name  }} 's List Projects</h4>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            Project Name
                                        </th>
                                        <th>
                                            Candidat Name
                                        </th>
                                        <th>
                                            Number of calls
                                        </th>
                                        <th>
                                            Statut
                                        </th>
                                        <th>
                                            Period
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($infos as $info)
                                        <tr>

                                            <td style="font-size: 12px; font-weight: bold;">
                                                &nbsp;
                                                {{$info->NomPr}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                &nbsp;
                                                {{$info->candidats_names}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                &nbsp;
                                                {{$info->appels_count}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                &nbsp;
                                                {{$info->Statut}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                &nbsp;
                                                <i class="far fa-calendar-alt"></i>
                                                @if($info->periode != NULL)
                                                    {{ $info->periode }} days
                                                @else
                                                    <i class="mdi mdi-close"></i>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="main-panel">--}}
{{--            <div class="content-wrapper">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12 grid-margin stretch-card">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <h4 class="card-title">{{ $user->name  }} 's Scores in last 7 days</h4>--}}
{{--                                <br>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <canvas id="order-chart1"></canvas>--}}
{{--                            </div>--}}
{{--                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
{{--                            <script>--}}
{{--                                // Récupérer les données de scores depuis le contrôleur ou à partir de votre logique--}}
{{--                                var scores = @json($scores);--}}
{{--                                var labels=@json($labels);--}}

{{--                                // Dessiner le graphique--}}
{{--                                var ctx = document.getElementById('order-chart1').getContext('2d');--}}
{{--                                var chart = new Chart(ctx, {--}}
{{--                                    type: 'line',--}}
{{--                                    data: {--}}
{{--                                        labels: labels, // Remplacez les labels par vos propres valeurs--}}
{{--                                        datasets: [{--}}
{{--                                            label: 'Scores',--}}
{{--                                            data: scores, // Utilisez les données de scores ici--}}
{{--                                            backgroundColor: 'rgba(0, 123, 255, 0.3)',--}}
{{--                                            borderColor: 'rgba(0, 123, 255, 1)',--}}
{{--                                            borderWidth: 1--}}
{{--                                        }]--}}
{{--                                    },--}}
{{--                                    options: {--}}
{{--                                        responsive: true,--}}
{{--                                        maintainAspectRatio: false--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            </script>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        <div class="main-panel">--}}
{{--            <div class="content-wrapper">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12 grid-margin stretch-card">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <h4 class="card-title">{{ $user->name  }} 's Scores monthly</h4>--}}
{{--                                <br>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <canvas id="monthly-chart"></canvas>--}}
{{--                            </div>--}}

{{--                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
{{--                            <script>--}}
{{--                                var monthlyScores = {!! json_encode($monthlyScores) !!};--}}

{{--                                var months = monthlyScores.map(item => item.month);--}}
{{--                                var scores = monthlyScores.map(item => item.averageScore);--}}

{{--                                var ctx = document.getElementById('monthly-chart').getContext('2d');--}}
{{--                                var chart = new Chart(ctx, {--}}
{{--                                    type: 'bar',--}}
{{--                                    data: {--}}
{{--                                        labels: months,--}}
{{--                                        datasets: [{--}}
{{--                                            label: 'Monthly Scores',--}}
{{--                                            data: scores,--}}
{{--                                            backgroundColor: 'rgba(0, 123, 255, 0.5)', // Change the bar color--}}
{{--                                            borderColor: 'rgba(0, 123, 255, 1)', // Change the border color--}}
{{--                                        }]--}}
{{--                                    },--}}
{{--                                    // Rest of the chart configuration...--}}
{{--                                });--}}
{{--                            </script>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
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

