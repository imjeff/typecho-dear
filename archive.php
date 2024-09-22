<?php
/**
 * 所有文章
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php if($this->is('archive')){ ?>
<h1 class="title"><?php $this->archiveTitle(['category' => _t('%s'),'search' => _t('搜索结果：%s'),'tag' => _t('标签：%s'),'author' => _t('作者：%s')], '', ''); ?></h1>
<span class="intro"><?php echo $this->getDescription(); ?></span>
<p>
<?php if ($this->have()): ?>
<ul class="posts">
<?php while ($this->next()): ?>
<li>
<span><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></span>
<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
</li>
<?php endwhile; ?>
</ul>
<?php else: ?>
暂无内容
<?php endif; ?>
</p>
<?php } else { ?>
<h1 class="title"><?php $this->title() ?></h1>
<p>
<?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
$year=0; $mon=0; $i=0; $j=0; $output='';
while($archives->next()):
$year_tmp = date('Y',$archives->created);
$mon_tmp = date('m',$archives->created);
$y=$year; $m=$mon;
if ($mon != $mon_tmp && $mon > 0) $output .= '</ul>';
if ($year != $year_tmp && $year > 0) $output .= '';
if ($year != $year_tmp && $mon != $mon_tmp) {
$year = $year_tmp;
$mon = $mon_tmp;
$output .= '<h3>'. $year .'年'. $mon .'月</h3><ul class="posts">';
}
$output .= '<li><span><time datetime="'.date('Y年m月d日',$archives->created).'" itemprop="datePublished">'.date('Y-m-d',$archives->created).'</time></span><div><a href="'.$archives->permalink .'">'. $archives->title .'</a></div></li>';
endwhile;
$output .= '</ul>';
echo $output;
?>
</p>
<?php } ?>
<?php $this->need('footer.php'); ?>