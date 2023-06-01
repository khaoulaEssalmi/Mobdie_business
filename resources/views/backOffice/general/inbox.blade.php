@extends("backOffice.layout.panelAdmin")


@section("title","Inbox")

@section("style")
    <link rel="stylesheet" href="{{asset("css/admin/inbox.css")}}">
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

                                    <div class="col-md-6 search-form">
                                        <form action="#" class="text-right">
                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm search-msg" placeholder="Search">
                                                <span class="input-group-btn">
                                            <button type="submit" name="search" class="btn_ btn-primary btn-sm search"><i class="fa fa-search"></i></button></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="padding"></div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        @foreach($messages as $message)
                                            <tr {{$message->state == 1 ? 'class=unread' : ""}} class="show-msg" data-toggle="modal" data-target="#compose-modal{{$message->id}}" data-id="{{$message->id}}" onclick="markAsRead(this)" >
                                                <td class="action"><i class=" {{$message->state == 1 ? 'far fa-envelope' : 'fa fa-envelope-open'}}"></i></td>
                                                <td class="subject"><a >{{$message->Message}} </a></td>
                                                <td class="time">{{$message->date_envoi}}</td>
                                            </tr>
                                            <!-- BEGIN COMPOSE MESSAGE -->
                                            <div class="modal fade" id="compose-modal{{$message->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-wrapper">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-body">
                                                                <span class="message title"><h1>Message</h1></span>
                                                                <div class="message-body">{{$message->Message}}</div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END COMPOSE MESSAGE -->
                                        @endforeach
                                        <form class="csrf-token" action="" method="POST">
                                            @csrf
                                        </form>
                                        </tbody>
                                    </table>
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

        function markAsRead(element) {
            element.classList.remove('unread');
            element.querySelector('.fa-envelope').classList.remove('far');
            element.querySelector('.fa-envelope').classList.add('fa-envelope-open');
        }

        $(".delete-msg").on("click",function (e) {
            e.preventDefault();
            e.stopPropagation();
            let token = $("form.csrf-token").serialize();
            let data = token + "&id=" + $(this).attr("data-id");
            console.log(data);
            let row = $(this);
            Swal.fire({
                title: 'Es-tu sûr?',
                text: "Vous souhaitez supprimer ce message!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'confirmer !'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax("/admin/message/delete",{
                        type: "post",
                        data: data,
                        success: function (data) {
                            if(data === "ok"){
                                row.parent().hide();
                                Swal.fire(
                                    'Supprimé!',
                                    'Le message a été supprimée.',
                                    'success'
                                )
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "Quelque chose s'est mal passé!",
                                })
                            }
                        },
                    });


                }
            })
        })

        function markAsRead(element)  {
            e.preventDefault();
            let token = $("form.csrf-token").serialize();
            console.log(token);
            let data = token + "&id=" + $(this).attr("data-id");
            let row = $(this);
            if (!row.hasClass("read")){
                console.log("Before AJAX request");

                $.ajax("/general/message/setRead",{
                    type: "post",
                    data: data,
                    success: function (data) {
                        console.log("AJAX success"); // Ajouter une ligne de débogage
                        console.log("data");
                        if(data === "ok"){
                            row.addClass("unread");
                            row.attr("data-toggle", "modal");
                            row.attr("data-target", "#compose-modal"+row.attr("data-id"));
                            row.children(".action").children( ".fa-envelope" ).addClass("fa-envelope-open").addClass("far").removeClass("fa").removeClass("fa-envelope");
                        }
                    },
                });
            }
        }
        function markAsRead(element) {
            element.classList.remove('unread');
            element.querySelector('.fa-envelope').classList.remove('far');
            element.querySelector('.fa-envelope').classList.add('fa-envelope-open');

            var url = element.getAttribute('data-url');

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Réponse reçue du serveur (si nécessaire)
                    console.log(data);
                })
                .catch(error => {
                    // Gestion des erreurs
                    console.error('Une erreur s\'est produite :', error);
                });
        }

    </script>
@endsection
