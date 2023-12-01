# Dear

Theme URI: https://yayu.net/projects/typecho-dear

Author URI: https://yayu.net/

Description: 极极简主题，无 JS、CSS 文件载入，代码极简优化。样式复刻于 Bear 示例主题。主题支持自定义首页内容、菜单显示分类及页面，支持黑暗模式；内置文章归档模板；已作中文字体优化，内置3种字体方案可选。主题仅9个文件共45kb。

Tags: blog, one-column, full-width-template, minimalism

Contributors: Jeff Chen

Version: 1.0

Requires at least: 1.1

Requires PHP: 5.6

Tested up to: 1.2.1

License: CC BY-NC-SA 4.0 DEED

License URI: https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh-hans


## 主题介绍

本主题复刻于 Bear 示例主题。既然是复刻“bear”，那本主题就姑且叫 “dear” 吧，亲爱的。

本主题为极极简主题，无 JS、CSS 文件载入，无分页，无评论，代码极简优化。主题支持自定义首页内容、菜单显示分类及页面；内置文章归档模板，支持黑暗模式；已作中文字体优化，内置3种字体方案可选。


## 使用方法

1. 上传并激活主题后，在“管理”》“独立页面”中新增/修改页面，缩略名填“about”，该页面内容外露于首页。无对应缩略名页面则首页不显示。
2. 主题已内置3种字体方案，分别为雅黑、仿宋和宋体。如需要调整字体，在“控制台”》“外观”的“编辑当前外观”页签中选择编辑 header.php 文件，根据提示对第38行进行修改。
3. 分类/标签列表不支持分页。如需调整，使用代码编辑器修改主题内 funcitons.php 文件，按提示修改第5行“文章数设置”的数量。
4. 若希望一个页面显示所有分类的文章，可新建页面并在右侧选项的“自定义模板”一项中选择“所有文章”模板，文章按年月分组，主题已内置。


## 页面模板/所有文章

1. 创建一个新的页面，或选择一个已有页面；
2. 编辑状态，在“页面属性”的“模板”中选择“所有文章”模板。

该模板按年月展示博客所有文章。


## 常见问题

**首页显示的文章数太多/太少怎么办？**
使用代码编辑器修改主题内 funcitons.php 文件，按提示修改第5行“文章数设置”的数量，上传文件替换即可。

