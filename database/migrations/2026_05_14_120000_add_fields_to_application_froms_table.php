<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToApplicationFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_froms', function (Blueprint $table) {
            $table->date('date')->nullable()->after('id');
            $table->string('recipient')->nullable()->after('date');
            $table->string('subject')->nullable()->after('recipient');
            $table->string('sender')->nullable()->after('subject');
            $table->string('nid_no')->nullable()->after('sender');
            $table->string('mobile')->nullable()->after('nid_no');
            $table->text('message')->nullable()->after('mobile');
            $table->string('attachment')->nullable()->after('message');
            $table->unsignedBigInteger('created_by')->nullable()->after('attachment');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_froms', function (Blueprint $table) {
            $table->dropColumn([
                'date',
                'recipient',
                'subject',
                'sender',
                'nid_no',
                'mobile',
                'message',
                'attachment',
                'created_by',
                'updated_by',
            ]);
        });
    }
}
