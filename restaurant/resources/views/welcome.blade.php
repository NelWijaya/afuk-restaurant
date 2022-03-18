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
    <body >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img src="<?php echo asset('images/logo.png')?>"  class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
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


        <div class="jumbotron" data-aos="fade-up">
            <h1 class="display-4 mt-5">FOOD WITH LOVE</h1>
            <p class="lead">One cannot think well, love well and sleep well if one has not dined well.</p>
            <br class="my-4">
            <p>One of the very nicest things about life is the way we must regularly stop whatever it is we are doing and devote our attention to eating.</p>
            <p class="lead">
                <a class="btn btn-danger btn-lg mt-3" href="/menu" role="button">Order Now</a>
            </p>
        </div>

        {{-- Code PHP Looping menu populer (paling banyak di beli) --}}
        <div class="section-welcome px-3 py-3" data-aos="fade-up">
            <h4><a href="#" class="title">Our Main Cource</a></h4>
            <div class="popular-menus row">
                @forelse ($menuhome as $key =>$menusatu )
                    @if($key < 4)
                        <div class="col-6 col-md-4 col-lg-3 p-3 zoom-effect">
                            <div class="card text-center listmenu">
                                <img class="card-img-top pilihmenu" src="images/menu/{{ $menusatu->photo }}" alt="{{ $menusatu->photo }}" width="190px" height="190px" data-toggle="modal" data-target="#exampleModal{{ $menusatu->id }}">
                                <div class="card-body">
                                    <h5 class="card-title pilihmenu" data-toggle="modal" data-target="#exampleModal{{ $menusatu->id }}">{{ $menusatu->namaMenu }}</h5>
                                    <p class="card-text">Rp. {{ $menusatu->harga }},-</p>
                                    <a class="btn btn-primary" style="color:white;" href="/addCart/{{ $menusatu->id }}">Add to cart</a>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal{{ $menusatu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $menusatu->namaMenu }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="p-3">
                                        <img class="card-img-top pilihmenu" src="images/menu/{{ $menusatu->photo }}" alt="{{ $menusatu->photo }}" width="190px" height="190px" data-toggle="modal" data-target="#exampleModal">
                                    </div>
                                    <div class="modal-body">
                                        {{ $menusatu->deskripsi }}<br><br>
                                        Kategori &nbsp;: {{ $menusatu->kategori }}<br>
                                        harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp {{ $menusatu->harga }},-
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-primary" style="color:white;" href="/addCart/{{ $menusatu->id }}">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="m-auto"><h4>No Items</h4></div>
                @endforelse
            </div>
        </div>

        <div class="section3 px-3">
            <div class="row my-3">
                <div class="col-12">
                    <h3>Interested in Our Restaurant</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 m-auto">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.193315861465!2d106.6182854!3d-6.2573642!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x50c7d605ba8542f5!2sMultimedia%20Nusantara%20University!5e0!3m2!1sen!2sid!4v1615366249578!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-12 col-lg-6">
                    <h4 class="mb-3">Feedback</h4>
                    @if($message = Session::get('suksesFeedback'))
                        <div class="alert alert-info alert-block">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form method="POST" action="/sendFeedback">
                    @csrf
                        <div class="form-group">
                            <label for="nama">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="pesan">Isi Pesan</label>
                            <input type="text" class="form-control textarea" id="pesan" name="pesan" placeholder="isi Pesan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </form>
                </div>
            </div>
        </div>

        

        <footer class="footer mt-3">
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
