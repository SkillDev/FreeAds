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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Auth;
use Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Utilisateur;
use App\Annonce;
use DB;
use Mail;
use Hash;
use View;
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
class AnnoncesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function view()
    {
        if (Auth::check()) {
            return view('view');
        } else {
            return view('index');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function published()
    {
        $donne = DB::select('select * from annonces WHERE id_user =' . Auth::user()->id);
        return View::make('published', ['donne' => $donne]);
    }
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function accueil()
    {
        if (Auth::check()) {
            $donne = DB::select('select * from annonces ORDER BY RAND()');
            return View::make('accueil', ['donne' => $donne]);
        } else {
            return view('index');
        }
    }
    /**
    * Process the return comment of this function comment.
    *
    * @return void
    */
    public function delete()
    {
        DB::delete('delete from annonces where id_user = ? and id = ?', [Auth::user()->id, $_GET['id']]);
        return Redirect::to('accueil');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function edit()
    {
        if (Auth::check()) {
            $donne = DB::select('select * from annonces where id_user = ? and id = ?', [Auth::user()->id, $_GET['id']]);
            return View::make('edit', ['donne' => $donne]);
        } else {
            return view('index');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function recherche()
    {
        $req = 'SELECT * FROM annonces WHERE 1 = 1';
        $donne = DB::select($req);

        if (isset($_POST['cle'])) {
            $req = $req . ' AND title like "%'. $_POST['cle'] . '%"';
            $donne = DB::select($req);
        }
        if (isset($_POST['prix'])) {
            $req = $req . ' AND prix like "%'. $_POST['prix'] . '%"';
            $donne = DB::select($req);
        }
        if (isset($_POST['categorie']) && $_POST['categorie'] != "all") {
            $req = $req . ' AND categorie like "%'. $_POST['categorie'] . '%"';
            $donne = DB::select($req);            
        }
        if (isset($_POST['couleur'])) {
            $req = $req . ' AND couleur like "%'. $_POST['couleur'] . '%"';
            $donne = DB::select($req);
        }

        return View::make('accueil', ['donne' => $donne]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function upload()
    {
        return view('upload');  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function uploadControlle()
    {
        $input = Input::all();
        if (isset($input['file1']) && isset($input['file2']) && isset($input['file3'])) {

            $file1 = Request::file('file1');
            $file2 = Request::file('file2');
            $file3 = Request::file('file3');
            $name1 = Input::file('file1')->getClientOriginalName();
            $name2 = Input::file('file2')->getClientOriginalName();
            $name3 = Input::file('file3')->getClientOriginalName();
            $extention1 = Input::file('file1')->getClientOriginalExtension();
            $extention2 = Input::file('file2')->getClientOriginalExtension();
            $extention3 = Input::file('file3')->getClientOriginalExtension();
            $name1 = uniqid() . rand() . "." . $extention1;
            $name2 = uniqid() . rand() . "." . $extention2;
            $name3 = uniqid() . rand() ."." . $extention3;

        } elseif (isset($input['file1']) && isset($input['file2']) && empty($input['file3'])) {

            $file1 = Request::file('file1');
            $file2 = Request::file('file2');
            $name1 = Input::file('file1')->getClientOriginalName();
            $name2 = Input::file('file2')->getClientOriginalName();
            $extention1 = Input::file('file1')->getClientOriginalExtension();
            $extention2 = Input::file('file2')->getClientOriginalExtension();
            $name1 = uniqid() . rand() . "." . $extention1;
            $name2 = uniqid() . rand() . "." . $extention2;

        } elseif (isset($input['file1']) && empty($input['file2']) && empty($input['file3'])) {

            $file1 = Request::file('file1');
            $name1 = Input::file('file1')->getClientOriginalName();
            $extention1 = Input::file('file1')->getClientOriginalExtension();
            $name1 = uniqid() . "." . $extention1;

        } elseif (empty($input['file1']) && isset($input['file2']) && isset($input['file3'])) {

            $file2 = Request::file('file2');
            $file3 = Request::file('file3');
            $name2 = Input::file('file2')->getClientOriginalName();
            $name3 = Input::file('file3')->getClientOriginalName();
            $extention2 = Input::file('file2')->getClientOriginalExtension();
            $extention3 = Input::file('file3')->getClientOriginalExtension();
            $name2 = uniqid() . rand() . "." . $extention2;
            $name3 = uniqid() . rand() ."." . $extention3;

        } elseif (empty($input['file1']) && empty($input['file2']) && isset($input['file3'])) {

            $file3 = Request::file('file3');
            $name3 = Input::file('file3')->getClientOriginalName();
            $extention3 = Input::file('file3')->getClientOriginalExtension();
            $name3 = uniqid() . rand() ."." . $extention3;

        } elseif (empty($input['file1']) && isset($input['file2']) && empty($input['file3'])) {

            $file2 = Request::file('file2');
            $name2 = Input::file('file2')->getClientOriginalName();
            $extention2 = Input::file('file2')->getClientOriginalExtension();
            $name2 = uniqid() . rand() . "." . $extention2;

        } elseif (isset($input['file1']) && empty($input['file2']) && isset($input['file3'])) {

            $file1 = Request::file('file1');
            $file3 = Request::file('file3');
            $name1 = Input::file('file1')->getClientOriginalName();
            $name3 = Input::file('file3')->getClientOriginalName();
            $extention1 = Input::file('file1')->getClientOriginalExtension();
            $extention3 = Input::file('file3')->getClientOriginalExtension();
            $name1 = uniqid() . rand() . "." . $extention1;
            $name3 = uniqid() . rand() ."." . $extention3;

        }

        $verif = array(
            'title' => 'required',
            'description' => 'required',
            'prix' => 'required|integer',
            'file1' => 'image',
            'file2' => 'image',
            'file3' => 'image',
            'couleur' => 'alpha',
            );

        $validator = Validator::make($input, $verif);

        if ($validator->passes()) {
            $destination = ('annonces/images');

            if (isset($input['file1']) && isset($input['file2']) && isset($input['file3'])) {

                Request::file('file1')->move($destination, $name1);
                Request::file('file2')->move($destination, $name2);
                Request::file('file3')->move($destination, $name3);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name1 . "|" . $name2 . "|" . $name3 ;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (isset($input['file1']) && isset($input['file2']) && empty($input['file3'])) {

                Request::file('file1')->move($destination, $name1);
                Request::file('file2')->move($destination, $name2);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name1 . "|" . $name2;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (isset($input['file1']) && empty($input['file2']) && empty($input['file3'])) {

                Request::file('file1')->move($destination, $name1);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name1;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (empty($input['file1']) && isset($input['file2']) && isset($input['file3'])) {

                Request::file('file2')->move($destination, $name2);
                Request::file('file3')->move($destination, $name3);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name2 . "|" . $name3 ;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (empty($input['file1']) && empty($input['file2']) && isset($input['file3'])) {

                Request::file('file3')->move($destination, $name3);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name3 ;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (empty($input['file1']) && isset($input['file2']) && empty($input['file3'])) {

                Request::file('file2')->move($destination, $name2);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name2;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (isset($input['file1']) && empty($input['file2']) && isset($input['file3'])) {

                Request::file('file1')->move($destination, $name1);
                Request::file('file3')->move($destination, $name3);
                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->image = $name1 . "|" . $name3 ;
                $annonce->save();
                return Redirect::to('accueil');

            } elseif (empty($input['file1']) && empty($input['file2']) && empty($input['file3'])) {

                $annonce = new Annonce();
                $annonce->id_user = Auth::user()->id;
                $annonce->user = Auth::user()->username;
                $annonce->title = $input['title'];
                $annonce->description = $input['description'];
                $annonce->prix = $input['prix'];
                $annonce->couleur = $input['couleur'];
                $annonce->categorie = $input['categorie'];
                $annonce->save();
                return Redirect::to('accueil');
            }


        } else {
            return redirect('upload')->withErrors($validator);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function editController()
    {
        $input = Input::all();

        $verif = array(
            'title' => 'required',
            'description' => 'required',
            'prix' => 'required|integer',
            );

        $validator = Validator::make($input, $verif);

        if ($validator->passes()) {
            DB::update('update annonces set title = ?, description = ?, prix = ?  where id = ? and id_user = ?', [$input['title'], $input['description'], $input['prix'], $input['id'], Auth::user()->id]);
            return redirect('published')->with('message', 'Modification enregistée !');;
        } else {
            return redirect('published');
        }
    }
}
