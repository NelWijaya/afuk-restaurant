<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Restoran UTS IF430</title>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
    </head>
    <body>
    <main class="Site-content" data-aos="fade-up">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img src="<?php echo asset('images/logo.png')?>"  class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>

                    @if(isset(Auth::user()->email))
                        <li class="nav-item">
                            <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart mr-2"></i>Cart ( <?php echo count($banyakCart)?> )</a>
                        </li>
                        <li class="nav-item ml-lg-3 mr-4 pt-1 dropdown">
                            <div class="dropdown-toggle profile-dropdown" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/profile/{{ Auth::user()->picture }}" class="mx-1" width="30" height="30" alt="">
                                <strong>{{ Auth::user()->firstname }}</strong>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/test">Edit Profile</a>
                                <a class="dropdown-item" href="/logout">Log Out</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item ml-lg-5">
                            <a type="button" class="btn btn-danger" href="/loginaccount">Login</a>
                            <a type="button" class="btn btn-outline-danger" href="/signup">Sign Up</a>
                        </li>
                    @endif

                    
                    
                    
                     {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>  --}}
                </ul>
            </div>
        </nav> 

        @if(isset(Auth::user()->email))
            <div class="container pt-md-5 pt-4" >
                <div class="row pt-md-4 pt-3" >
                    <div class="col-12 col-md-5 p-5">
                        <div class="m-auto">
                            <img class="card-img-top" src="images/profile/{{ Auth::user()->picture }}" width="250" height="250"  alt="Card image cap">
                            
                            <form action="{{ url('/updatedata') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body m-auto mb-5">
                                <p class="card-text">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                                <input type="file" name="file" accept="image/x-png,image/jpeg,image/jpg">
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-md-7 card p-4 mt-5 mt-md-0">
                        <table>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if($message = Session::get('suksesChange'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            
                            @csrf
                                <tr>
                                    <td class="p-3">
                                        <strong>First Name</strong>
                                    </td>
                                    <td>
                                        <input  type="text" name="firstname" id="firstname" class="form-control" placeholder="first name" value="{{ Auth::user()->firstname }}" required> 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3">
                                        <strong>Last Name</strong>
                                    </td>
                                    <td>
                                        <input type="text" name="lastname" id="lastname" class="form-control mt-2" placeholder="last name" value="{{ Auth::user()->lastname }}" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3">
                                        <strong>Email</strong>
                                    </td>
                                    <td>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" value="{{ Auth::user()->email }}" disabled>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3">
                                        <strong>Tanggal Lahir</strong>
                                    </td>
                                    <td>
                                        <input class="form-control" name="tgllahir" id="tgllahir" type="date" value="{{ Auth::user()->tgllahir }}" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3">
                                        <strong>Gender</strong>
                                    </td>
                                    <td>
                                        <select name="gender" id="gender">
                                            @if( Auth::user()->gender == 'female')
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>
                                            @else
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>                                    
                                            @endif
                                            
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3">
                                        <strong>Password</strong>
                                    </td>
                                    <td>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword" value="{{ Auth::user()->password}}" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <div class="m-auto pt-5" >
                                            <button class="btn btn-danger" type="submit">Submit Edit</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <script>window.location = "/loginaccount";</script>
            {{-- <li class="nav-item ml-lg-5">
                <a type="button" class="btn btn-danger" href="/loginaccount">Login</a>
                <a type="button" class="btn btn-outline-danger" href="/signup">Sign Up</a>
            </li> --}}
        @endif
        
    </main>
    <footer class="footer">
        <h7>©copyright afuk</h7>
    </footer>

<script>
  AOS.init();
</script>  
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>
</html>

