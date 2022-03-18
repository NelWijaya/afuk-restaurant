<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
    </head>
    <body>
    <main class="Site-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img src="<?php echo asset('images/logo.png')?>"  class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
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
                            <a class="nav-link active" href="/cart"><i class="fa fa-shopping-cart mr-2"></i>Cart ( <?php echo count($banyakCart)?> )</a>
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

        <div class="py-5">
            <div class="pt-5">
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-12">
                            @if($message = Session::get('suksesCheckout'))
                                <div class="alert alert-info alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"> </th>
                                            <th scope="col">Product</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-right">Price</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $total = 0;
                                        ?>
                                        @forelse($banyakCart as $key =>$cart )
                                            <form action="/cart/delete/{{ $cart->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <tr>
                                                    <td><img src="images/menu/{{ $cart->photo }}" alt="{{ $cart->photo }}" width="50" height="50" /> </td>
                                                    <td>{{ $cart->namaMenu }}</td>
                                                    <td><input class="form-control" type="text" value="1" disabled/></td>
                                                    <td class="text-right">{{ $cart->harga }}</td>
                                                    <td class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-danger" style="color:white" href="/cart/delete/{{ $cart->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    $total += $cart->harga;
                                                ?>
                                            </form>                                            
                                        @empty
                                                <tr> 
                                                    <td colspan="5" class="text-center">
                                                        <b>No Item</b>
                                                    </td>
                                                <tr>
                                        @endforelse
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>Total</strong></td>
                                            <td class="text-right"><strong>Rp. {{ $total }},-</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="row">
                                <div class="col-sm-12  col-md-6">
                                    <a class="btn btn-lg btn-block btn-light" href="/menu">Continue Shopping</a>
                                </div>
                                <div class="col-sm-12 col-md-6 text-right">
                                    <a class="btn btn-lg btn-block btn-success text-uppercase" href="/checkout/{{ $total }}">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div>
        
    </main>
        <footer class="footer">
            <h7>©copyright afuk</h7>
        </footer>


        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>
</html>
