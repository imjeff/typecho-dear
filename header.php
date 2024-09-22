<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="<?php $this->options->charset(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $this->archiveTitle(['category' => _t('%s'),'search' => _t('搜索结果：%s'),'tag' => _t('标签：%s'),'author' => _t('作者：%s')], '', ' - '); ?><?php $this->options->title(); ?></title>
<?php $this->header(); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
</head>
<body>
<header>
<?php $site_title_elem 	= $this->is('index' ) ? 'h1' : 'h2'; ?>
<a class="title" href="<?php $this->options->siteUrl(); ?>"><<?php echo $site_title_elem; ?>><?php $this->options->title() ?></<?php echo $site_title_elem; ?>></a>
<nav>
<p>
<a<?php if ($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
<?php while($category->next()): ?>
<a<?php if($this->is('category', $category->slug)): ?> class="current"<?php endif; ?> href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
<?php endwhile; ?>
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php while ($pages->next()): ?>
<a<?php if ($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
<?php endwhile; ?>
</p>
</nav>
</header>
<main>