<?php
/**
 * Dear 是一款 WordPress & Typecho 纯文本极极简主题，样式复刻于 Bear Blog 示例主题。主题支持自定义背景、自定义菜单、自定义首页内容，支持黑暗模式和自适应；内置文章归档和搜索模板；已作中文字体优化，内置3种字体方案可选。主题无 JS、图片文件引用。<br/>
 * 发布页：<a href="https://yayu.net/projects/typecho-dear" target="_blank">https://yayu.net/projects/typecho-dear</a>
 *
 * @package Dear
 * @author Jeff Chen
 * @version 1.1.0
 * @link https://yayu.net/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>
<?php if ($this->is('index')){ ?>
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php while($pages->next()): ?>
<?php if ($pages->slug == 'about'): ?> 
<p><?php $pages->content(); ?></p><br />
<?php endif; ?>
<?php endwhile; ?>
<h3>近期文章</h3>
<p>
<ul class="posts">
<?php while ($this->next()) : ?>
<li>
<span><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></span>
<div><?php $this->category(','); ?>&nbsp · &nbsp<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></div>
</li>
<?php endwhile; ?>
</ul>
</p>
<?php } else { if ($this->is('single')) : ?>
<h1><?php $this->title() ?></h1>
<?php if ( $this->is('post') ) : ?><p><?php $this->category(','); ?> · <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></p><?php endif; ?>
<div><?php $this->content(); ?></div>
<?php if ( $this->is('post') ) : ?><p class="tags">#<?php $this->tags(' #', true, '无标签'); ?></p><?php endif; ?>
<?php endif; } ?>
<?php $this->need('footer.php'); ?>