<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restoran UTS IF430</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
</head>

<body data-aos="fade-up">
    <main >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="<?php echo asset('images/login.png')?>" alt="login image" class="login-img">
                </div>
                <div class="col-sm-6 login-section-wrapper">
                    <div class="brand-wrapper">
                        <a href="/"><img src="<?php echo asset('images/logo.png')?>" alt="logo" class="logo"></a>
                    </div>
                
                    <div class="login-wrapper my-auto">
                        @if($message = Session::get('suksesregist'))
                            <div class="alert alert-info alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <h1 class="login-title">Login Account</h1>
                        <form action="{{ url('/loginaccount/check') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="email@example.com">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="myInput" class="form-control" placeholder="enter your passsword">
                                <input class="mt-3" type="checkbox" onclick="myFunction()">&nbsp;&nbsp;Show Password
                            </div>
                            {{-- Check Login --}}
                            @if(isset(Auth::user()->email))
                                <script>
                                    window.location = "/";
                                </script>
                            @endif

                            @if($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button class="btn btn-block login-btn" type="submit">Login</button>
                        </form>
                        <p class="login-wrapper-footer-text"><b>Don't have an account?</b> <a href="/signup" class="text-reset">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
    </script>
    <script>
  AOS.init();
</script>  
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>