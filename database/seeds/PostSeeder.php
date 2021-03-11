<?php

use App\Blog;
use App\News;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $blog = Blog::create([
      'title' => 'blog 1',
      'content' => 'blog content 1',
      'user_id' => '1',
      'view' => '100',
    ]);

    $blog->comments()->create([
      'user_id' => '1',
      'comment' => 'comment blog 1',
    ]);

    $news = News::create([
      'title' => 'news 1',
      'content' => 'news content 1',
      'view' => '200',
    ]);

    $news->comments()->create([
      'user_id' => '1',
      'comment' => 'comment news 1',
    ]);
  }
}
