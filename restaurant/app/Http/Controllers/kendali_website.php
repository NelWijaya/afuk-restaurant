<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Image;
use Hash;
use Auth;
use Validator;
use DB;

class kendali_website extends Controller
{
    // Halaman Page
    public function home(){
        $menuhome = DB::table('menus')->where('kategori', 'main')->get();
        if(isset(Auth::user()->email)){
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            return view('welcome', compact('menuhome','banyakCart'));
        }
        
        //dd($menuhome);
        return view('welcome', compact('menuhome'));
    }

    public function halamanLogin(){
        return view('/login');
    }

    public function menuPage(Request $request){
        $menuhome = DB::table('menus')->get();
        if(isset(Auth::user()->email)){
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            return view('/menu', compact('menuhome','banyakCart'));
        }

        return view('/menu', compact('menuhome'));
    }

    public function menuPageSearch(Request $request){
        //dd($request->all());
        if(isset(Auth::user()->email)){
            $menuhome = DB::table('menus')->where('kategori', $request['search'])->get();
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            //dd($menuhome);
            return view('/menu', compact('menuhome','banyakCart'));
        }
        $menuhome = DB::table('menus')->where('kategori', $request['search'])->get();
        return view('/menu', compact('menuhome'));
    }

    public function halamanSignup(){
        return view('/signup');
    }

    public function sukses(){
        return view('posts.sukses');
    }
    // END Halaman Page


    // POST GET
    public function daftarAkun(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum|min:8'
        ]);
        
        if($request->get('email'))
        {
            $email = $request->get('email');
            $data = DB::table("users")
                ->where('email', $email)
                ->count();
            if($data > 0)
            {
                return back()->with('erroremail','Email sudah digunakan');
            }
            else
            {
                $query = DB::table('users')->insert([
                    "firstname" => $request["firstname"],
                    "lastname" => $request["lastname"],
                    "email" => $request["email"],
                    "password" =>  Hash::make($request["password"]),
                    "tgllahir" => $request["tanggal"],
                    "gender" => $request["gender"],
                    "role" => "user",
                    "picture" => "default_".$request["gender"].".png"
                ]);
                
                return redirect('/loginaccount')->with('suksesregist', 'Akun berhasil didaftarkan');
            }
        }
    }

    public function changeData(Request $request){
        //dd($request->all());
        //echo $request["file"];
        $file = $request->file('file');
        $tujuan_upload = 'images/profile';
        $this->validate($request,[
            'firstname' =>  'required',
            'lastname' =>  'required',
            'tgllahir' =>  'required',
            'gender' =>  'required',
            'password'  =>  'required|min:8'
        ]);

        if($request["file"] != NULL){
            $file->move($tujuan_upload, Auth::user()->email.'.'.$file->getClientOriginalExtension());
            
            if(Auth::user()->password == $request['password']){
                $query = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update([
                            'firstname' => $request['firstname'],
                            'lastname' => $request['lastname'],
                            'tgllahir' => $request['tgllahir'],
                            'gender' => $request['gender'],
                            'password' => $request['password'],
                            'picture' => Auth::user()->email.'.'.$file->getClientOriginalExtension()
                        ]);
            }
            else{
                $query = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update([
                            'firstname' => $request['firstname'],
                            'lastname' => $request['lastname'],
                            'tgllahir' => $request['tgllahir'],
                            'gender' => $request['gender'],
                            'password' => Hash::make($request["password"]),
                            'picture' => Auth::user()->email.'.'.$file->getClientOriginalExtension()
                        ]);
            }
        }else{
            if(Auth::user()->password == $request['password']){
                $query = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update([
                            'firstname' => $request['firstname'],
                            'lastname' => $request['lastname'],
                            'tgllahir' => $request['tgllahir'],
                            'gender' => $request['gender'],
                            'password' => $request['password']
                        ]);
            }
            else{
                $query = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update([
                            'firstname' => $request['firstname'],
                            'lastname' => $request['lastname'],
                            'tgllahir' => $request['tgllahir'],
                            'gender' => $request['gender'],
                            'password' => Hash::make($request["password"])
                        ]);
            }
        }
    
        return redirect('/test')->with('suksesChange', 'Data berhasil di ubah');
    }

    public function checkLogin(Request $request){
        $this->validate($request,[
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum'
        ]);

        $user_data = array(
            'email'     =>  $request->get('email'),
            'password'  =>  $request->get('password')
        );
        
        if(Auth::attempt($user_data) && Auth::user()->role == 'admin')
        {
            return redirect('/admin');
        }else if(Auth::attempt($user_data) && Auth::user()->role == 'user'){
            return redirect('/');
        }   
        else
        {
            return back()->with('error','Email atau password salah');
        }
    }

    public function sendFeedback(Request $request){
        //dd(date('Y-m-d H:i:s'));
        $this->validate($request,[
            'nama'     =>  'required',
            'pesan'  =>  'required'
        ]);
        
        
        $query = DB::table('feedback')->insert([
            "nama" => $request["nama"],
            "isiPesan" => $request["pesan"],
            "waktu" => date('Y-m-d H:i:s')
        ]);
        
        return redirect('/')->with('suksesFeedback', 'Feedback Terkirim');
    }

    public function addCart($id){
        if(isset(Auth::user()->email)){
            $tambah = DB::table('menus')->where('id', $id)->get();
            //dd($tambah[0]);
            $query = DB::table('cart')->insert([
                "idUser" => Auth::user()->id,
                "idMenu" => $tambah[0]->id,
                "photo" => $tambah[0]->photo,
                "namaMenu" => $tambah[0]->namaMenu,
                "harga" => $tambah[0]->harga
            ]);
            return redirect('/menu');
        }else{
            return redirect('/loginaccount');
        }
    }

    public function cart(){
        if(isset(Auth::user()->email)){
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            return view('/cart', compact('banyakCart'));
        }else{
            return redirect('/loginaccount');
        }
    }

    public function deleteCart($id){
        if(isset(Auth::user()->email)){
            $query = DB::table('cart')->where('id', $id)->delete();
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            return view('/cart', compact('banyakCart'));
        }else{
            return redirect('/loginaccount');
        }
    }

    public function checkout($total){
        if(isset(Auth::user()->email)){
            $query = DB::table('purchased')->insert([
                "idUser" => Auth::user()->id,
                "total" => $total
            ]);
            $query = DB::table('cart')->where('idUser', Auth::user()->id)->delete();
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            return view('/cart', compact('banyakCart'))->with('suksesCheckout', 'Makanan Berhasil di Checkout !!!');
        }else{
            return redirect('/loginaccount');
        }
    }

    public function create(){
        
        if(isset(Auth::user()->email)){
            $banyakCart = DB::table('cart')->where('idUser', Auth::user()->id)->get();
            return view('posts.create', compact('banyakCart'));
        }else{
            return redirect('/loginaccount');
        }
    }

    public function admin(){
        if(Auth::user()->role == 'admin' ){
            $menuhome = DB::table('menus')->get();
            return view('admin', compact('menuhome'));
        }else{
            return redirect('/loginaccount');
        }
    }

    public function deleteMenu($id){
        if(Auth::user()->role == 'admin'){
            $query = DB::table('menus')->where('id', $id)->delete();
            // dd($query);
            return redirect('/admin');
        }else{
            return redirect('/loginaccount');
        }
    }

    public function newMenu(Request $request){
        $file = $request->file('file');
        $tujuan_upload = 'images/menu';
        if(Auth::user()->role=='admin'){
            $query = DB::table('menus')->insert([
                "namaMenu" =>$request['namaMenu'],
                "harga" =>$request['harga'],
                "photo" =>$request['namaMenu'].'.'.$file->getClientOriginalExtension(),
                "deskripsi" =>$request['deskripsi'],
                "kategori" => $request['kategori']
            ]);
            $file->move($tujuan_upload, $request['namaMenu'].'.'.$file->getClientOriginalExtension());
            return redirect('/admin')->with('suksesTambah', 'Makanan Berhasil di Tambah !!!');
        }else{
            return redirect('/loginaccount');
        }
    }

    public function editMenu($id){
        if(Auth::user()->role == 'admin'){
            //dd($request->all());
            $data = DB::table('menus')->where('id', $id)->first();
            return view('/adminedit', compact('data'));
        }else{
            return redirect('/loginaccount');
        }
    }

    public function editedMenu($id, Request $request){
        //dd($request->all());
        $file = $request->file('file');
        $tujuan_upload = 'images/menu';
        if(Auth::user()->role == 'admin'){
            
            if($request["file"] != NULL){
                $file->move($tujuan_upload, $request['namaMenu'].'.'.$file->getClientOriginalExtension());
                    $query = DB::table('menus')
                            ->where('id', $id)
                            ->update([
                                'namaMenu' => $request['namaMenu'],
                                'harga' => $request['harga'],
                                'deskripsi' => $request['deskripsi'],
                                'kategori' => $request['kategori'],
                                'picture' => $request['namaMenu'].'.'.$file->getClientOriginalExtension()
                            ]);
            }else{
                $query = DB::table('menus')
                ->where('id', $id)
                ->update([
                    'namaMenu' => $request['namaMenu'],
                    'harga' => $request['harga'],
                    'deskripsi' => $request['deskripsi'],
                    'kategori' => $request['kategori']
                ]);
            }
            return redirect('/admin')->with('suksesEdit', 'Makanan Berhasil di Ubah !!!');
        }else{
            return redirect('/loginaccount');
        }
    }

    public function feedback(){
        if(Auth::user()->role == 'admin'){
            //dd($request->all());
            $data = DB::table('feedback')->get();
            return view('/feedback', compact('data'));
        }else{
            return redirect('/loginaccount');
        }
    }

    public function deleteFeedback($id){
        if(Auth::user()->role == 'admin'){
            $query = DB::table('feedback')->where('id', $id)->delete();
            // dd($query);
            return redirect('/feedback');
        }else{
            return redirect('/loginaccount')->with('deleteFeedback', 'Feedback dihapus !!!');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}


