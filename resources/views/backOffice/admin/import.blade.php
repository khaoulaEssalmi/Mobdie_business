@extends("backOffice.layout.panelAdmin")

@section("style")
    <link rel="stylesheet" href="{{asset("adminPanel")}}/vendors/mdi/css/materialdesignicons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 3px solid #000000;
            border-radius: 5px;

        }


    .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size:12px;

        }

        .form-group input[type="file"] {
            margin-top: 10px;
            padding: 10px;
            border: 2px solid #000000;
            border-radius: 5px;
            width:400px;
            /*background-color: #ffcd39;*/

        }

        /*.form-group button {*/
        /*    padding: 10px 20px;*/
        /*    background-color: #4CAF50;*/
        /*    color: #000000;*/
        /*    border: none;*/
        /*    border-radius: 5px;*/
        /*    cursor: pointer;*/
        /*}*/
        .import-button {
            padding: 10px 20px;
            /*background-color: #727EE9;*/
            background-color:#ad5decc9;
            color: #000000;
            border: none;
            font-size: 20px;
            margin-left: 250px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .import-button:hover {
            color: #FFFFFF; /* Modifier la couleur du texte en blanc */
        }
        .import-button i {
            margin-right: 5px;

        }
    </style>
@endsection


@section("content-wrapper")
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Succès',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="main-panel">
        <div class="content-wrapper1">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: transparent !important;">
                        <div class="card-body1" style=" background-color:transparent !important;">
                            <div class="container" style="    background-color: #e9ecef;">
                                <h2 style="color: #2b2e4c; font-size: 24px; font-family: Arial; ">Importer un fichier CSV</h2>
                                <form action="{{ route('admin.import.csv') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
<br>
                                        <label for="csvFile">Sélectionnez un fichier CSV :</label>
                                        <input type="file" id="csvFile" name="csvFile" style="background-image: linear-gradient(45deg, #ad5dec, transparent);" >
                                    </div>
                                    <div class="form-group">
                                            <button type="submit" onclick="" class="import-button">
                                                <i class="fas fa-file-import"></i>&nbsp; Importer
                                            </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

