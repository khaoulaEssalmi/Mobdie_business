<style>
    .nav-right .profile-button {
        background-color: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    .nav-right .profile-button .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 130px;
        margin-right: 20px;
        margin-top: 10px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        top: 40px;
        right: 0;
    }
    .dropdown-content a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown-content a:hover {
        background-color: #fff;
        color: #333;
        transform: scale(1.2); /* Agrandir l'élément */
        transition: transform 0.3s; /* Ajouter une transition fluide */
    }

</style>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{asset("uploads/managers/avatars/logo.jpg")}}" class="mr-2" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <div class="nav-right">
                <div class="profile-button">
                    <img class="profile-image" src="{{asset("uploads/managers/avatars/" . auth()->user()->picture)}}" alt="Photo de profil">
                </div>
                <div class="dropdown-content">
                    <a href="#" style="font-style: inherit; font-size: 14px;"><i class="fas fa-user" style="color: #AD5DEC; font-size: 15px;"></i> &nbsp; Profil</a>
                    <a href="#" style="font-style: inherit; font-size: 14px;"><i class="fas fa-sign-out-alt" style="color: #AD5DEC; font-size: 15px;"> </i> &nbsp; Logout </a>
                </div>
            </div>
        </div>
    </nav>
</nav>
<script>
    window.onload = function() {
        var profileButton = document.querySelector('.profile-button');
        var dropdownContent = document.querySelector('.dropdown-content');

        profileButton.addEventListener('click', function() {
            dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            if (!profileButton.contains(event.target)) {
                dropdownContent.style.display = 'none';
            }
        });
    };

</script>
