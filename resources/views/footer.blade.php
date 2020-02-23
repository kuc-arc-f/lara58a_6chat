<!--
<div>
    <h1>Footer</h1>
</div>
-->
<div class="footer_box mt5" id="id_foot" >
	<a href="/about"><p class="p_foot_str">About</p></a>
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
</div>
<!-- -->
<style>
/* */
.footer_box{
    background-color: #757575; 
    color:#FFF; 
    margin-top : 40px;
    padding : 140px 40px;
}
.footer_box a{
    color: inherit;
}
</style>