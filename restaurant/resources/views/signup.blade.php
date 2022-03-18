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
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body data-aos="fade-up">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper">
                    <div class="brand-wrapper my-4">
                        <a href="/"><img src="<?php echo asset('images/logo.png')?>" alt="logo" class="logo"></a>
                    </div>
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Sign Up Account</h1>

                        <form action="/posts" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="email">Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="first name" required>
                                <input type="text" name="lastname" id="lastname" class="form-control mt-2" placeholder="last name" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" required>
                                @if($message = Session::get('erroremail'))
                                <div class="alert alert-warning alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Tanggal Lahir</label>
                                <input class="form-control" name="tanggal" id="tanggal" type="date" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="gender" id="m" value="male"> Male
                                        
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="gender" id="f" value="female"> Female
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="g-recaptcha" data-sitekey="6LfQXVgaAAAAAEkB62SBFZZZX4el9b2aT9AKoWFz" style="margin-bottom: 10px;"></div> --}}
                            
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <button class="btn btn-block login-btn" type="submit">Sign Up</button>
                        </form>

                        <p class="login-wrapper-footer-text my-4"><b>Already have an account ?</b> <a href="/loginaccount" class="text-reset">Login here</a></p>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block gambar">
                    <img src="<?php echo asset('images/signin.png')?>" alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>
    <script>
  AOS.init();
</script>  
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>