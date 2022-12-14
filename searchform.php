<?php get_header(); ?>


これはsearchform.phpです（入力欄の方）

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" placeholder="SEARCH"/>
<button type="submit">検索する</button>
</form>

<?php get_footer(); ?>