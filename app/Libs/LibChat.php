<?php

namespace App\Libs;
use App\Chat;
use App\ChatMember;
use App\ChatPost;
use Carbon\Carbon;

//
class LibChat{

    /**************************************
	 * chat_postsの取得
	 **************************************/
    public function get_posts($chat_id ,$TBL_LIMIT){
        $chat_posts = ChatPost::select([
            'chat_posts.id',
            'chat_posts.chat_id',
            'chat_posts.user_id',
            'chat_posts.title',
            'chat_posts.body',
            'chat_posts.created_at',
            'users.name as user_name',
            ])
            ->join('users','users.id','=','chat_posts.user_id')
            ->where('chat_id', $chat_id )
            ->orderBy('id', 'desc')
            ->skip(0)->take( $TBL_LIMIT)
            ->get();
        $chat_posts = $chat_posts->toArray();
        $post_items = [];
        foreach($chat_posts as $chat_post){
            $dt = new Carbon($chat_post["created_at"]);
            $chat_post["date_str"] = $dt->format('m-d H:i');
            $body = $chat_post["body"];
            $body = preg_replace('/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/', 
                    '<A href="\\1\\2">\\1\\2</A>', $body);
            $chat_post["body_org"] = $body;
            $chat_post["body"] = nl2br($body);
            $post_items[] = $chat_post;
        }
        return $post_items;
    }
    /**************************************
     *
     **************************************/
    public function csv_get($TBL_LIMIT){
// var_dump($_GET['chat_id']);
        if (isset($_GET['chat_id'])) {
			$chat_posts = ChatPost::select([
				'chat_posts.id',
				'chat_posts.chat_id',
				'chat_posts.user_id',
				'chat_posts.title',
				'chat_posts.body',
				'chat_posts.created_at',
				'users.name as user_name',
				])
				->join('users','users.id','=','chat_posts.user_id')
				->where('chat_id', $_GET['chat_id'] )
				->orderBy('id', 'desc')
				->skip(0)->take($TBL_LIMIT)
                ->get(); 
                $chat_posts = $chat_posts->toArray();
                $post_items = [];
                foreach($chat_posts as $chat_post){
                    $dt = new Carbon($chat_post["created_at"]);
                    $chat_post["date_str"] = $dt->format('m-d H:i');
                    $data = [
                        "id" => $chat_post["id"],
                        "user_name" => $chat_post["user_name"],
                        "body" => $chat_post["body"],
                        "date_str" => $chat_post["date_str"],
                    ];
                    $post_items[] = $data;
                }
                $csvHeader = ['id', 'from' ,'body' , 'date'];
                array_unshift($post_items, $csvHeader);   
                $stream = fopen('php://temp', 'r+b');
                foreach ($post_items as $mdat ) {
                    fputcsv($stream, $mdat );
                }
                rewind($stream);
                $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
                $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
// var_dump( $csv );
                return $csv;
        }
    }    

}
