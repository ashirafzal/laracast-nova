<?php

namespace App\Nova\Cards;

use App\Models\Order;
use App\Models\Post;

class Latestposts extends \Mako\CustomTableCard\CustomTableCard
{
    public function __construct()
    {
        $header = collect(['ID', 'Title', 'Body', 'Created At', 'Updated At', 'Published At', 'Published Until', 'Is Published']);

        $this->title('Latest posts');
        $this->viewall(['label' => 'View All', 'link' => 'nova/resources/posts']);

        $posts = Post::all();
        // Data from you model
        // $posts = collect([
        //     ['date' => '2018-12-01', 'order_number' => '2018120101', 'status' => 'Ordered', 'price' => '20.55', 'name' => 'John Doe'],
        //     ['date' => '2018-12-01', 'order_number' => '2018120101', 'status' => 'Ordered', 'price' => '20.55', 'name' => 'John Doe'],
        //     ['date' => '2018-12-01', 'order_number' => '2018120101', 'status' => 'Ordered', 'price' => '20.55', 'name' => 'John Doe'],
        //     ['date' => '2018-12-01', 'order_number' => '2018120101', 'status' => 'Ordered', 'price' => '20.55', 'name' => 'John Doe'],
        //     ['date' => '2018-12-01', 'order_number' => '2018120101', 'status' => 'Ordered', 'price' => '20.55', 'name' => 'John Doe'],
        //     ['date' => '2018-12-01', 'order_number' => '2018120101', 'status' => 'Ordered', 'price' => '20.55', 'name' => 'John Doe'],
        // ]);

        $this->header($header->map(function($value) {
            return new \Mako\CustomTableCard\Table\Cell($value);
        })->toArray());

        $this->data($posts->map(function($posts) {
            return new \Mako\CustomTableCard\Table\Row(
                new \Mako\CustomTableCard\Table\Cell($posts['id ']),
                new \Mako\CustomTableCard\Table\Cell($posts['title']),
                new \Mako\CustomTableCard\Table\Cell($posts['body']),
                new \Mako\CustomTableCard\Table\Cell($posts['created_at']),
                new \Mako\CustomTableCard\Table\Cell($posts['updated_at']),
                new \Mako\CustomTableCard\Table\Cell($posts['publish_at']),
                new \Mako\CustomTableCard\Table\Cell($posts['publish_until']),
                new \Mako\CustomTableCard\Table\Cell($posts['is_published'])
            );
        })->toArray());
    }
}