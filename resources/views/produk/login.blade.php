<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
    <style>
    body {
        background-image: url('images/bg login.jpeg');
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Logo di sini -->
                        <img src="{{asset('images/logo.png')}}" alt="Logo Nendra Print" class="logo">
                        <h2 class="card-title text-center mb-4"><b>Login <br>SiRekap Nendra Print</b></h2>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username"><i class="icon fas fa-user"></i>Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="icon fas fa-lock"></i>Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke FontAwesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Link ke Bootstrap JS dan dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
