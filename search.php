<?php
/**
 * 搜索模板
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<h1 class="title">搜索<?php if ( $this->is('search') ) : ?>关键词：<?php echo $this->archiveTitle('','“','”'); ?><?php endif; ?></h1>
<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
<input type="text" id="s" name="s" class="text" value="<?php if ( $this->is('search') ) : ?><?php echo $this->archiveTitle('','',''); ?><?php endif; ?>" placeholder="<?php _e('请输入关键字'); ?>"/>
<input type="submit" class="submit" value="搜索" />
</form>
<article>
<?php if ( $this->is('search') && $this->have()) : ?>
<div class="intro">为你找到以下相关结果</div>
<ul class="posts">
<?php while ($this->next()): ?>
<li>
<div><?php $this->category(','); ?>&nbsp &middot; &nbsp<a href="<?php $this->permalink(); ?>" title="<?php $this->title() ?>"><?php $this->title() ?> <small><time datetime="<?php $this->date(); ?>"> (<?php $this->date(); ?>)</time></small></a></div>
</li>
<?php endwhile; ?>
</ul>
<?php if ( $this->is('search') && $this->is('archive')) { ?>
<div class="post-pagination">
<?php $this->pageNav('&nbsp;←&nbsp;', '&nbsp;→&nbsp;', '5', '…'); ?>
</div>
<?php }; ?>
<?php elseif ( $this->is('search') && !$this->have())  : ?>
抱歉，没有找到相关的结果，你可以在上方搜索栏中尝试其他关键词。
<?php endif; ?>
</article>
<?php $this->need('footer.php'); ?>