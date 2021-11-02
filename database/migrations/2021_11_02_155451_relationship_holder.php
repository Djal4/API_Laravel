<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipHolder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->foreignId('roles_id')->constrained('roles');
            $table->foreignId('group_id')->constrained('groups');
        });

        Schema::table('interns',function(Blueprint $table){
            $table->foreignId('group_id')->constrained('groups');
        });

        Schema::table('assignements',function(Blueprint $table){
            $table->foreignId('group_id')->constrained('groups');
        });
        Schema::table('reviews',function(Blueprint $table){
            $table->foreignId('intern_id')->constrained('interns');
            $table->foreignId('mentor_id')->constrained('users');
            $table->foreignId('assignement_id')->constrained('assignements');
        });
    }
}
