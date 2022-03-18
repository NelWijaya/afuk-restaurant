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
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            } );
        </script>
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
    </head>
    <body>
    <main class="Site-content" data-aos="fade-up">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/admin">
                <img src="<?php echo asset('images/logo.png')?>"  class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/feedback">feedback</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin">Menu</a>
                        </li>
                     @if(isset(Auth::user()->role) == 'admin')
                        <li class="nav-item ml-lg-3 mr-4 pt-1">
                            <img src="images/profile/{{ Auth::user()->picture }}" class="mx-1" width="30" height="30" alt="">
                        </li>
                        <li class="nav-item ml-lg-3 mr-4 pt-1 ">
                            <a class="dropdown-item" href="/logout">Log Out</a>
                        </li>
                        
                    @else
                        <script>window.location = "/loginaccount";</script>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="pt-5">
        </div>
        <div class="container pt-5">
                        <form action="/newMenu" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h1 class="login-title">Tambah Menu </h1>
                            @if($message = Session::get('suksesTambah'))
                                <div class="alert alert-info alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="form-group mb-4">
                                <label for="namaMenu">Name</label>
                                <input type="text" name="namaMenu" id="namaMenu" class="form-control" placeholder="Nama Makanan" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="harga">Harga</label>
                                <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga Menu" required>
                            
                            </div>
                            <div class="form-group mb-4">
                                <label for="deskripsi">Deskripsi Makanan</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi makanan" required></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="file">Foto Makanan</label><br>
                                <input type="file" name="file" accept="image/x-png,image/jpeg,image/jpg" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kategori">Kategori Makanan</label><br>
                                <select class="custom-select" id="kategori" name="kategori">
                                    <option value="main">Main Cource</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="snack">Snack and Appetizers</option>
                                    <option value="seafood">Seafood</option>
                                    <option value="vegetarian">Vegetarian</option>
                                    <option value="drinks">Drinks</option>
                                </select>
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
                            <button class="btn btn-primary" type="submit"><img src="images/plus.png" alt="Plus Icon" width="30" height="30"/> Tambah Menu</button>
                        </form><br><br><br>
        </div>
        <hr>
    <div class="container">
    <h1 class="login-title">List Menu</h1>
                            @if($message = Session::get('suksesEdit'))
                                <div class="alert alert-info alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
        <table id="table" class="table table-striped mb-5">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Nama Makanan</th>
                    <th> Harga </th>
                    <th> Deskripsi</th>
                    <th> Gambar </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menuhome as $key =>$menusatu )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $menusatu->namaMenu }}</td>
                        <td>{{ $menusatu->harga }}</td>
                        <td>{{ $menusatu->deskripsi }}</td>
                        <td><img src="images/menu/{{ $menusatu->photo }} " width="50" height="50"><br>{{ $menusatu->photo }}</td>
                        <td>
                            <a href="/deleteMenu/{{ $menusatu->id }}"><i class="fa fa-trash-o" style="font-size:30px;color:red"></i></a><br>
                            <a href="/editMenu/{{ $menusatu->id }}"><i class="fa fa-edit" style="font-size:30px;color:green"></i></a>

                        </td>
                    </tr>
                @empty
                    
                @endforelse
                
            </tbody>
            <tfoot>
                <tr>
                    <th> # </th>
                    <th> Nama Makanan</th>
                    <th> Harga </th>
                    <th> Deskripsi </th>
                    <th> Gambar </th>
                    <th> Action </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <script>
  AOS.init();
</script>    
    </main>
        <footer class="footer">
            <h7>©copyright afuk</h7>
        </footer>

    </body>
</html>
