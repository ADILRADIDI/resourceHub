<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'First Post',
                'body' => 'This is the body of the first post.',
                'image' => 'image1.jpg',
                'video' => 'video1.mp4',
                'document' => 'document1.docx',
                'pdf' => 'pdf1.pdf',
                'user_id' => 1,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Second Post',
                'body' => 'This is the body of the second post.',
                'image' => 'image2.jpg',
                'video' => 'video2.mp4',
                'document' => 'document2.docx',
                'pdf' => 'pdf2.pdf',
                'user_id' => 2,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Third Post',
                'body' => 'This is the body of the third post.',
                'image' => 'image3.jpg',
                'video' => 'video3.mp4',
                'document' => 'document3.docx',
                'pdf' => 'pdf3.pdf',
                'user_id' => 1,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
