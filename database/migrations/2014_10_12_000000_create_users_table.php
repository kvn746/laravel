<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('id')->on('user_roles')->onDelete('no action');
        });

        User::insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'kvn@bugr.ru',
                    'role' => 3,
                    'password' => Hash::make('admin'),
                ],
                [
                    'name' => 'Moderator',
                    'email' => 'kvn746@bugr.ru',
                    'role' => 2,
                    'password' => Hash::make('admin'),
                ],
                [
                    'name' => 'AuthUser',
                    'email' => 'kvn@bugr.com',
                    'role' => 1,
                    'password' => Hash::make('admin'),
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
        Schema::dropIfExists('users');
    }
}
