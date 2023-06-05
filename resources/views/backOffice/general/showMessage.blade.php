@extends("backOffice.layout.panelAdmin")


@section("title","Inbox")

@section("style")
    <link rel="stylesheet" href="{{asset("css/admin/inbox.css")}}">
    <style>
        .email {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .email-header {
            margin-bottom: 10px;
        }

        .email-header p {
            margin: 0;
        }

        .email-content {
            margin-bottom: 10px;
            font-family: -apple-system;
            font-size: 18px;
            color: #0B0F32;

        }

        .email-content p{
            margin-bottom: 10px;
            line-height: 1.5;
            font-family: -apple-system;
            font-size: 18px;
            color: #0B0F32;

        }

        .email-footer {
            text-align: right;
        }

        .btn-reply {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-reply:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
@endsection


@section("content-wrapper")
    <div class="container">
        <div class="row">
            <!-- BEGIN INBOX -->
            <div class="col-md-12">
                <div class="grid email">
                    <div class="grid-body">
                        <div class="row">
                            <!-- BEGIN INBOX CONTENT -->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
                                    </div>
                                </div>
                                <div class="email">
                                    <div class="email-header">
                                        <p>De : {{ $message->email_emetteur }}</p>
                                        <br>
                                        <p>Date : {{$message->date_envoi}}</p>
                                    </div>
                                    <div class="email-content">
                                        <br>
                                        <p>{{ $message->Message }}</p>
                                    </div>
                                    <div class="email-footer">
                                        <a href="#" class="btn-reply">Répondre</a>
                                    </div>
                                </div>

                                <nav aria-label="Page navigation example" style="margin-top: 20px;">

                                </nav>
                            </div>
                            <!-- END INBOX CONTENT -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END INBOX -->
        </div>
    </div>
@endsection

@section("script")

@endsection
