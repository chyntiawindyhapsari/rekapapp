<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Laravel - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor')}}/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css')}}/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 350px;
            height: 250px;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 text-center logo-container">
                        <!-- Logo above the form -->
                        <img src="{{ asset('template/img')}}/Logo Polinema.png" alt="Logo">
                    </div>

                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{route('register')}}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <div>
                                        <input type="text" name="name" class="form-control form-control-user  @error('name') is-invalid @enderror" id="exampleFirstName"
                                            placeholder="Full Name">

                                            @error('name')
                                            <span class="invalid-feedback" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
        
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                        placeholder="Email Address">

                                        @error('email')
                                            <span class="invalid-feedback" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Password">

                                            @error('password')
                                            <span class="invalid-feedback" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user form-control-user @error('password_confirmation') is-invalid @enderror"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">

                                            @error('password_confirmation')
                                            <span class="invalid-feedback" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor')}}/jquery/jquery.min.js"></script>
    <script src="{{ asset('template/vendor')}}/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor')}}/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js')}}/sb-admin-2.min.js"></script>

</body>

</html>
