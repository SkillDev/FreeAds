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
namespace App;
use Illuminate\Database\Eloquent\Model;
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
class Annonce extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'annonces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'file'];

}
