@extends("backOffice.layout.panelAnalyst")
@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
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
                        <div class="card-body" style="border: none !important;">
                            <h4 class="card-title" style="color: #36b5c7;">{{ $user->name  }} 's List Projects</h4>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="    color: #36b5c7;">
                                            Project Name
                                        </th>
                                        <th style="    color: #36b5c7;">
                                            Number of calls
                                        </th>
                                        <th style="    color: #36b5c7;">
                                            Statut
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
                                                {{$info->appels_count}}
                                            </td>
                                            <td style="font-size: 12px; font-weight: bold;">
                                                &nbsp;
                                                {{$info->Statut}}
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
        <div class="content-wrapper1">
        <div class="row" style="width: 800px;">
                    <div class="col-lg-12 grid-margin stretch-card" style="margin-left: 200px;">
                        <div class="card">
                            <div class="card-body" style="border:none !important;">
                                <h4 class="card-title" style="    color: #36b5c7;">{{ $user->name  }} 's Scores in last 7 days</h4>
                                <br>
                            </div>
                            <div>
                                <canvas id="order-chart1"></canvas>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                // Récupérer les données de scores depuis le contrôleur ou à partir de votre logique
                                var scores = @json($scores);
                                var labels=@json($labels);

                                // Dessiner le graphique
                                var ctx = document.getElementById('order-chart1').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: labels, // Remplacez les labels par vos propres valeurs
                                        datasets: [{
                                            label: 'Scores',
                                            data: scores, // Utilisez les données de scores ici
                                            backgroundColor: 'rgba(0, 123, 255, 0.3)',
                                            borderColor: 'rgba(0, 123, 255, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }
                                });
                            </script>
                            </div>
                        </div>
                    </div>
{{--            <div class="content-wrapper1">--}}
            <div class="row" style="width: 800px;">
                    <div class="col-lg-12 grid-margin stretch-card"style="margin-left: 200px;">
                        <div class="card">
                            <div class="card-body"  style="border:none !important;">
                                <h4 class="card-title" style="   color: #36b5c7;">{{ $user->name  }} 's Scores monthly</h4>
                                <br>
                            </div>
                            <div style="width: 100%; height: 300px;">
                                <canvas id="monthly-chart"></canvas>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var monthlyScores = {!! json_encode($monthlyScores) !!};

                                var months = monthlyScores.map(item => item.month);
                                var scores = monthlyScores.map(item => item.averageScore);

                                var ctx = document.getElementById('monthly-chart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: months,
                                        datasets: [{
                                            label: 'Monthly Scores',
                                            data: scores,
                                            backgroundColor: 'rgba(0, 123, 255, 0.5)', // Change the bar color
                                            borderColor: 'rgba(0, 123, 255, 1)', // Change the border color
                                        }]
                                    },
                                    // Rest of the chart configuration...
                                });
                            </script>
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

