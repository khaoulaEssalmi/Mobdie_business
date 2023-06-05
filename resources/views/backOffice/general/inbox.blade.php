@extends("backOffice.layout.panelAdmin")


@section("title","Inbox")

@section("style")
    <link rel="stylesheet" href="{{asset("css/admin/inbox.css")}}">
    <style>
        .inbox {
            border: 2px solid #000;
            border-radius:3px;
            padding: 10px;
        }

        .message {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
            background-color: white;
        }

        .unread {
            background-color: #a1a7e4;
        }

        .envelope {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background-color: white;
        }

        .envelope i {
            font-size: 24px;
        }

        .icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .message .content h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 0px;
            color: #333;
        }
        .message .content p {
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 0px;
            color: #000;
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
                                        <h2 class="grid-title" style="color: #AD5DEC "><i class="fa fa-inbox" style="color: #AD5DEC "></i style="color: #AD5DEC "> Inbox</h2>
                                    </div>
                                </div>
                                    <div class="inbox">
                                        @foreach($messages as $message)
                                            <div class="message {{ $message->state == 1 ? 'unread' : 'read' }}" onclick="redirectToMessage({{ $message->id }})">
                                                <div class="envelope">
                                                    <i class="fas fa-envelope{{ $message->state == 1 ? '' : '-open' }}" style="width: 20px;"></i>
                                                </div>
                                                <div class="icon"></div>
                                                <div class="content">
                                                    <h3><b>{{ $message->date_envoi }}</b></h3>
                                                    <p>{{ $message->Message }}</p>
                                                    <div id="details-{{ $message->id }}" class="details hidden">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      function redirectToMessage(messageId) {
          // alert("ID du message : " + messageId);
          var url = "{{ route('general.message.show') }}";
          url = url.replace(':id', messageId);
          url += "?id=" + messageId;
          // alert(url);
          window.location.href = url;
      }
  </script>
@endsection
