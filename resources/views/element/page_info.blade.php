<div class="page_info_wrap">
    <!--
        <h1>Page-info</h1>
    -->
    <ul>
        <li>
            このページの機能は、オープンソースで公開しております。<br />
            <?php
             echo link_to($git_url , $git_url , $attributes = array(), $secure = true );  
            ?>
            <br />          
        </li>
        <li>
            関連ブログ:<br />
            <?php
             echo link_to($blog_url , $blog_url , $attributes = array(), $secure = true );  
            ?>
            <br />          
        </li>
    </ul>
</div>
<!-- -->
<style> 
.page_info_wrap{
/* background: #B3E5FC; */    
    background: #EEE;
    padding : 10px;
    margin-top : 20px;
}
</style>

