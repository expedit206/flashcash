<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferralColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('referral_link')->nullable(); // Pour stocker le lien d'affiliation unique
            $table->unsignedBigInteger('referred_by')->nullable(); // Pour associer l'utilisateur référé

            // Définir une clé étrangère pour la colonne 'referred_by'
            $table->foreign('referred_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la clé étrangère avant de supprimer la colonne
            $table->dropForeign(['referred_by']);
            $table->dropColumn(['referral_link', 'referred_by']);
        });
    }
}
    