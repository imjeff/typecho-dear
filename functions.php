<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 文章数设置
function themeInit($archive) {
    if ($archive->is('index')) {
        $archive->parameter->pageSize = 8; // 首页近期文章条数
    }
    if ($archive->is('category')) {
        $archive->parameter->pageSize = 10000; // 自定义分类页条数
    }
    if ($archive->is('tag')) {
        $archive->parameter->pageSize = 10000; // 自定义标签页条数
    }
}