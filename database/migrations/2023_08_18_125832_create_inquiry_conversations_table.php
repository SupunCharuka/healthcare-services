<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->nullable()->constrained('inquiries')->onDelete('no action');
            $table->foreignId('sender_id')->nullable()->constrained('users')->onDelete('no action');
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('no action');

            $table->foreignId('reply_id')->nullable()->constrained('inquiry_conversations')->nullOnDelete();
            $table->string('text')->nullable();
            //$table->string('image_url')->nullable();
            $table->string('name')->nullable()->comment('Display name for the file attachment'); // For files
            $table->string('mime_type')->nullable(); // For files
            $table->string('attachment_name')->nullable()->comment('with file extension, file.pdf|image.png'); // For images and files
            $table->double('width')->nullable(); // For images
            $table->double('height')->nullable(); // For images
            $table->double('size')->nullable(); // For images and files
            $table->enum('status', ['delivered', 'error', 'seen', 'sending', 'sent'])->default('sent');
            $table->enum('type', ['audio', 'custom', 'file', 'image', 'system', 'text', 'unsupported', 'video']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry_conversations');
    }
};
