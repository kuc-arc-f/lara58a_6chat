@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <br />
        <h1>About</h1>
        <hr />
        <h4>
<!-- 
            Summary : <br />
-->
            本サイトは、デモ用になります。<br />
            ブログ等で紹介しているLaravel ,vue.js, node.js機能の<br />
            デモ、動作確認ができる環境を公開し、<br />
            開発者のご参考等、お役にたてればと思います <br />
        </h4>
        <p>2020/02/08</p>
        <hr />
        <ul>
            <li>動作確認等の以外の目的で、ご利用できません。
            </li>
            <li>登録データは、原則２４時間以内に削除されます。<br />
                長期保存されませんので。ご注意下さい
            </li>
            <li>都合により。長期間継続で公開できない場合がありますので。ご理解お願いします。
            </li>
        </ul>
        <hr />
        <p>ログインは、下記で可能です<br />
            guest@kuc-arc-f.com / password <br />
        </p>
        <!--
        <hr />
        <p>
            <?php echo link_to('https://kuc-arc-f.com', "https://kuc-arc-f.com", $attributes = array(),
             $secure = true );
            ?>
        </p>
        <p>
            <?php echo link_to('https://twitter.com/kuc_arc_f', "twitter", $attributes = array(),
             $secure = true );
            ?>
        </p>
        <p>
            <?php echo link_to('https://github.com/kuc-arc-f', "Github", $attributes = array(),
             $secure = true );
            ?>
        </p>
        <p>
            <?php echo link_to('https://knaka0209.hatenablog.com', "https://knaka0209.hatenablog.com", $attributes = array(),
             $secure = true );
            ?>
        </p>
        -->
    
    </div>
</div>

@endsection
