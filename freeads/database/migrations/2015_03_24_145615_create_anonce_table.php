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
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
class CreateAnonceTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'annonces', function(Blueprint $table) {
        
                $table->increments('id');
                $table->integer('id_user');
                $table->string('user');
                $table->string('title', 255);
                $table->text('description');
                $table->integer('prix');
                $table->text('image');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('annonces');
    }

}
