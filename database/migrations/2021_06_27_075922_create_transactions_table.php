<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transactions',
            function (Blueprint $table) {
                $table->id();
                $table->integer('amount');
                $table->unsignedBigInteger('author_id');
                $table->char('title', 255);
                $table->enum('type', Transaction::TYPES);
                $table->timestamps();

                $table->foreign('author_id', 'fk_transactions_users_idx')->references('id')->on('users');
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
        Schema::dropIfExists('transactions');
    }
}
