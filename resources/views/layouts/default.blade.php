<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <!-- <link href="" rel="stylesheet" /> -->
        @vite('resources/css/styles.css')
        @vite('resources/js/scripts.js')
        @vite('resources/js/bootstrap.js')
        @vite('resources/css/bootstrap.min.css')
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
              font-family: Arial, Helvetica, sans-serif;
            }
            
            * {
              box-sizing: border-box;
            }
            
            /* Add padding to containers */
            .container {
              padding: 16px;
              background-color: white;
            }
            
            /* Full-width input fields */
            input[type=text], input[type=password] {
              width: 100%;
              padding: 15px;
              margin: 5px 0 22px 0;
              display: inline-block;
              border: none;
              background: #f1f1f1;
            }
            
            input[type=text]:focus, input[type=password]:focus {
              background-color: #ddd;
              outline: none;
            }
            
            /* Overwrite default styles of hr */
            hr {
              border: 1px solid #f1f1f1;
              margin-bottom: 25px;
            }
            
            /* Set a style for the submit button */
            .registerbtn {
              border-radius: 35px;
              background-color: #04AA6D;
              color: white;
              padding: 16px 20px;
              margin: 8px 8px;
              border: none;
              cursor: pointer;
              width: 100%;
              opacity: 0.9;
            }
            
            .registerbtn:hover {
              opacity: 1;
            }
            
            /* Add a blue text color to links */
            a {
              color: dodgerblue;
            }
            
            /* Set a grey background color and center the text of the "sign in" section */
            .signin {
              background-color: #f1f1f1;
              text-align: center;
            }
            </style>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                        padding: 0;
                        background-color: #f4f4f9;
                    }
            
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        font-size: 18px;
                        text-align: left;
                        background-color: #fff;
                    }
            
                    th, td {
                        padding: 12px 15px;
                        border: 1px solid #ddd;
                    }
            
                    th {
                        background-color: #212529;
                        color: white;
                        text-transform: uppercase;
                    }
            
                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
            
                    tr:hover {
                        background-color: #f1f1f1;
                    }
            
                    .actions {
                        display: flex;
                        justify-content: space-between;
                    }
            
                    .actions button {
                        padding: 5px 10px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;
                    }
            
                    .actions .edit {
                        background-color: dodgerblue;
                        color: white;
                    }
            
                    .actions .delete {
                        background-color: #dc3545;
                        color: white;
                    }
            
            
                    .actions .delete:hover {
                        background-color: #c82333;
                    }
                </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">MR Manager</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{route('index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="{{route('groups')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Students
                            </a>
                            <a class="nav-link" href="{{route('groups.form')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Payments
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">

                        <div class="small">Logged in as:</div>
                        @if(Auth::check())
                        <p> {{ Auth::user()->name }}  !</p>
                        <p>Email: {{ Auth::user()->email }}</p>
                    @else
                        <p>Welcome, Guest!</p>
                    @endif
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                {{-- Main --}}
                <main class="m-5">
                    @yield('main')
                    {{-- End Main --}}
                </main>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        @vite('resources/js/datatables-simple-demo.js')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        {{-- <script src="js/datatables-simple-demo.js"></script> --}}
    </body>
    <script>
        let successMessage = document.getElementById('success-message');
    
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById("confirmAction").addEventListener("click", function() {
        
        $('#myModal').modal('hide');
    });
</script>

    
    
</html>
