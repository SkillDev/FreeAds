<?php
/**
*PHP version 5
*File doc comment
*@category Sniffer
*@package  Sniffer.Test
*@author   ANTON Maicmelan <maicmelan.anton@epitech.eu>
*@license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
*@link     http://intra.epitech.eu
*/
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Hash;
use DB;
use View;
use Auth;
use Redirect;
use App\Utilisateur;
/**
*PHP version 5
*Class doc domment
*
*@category Sniffer
*@package  Sniffer.Test
*@author   ANTON Maicmelan <maicmelan.anton@epitech.eu>
*@license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
*@link     http://intra.epitech.eu
*/
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()) {
            return view('accueil');
        } else {
            return view('login');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function utilisateur()
    {
        if (Auth::check()) {
            return view('accueil');
        } else {
            return view('inscription');
        }
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $input = Input::all();
        $verif = array(
            'username' => 'required|unique:users|min:5',
            'name' => 'required',
            'lastname' => 'required',
            'birthdate' => 'date',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5'
            );
        $send = Validator::make($input, $verif);
        if ($send->passes()) {
            $mdp = $input['password'];
            $mdp = Hash::make($mdp);
            $user = new Utilisateur();
            $user->username = $input['username'];
            $user->name = $input['name'];
            $user->birthdate = $input['birthdate'];
            $user->lastname = $input['lastname'];
            $user->email = $input['email'];
            $user->password = $mdp;
            $user->save();

            return Redirect::to('login');


        } else {
            return redirect('inscription')->withErrors($send);
        }
    }
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function login()
    {
        $input = Input::all();
        $verif = array(
            'username' => 'required',
            'password' => 'required'
            );

        $login = Validator::make($input, $verif);

        if ($login->passes()) {

            $donne = array(
                'username' => $input['username'],
                'password' => $input['password']
                );

            if (Auth::attempt($donne)) {

                return redirect('accueil');

            } else {

                return redirect('login')->withErrors($login);
            }
            
        } else {

            return redirect('login')->withErrors($login);
        }
    }
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function profil()
    {
        if (Auth::check()) {
            return view('profil');
        } else {
            return view('index');
        }
    }
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */    
    public function profilUpDate()
    {
        $input=Input::all();
        if (Auth::user()->username !== $input['username']) {

            $verif = array(
                'username' => 'required|unique:users|',
                );

        } elseif (Auth::user()->email !== $input['email']) {

            $verif = array(
                'email' => 'required|unique:users|email',
            );

        } elseif (Auth::user()->username !== $input['username'] && Auth::user()->email !== $input['email']) {

            $verif = array(
                'username' => 'required|unique:users|min:5',
                'email' => 'required|unique:users|email',
                );

        } elseif (Auth::user()->username == $input['username'] && Auth::user()->email == $input['email']) {

            return view('profil');

        }

        $yes = Validator::make($input, $verif);

        if ($yes->passes()) {
            if ($input['email'] !== Auth::user()->email && $input['username'] !== Auth::user()->username) {

                DB::update('update users set username = ?, email = ? where id = ?', [$input['username'], $input['email'], Auth::user()->id]);
                return redirect('accueil');

            } elseif ($input['email'] !== Auth::user()->email) {

                DB::update('update users set email = ? where id = ?', [$input['email'], Auth::user()->id]);
                return redirect('accueil');

            } elseif ($input['username'] !== Auth::user()->username) {

                DB::update('update users set username = ? where id = ?', [$input['username'], Auth::user()->id]);
                return redirect('accueil');

            }
        } else {

            return redirect('profil')->withErrors($verif);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function password()
    {
        if (Auth::user()) {
            return view('password');
        } else {
            return view('connexion');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function passwordChange()
    {
        $input = Input::all();
        $old = array(
            'password' => $input['old'],
            );
        $verif = array(
            'old' => 'required',
            'new' => 'required|min:5',
            'confirm' => 'required|min:5',
        );

        $change = Validator::make($input, $verif);
        if ($change->passes()) {
            if (Auth::attempt($old)) {
                if ($input['new'] === $input['confirm']) {
                    DB::update('update users set password = ? where id = ?', [Hash::make($input['new']), Auth::user()->id]);
                    return redirect('accueil');
                } else {
                    echo "non";
                }
            } else {
                return redirect('password')->withErrors($verif);
            }
        } else {
            return redirect('password')->withErrors($verif);
        }
    }
    /**
    * Process the return comment of this function comment.
    *
    * @return void
    */
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
