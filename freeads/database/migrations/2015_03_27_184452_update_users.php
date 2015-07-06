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
class UpdateUsers extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'users', function($table) {
        
                $table->boolean('activate');
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
        Schema::table(
            'users', function($table) {
        
                $table->dropColumn('activate');

            }
        );
    }

}