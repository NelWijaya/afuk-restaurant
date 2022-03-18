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
    <main class="Site-content" >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/admin">
                <img src="<?php echo asset('images/logo.png')?>"  class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <hr>
    <div class="container" data-aos="fade-up">
    <h1 class="login-title">List Feedback</h1>
    
                            @if($message = Session::get('deleteFeedback'))
                                <div class="alert alert-info alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
        <table id="table" class="table table-striped mb-5">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Nama Pengirim</th>
                    <th> Isi Pesan </th>
                    <th> Waktu</th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $key =>$satu )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $satu->nama }}</td>
                        <td>{{ $satu->isiPesan }}</td>
                        <td>{{ $satu->waktu }}</td>
                        <td>
                            <a href="/deleteFeedback/{{ $satu->id }}"><i class="fa fa-trash-o" style="font-size:30px;color:red"></i></a><br>
                        </td>
                    </tr>
                @empty
                    
                @endforelse
                
            </tbody>
            <tfoot>
                <tr>
                    <th> # </th>
                    <th> Nama Pengirim</th>
                    <th> Isi Pesan </th>
                    <th> Waktu</th>
                    <th> Action </th>
                </tr>
            </tfoot>
        </table>
    </div>    
    </main>
        <footer class="footer">
            <h7>©copyright afuk</h7>
        </footer>
<script>
  AOS.init();
</script>  
    </body>
</html>
