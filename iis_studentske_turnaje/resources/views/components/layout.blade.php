<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="{{asset('images/polarbear.jpg')}}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                            yellowish: "#c69749",
                            brownish: "#735f32",
                            grayish: "#282a3a"
                        },
                    },
                },
            };
        </script>
        <script type="text/javascript">
            var mini = true;
            function toggleSidebar() {
                if (mini) {
                    console.log("opening sidebar");
                    document.getElementById("mySidebar").style.width = "300px";
                    document.getElementById("main").style.marginLeft = "300px";
                    this.mini = false;
                } else {
                    console.log("closing sidebar");
                    document.getElementById("mySidebar").style.width = "65px";
                    document.getElementById("main").style.marginLeft = "65px";
                    this.mini = true;
                }
            }
        </script>
        <script>
            let modalBtns = [...document.querySelectorAll(".button")];
            modalBtns.forEach(function (btn) {
              btn.onclick = function () {
                let modal = btn.getAttribute("data-modal");
                document.getElementById(modal).style.display = "block";
              };
            });
            let closeBtns = [...document.querySelectorAll(".close")];
            closeBtns.forEach(function (btn) {
              btn.onclick = function () {
                let modal = btn.closest(".modal");
                modal.style.display = "none";
              };
            });
            window.onclick = function (event) {
              if (event.target.className === "modal") {
                event.target.style.display = "none";
              }
            };
          </script>
        <style>
            .sidebar {
                height: 100%;
                width: 65px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: rgb(0, 0, 0);
                transition: 0.5s;
                overflow-x: hidden;
                padding-top: 100px;
                white-space: nowrap;
            }
            .sidebar a , .sidebar form{
                padding: 8px 8px 8px 25px;
                text-decoration: none;
                color: #6b7280;
                display: block;
            }
            .sidebar a:hover {
                color: #f1f1f1;
            }
            .sidebar form:hover {
                color: #ff000096;
            }
            #main {
                padding: 16px;
                margin-left: 65px;
                transition: margin-left 0.5s;
            }
            a span , form span{
                margin-left: 25px;
            }
            body {
                background-color: #282A3A;
                color: white;
            }        
	</style>
        <title>Studentske turnaje</title>
    </head>
    <body>
        <div id="mySidebar" class="sidebar" onmouseover="toggleSidebar()" onmouseout="toggleSidebar()">
            <a href="{{url('/')}}"><img src="{{asset('images/sword.webp')}}" alt="" class="logo"/></a>
            @auth
                <hr>
                <a href="{{url('/tournaments')}}"><i class="fa-solid fa-trophy"></i><span>Tournaments</span></a>
                <a href="{{url('/my_tour')}}"><i class="fa-solid fa-calendar"></i><span>My Tournaments</span></a>
                <a href="{{url('/tournaments/create')}}"><i class="fa-solid fa-plus"></i><span>Create Tournament</span></a>
                <hr>
                <a href="{{url('/teams')}}"><i class="fa-solid fa-people-group"></i><span>Teams</span></a>
                <a href="{{url('/my_teams')}}"><i class="fa-brands fa-teamspeak"></i><span>My Teams</span></a>
                <a href="{{url('/teams/create')}}"><i class="fa-solid fa-plus"></i><span>Create Team</span></a>
                <hr>
                <a href="{{url('/users')}}"><i class="fa-solid fa-users"></i><span>Users</span></a>
                <a href="{{url('/users/' . Auth::user()->id)}}"><i class="fa-solid fa-user-secret"></i><span>Profile</span></a>
                @if (Auth::user()->role == 1)
                <hr>
                <a href="{{url('/admin/users')}}"><i class="fa-solid fa-users"></i><span>Manage users</span></a>
                <a href="{{url('/admin/tournaments')}}"><i class="fa-solid fa-trophy"></i><span>Manage tournaments</span></a>
                @endif
                <form action="{{url('/logout')}}" method="post" class="inline">
                    @csrf
                    <button type="submit"><i class="fa-solid fa-door-closed"></i><span>Logout</span></button>
                </form>
                <hr>
            @else
                <a href="{{url('/register')}}"><i class="fa-solid fa-user-plus"></i><span>Register</span></a>
                <a href="{{url('/login')}}"><i class="fa-solid fa-arrow-right-to-bracket"></i><span>Login</span></a>
                <a href="{{url('/tournaments')}}"><i class="fa-solid fa-trophy"></i><span>Tournaments</span></a>
                <a href="{{url('/teams')}}"><i class="fa-solid fa-people-group"></i><span>Teams</span></a>
                <a href="{{url('/users')}}"><i class="fa-solid fa-users"></i><span>Users</span></a>
            @endauth    
        </div>
        <div id="main">
            <main>
                {{$slot}}
            </main>
        </div>
    </body>
    <x-flash-message/>
</html>