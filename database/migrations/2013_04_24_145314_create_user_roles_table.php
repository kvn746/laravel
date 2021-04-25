<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\UserRoles;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        UserRoles::insert(
            [
                [
                    'name' => 'registered',
                    'description' => 'Зарегистрированный пользователь',
                ],
                [
                    'name' => 'moderator',
                    'description' => 'Модератор',
                ],
                [
                    'name' => 'administrator',
                    'description' => 'Администратор',
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
