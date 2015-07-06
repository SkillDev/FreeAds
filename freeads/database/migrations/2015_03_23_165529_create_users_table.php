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
class CreateUsersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create(
            'users', function(Blueprint $table) {
            
                $table->increments('id');
                $table->string('username', 100)->unique();
                $table->string('lastname', 255);
                $table->string('name', 255);
                $table->string('email', 255)->unique();
                $table->date('birthdate');
                $table->string('password', 255);
                $table->date('updated_at');
                $table->date('created_at');
                $table->integer('remember_token');
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
        Schema::drop('users');
    }

}
