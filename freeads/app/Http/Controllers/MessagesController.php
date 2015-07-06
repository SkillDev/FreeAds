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
use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
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
class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()) {
            return view('message');
        } else {
            return view('accueil');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function received()
    {
        $donne = DB::select('SELECT * FROM messages INNER JOIN users ON messages.id_sender = users.id  WHERE messages.id_receiver = ? GROUP BY users.username ', [Auth::user()->id]);
        return View::make('received', ['donne' => $donne]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function msg()
    {
        $donne = DB::select('SELECT * from users INNER JOIN messages on users.id = messages.id_sender WHERE (id_sender = ? AND id_receiver = ?) || (id_sender = ? AND id_receiver = ?)', [Auth::user()->id, $_GET['id'], $_GET['id'], Auth::user()->id]);
        return View::make('msg', ['donne' => $donne]);
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function sendMsg()
    {
        $input = Input::all();
        $verif = array(
            'content' => 'required',
            );

        $validator = Validator::make($input, $verif);

        if ($validator->passes()) {
            $message = new Message();
            $message->id_sender = Auth::user()->id;
            $message->id_receiver = $input['id'];
            $message->content = $input['content'];
            $message->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function sended()
    {
        $donne = DB::select('SELECT * FROM messages INNER JOIN users ON messages.id_receiver = users.id  WHERE messages.id_sender = ? GROUP BY users.username ', [Auth::user()->id]);
        return View::make('sended', ['donne' => $donne]);
    }
}
