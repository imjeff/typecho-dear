<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
include_once 'comments/function.php';
?>
<!--泽泽通用评论组建2025.12.8修订版https://github.com/jrotty/ZeComments-->
<?php
define('Ze_login', 0);//是否开启登录评论
define('Ze_HiddenUrl', 0);//是否开启隐藏网址输入框

define("Ze_mintheurl",__TYPECHO_THEME_DIR__ . '/' . Helper::options()->theme.'/');
define('Ze_Icons', Ze_mintheurl.'comments/icons.svg?1765189812');
?>
<style>
    @media (prefers-color-scheme: dark) {
        .ze-comments-parent{
            --text:#fff;
            --input-text: #f6f3f4; /*输入框文字颜色*/
            --input-bg: #364153; /*输入框背景颜色*/
            --input-placeholder: #99a1af; /*输入框占位符颜色*/
            
            --user-name: #f6f3f4; /*评论列表用户昵称颜色*/
            --text-color: #fff; /*评论列表文字颜色*/
            --text-bg: #364153; /*评论列表背景颜色*/
            --text-meta-color:#afafaf;/*评论区时间，回复等文字颜色*/
            
            --pagination-text: #f6f3f4; /*分页器文字颜色*/
            --page-navigator-bg: #364153; /*分页器背景颜色*/
            --page-navigator-current: #3c82f6; /*分页器当前页或悬停时背景颜色*/
        }
    }
</style>
<link rel="stylesheet" href="<?php $this->options->themeUrl('comments/comments.min.css?1765189816'); ?>"/>
<?php if(!$this->is('attachment')): ?>
<div class="ze-comments-parent">
<div class="ze-comments-title"><span class="ze-comments-title-bar"></span>评论区</div>
<?php function threadedComments($comments, $options) {
    //博主身份标识
    $sf= $comments->authorId && $comments->authorId == $comments->ownerId ? '<svg class="ze-user-certificatesolid" aria-hidden="true"><use xlink:href="'.Ze_Icons.'#icon-certificatesolid"></use></svg>' : '';

    //昵称区分带链接和不带链接
    $author = $comments->url ? '<a href="' . $comments->url . '" target="_blank" rel="external nofollow" class="ze-user-name" data-ajax="false">' . $comments->author . '</a>' : '<span class="ze-user-name">' . $comments->author . '</span>';
    //评论层数大于0为子级，否则是父级
    $commentLevelClass = $comments->levels > 0 ? ' comment-child children' : ' comment-parent';  
?>

<li id="li-<?php $comments->theId(); ?>" class="ze-ol-li comment-body<?php echo $commentLevelClass; ?>">
<div id="<?php $comments->theId(); ?>">

<div id="div-<?php $comments->theId(); ?>" class="ze-form">
<div class="ze-gravatar-parent">
    <img no-view class="ze-gravatar" src="<?php echo ZeComments_tx($comments->mail,"mm",$comments->authorId); ?>" alt="<?php echo $comments->author; ?>" k>
</div>

<div class="ze-right">
    <div class="ze-userinfo">
        <?php echo $options['beforeAuthor'].$author.$sf.$options['afterAuthor']; if ('waiting' == $comments->status) {echo '<span>您的评论需管理员审核后才能显示！</span>';} ?>
    </div>
    <div class="ze-comment-text">
        <?php 
        $cos=$comments->content;
        //$cos=parseBiaoQing($comments->content);
        $cos = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 target="_blank" rel="nofollow" data-ajax="false">', $cos);    
        echo ZeComments_at($comments->coid).$cos;
        ?>
    </div><!-- .comment-content -->
    <div class="ze-meta" data-no-instant>
        <time class="ze-meta-time"><svg class="ze-meta-svg" aria-hidden="true"><use xlink:href="<?php echo Ze_Icons;?>#icon-time"></use></svg><?php echo ZeComments_Timesince($comments->created); ?></time>

        <?php if($options['replyWord']!='hidden'):?>
            <button class="ze-meta-reply comment-reply cp-<?php $comments->theId(); ?>" onclick="return TypechoCommentZe.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>);"><svg class="ze-meta-svg" aria-hidden="true"><use xlink:href="<?php echo Ze_Icons;?>#icon-chat"></use></svg><span>回复</span></button>

            <button id="cancel-comment-reply" onclick="return TypechoCommentZe.cancelReply();" class="ze-meta-cancel-reply cancel-comment-reply cl-<?php $comments->theId(); ?>" style="display:none"><svg class="ze-meta-svg" aria-hidden="true"><use xlink:href="<?php echo Ze_Icons;?>#icon-close"></use></svg><span>取消</span></button>
        <?php endif;?>
    </div>
</div>



</div>
</div>



<?php if ($comments->children) { ?>
<?php $comments->threadedComments(); ?>
<?php } ?>
</li>
<?php } ?>




<div id="comments">
<?php if($this->allow('comment')): ?> 
 <div id="<?php $this->respondId(); ?>" class="comment-respond"  data-no-instant>

<form method="post" action="<?php $this->commentUrl() ?>" id="commentform" class="ze-form">

<div class="ze-gravatar-parent1">

<!-- gravatar start -->
<?php if($this->user->hasLogin()): ?>
<img no-view class="ze-gravatar" src="<?php echo ZeComments_tx($this->user->mail,"mm",$this->user->uid); ?>" alt="<?php $this->user->screenName(); ?>">
<?php else: ?>
<img no-view class="ze-gravatar" src="<?php echo $this->remember('mail',true) ? ZeComments_tx($this->remember('mail',true),"mm") : Ze_mintheurl.'comments/img/tx.png';; ?>" alt="<?php $this->remember('author'); ?>的头像">
<?php endif; ?>
<!-- gravatar end -->

</div>

<div class="ze-right">
<!--input textarea start-->
<div class="ze-textarea-group">
<textarea class="ze-textarea" id="comment" name="text" rows="3" placeholder="说点什么吧" required><?php $this->remember('text'); ?></textarea>
<div class="ze-submit-parent">
<button class="ze-submit" name="submit" type="submit" id="submit" value="发布评论" aria-label="提交评论"><svg aria-hidden="true"><use xlink:href="<?php echo Ze_Icons; ?>#icon-plane"></use></svg>
</button>
</div>

<?php if(!$this->user->hasLogin() && Ze_login): ?>
<div class="ze-login">请先<a href="<?php $this->options->loginUrl(); ?>">登录</a>后发布评论(°∀°)ﾉ</div>
<?php endif; ?>
</div>
<!--input textarea end-->

<?php if(!$this->user->hasLogin() && !Ze_login): ?>

<!--input group start-->
<div class="<?php echo Ze_HiddenUrl ? 'ze-input-group2' : 'ze-input-group'; ?>">
<!--input start-->
<div class="ze-input-parent">
<input class="ze-input" id="author" placeholder="昵称" name="author" type="text" value="<?php $this->remember('author'); ?>" required>
</div>
<div class="ze-input-parent">
<input class="ze-input" id="mail" placeholder="邮箱地址" name="mail" type="email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
</div>
<?php if (empty($this->options->tools) || !in_array('xurl', $this->options->tools)): ?>
<div class="ze-input-parent">
<input class="ze-input" id="url" placeholder="主页网址(可以不填)" name="url" type="url" value="<?php $this->remember('url'); ?>">
</div>
<?php endif; ?>
<!--input end-->
</div>
<!--input group end-->

<?php endif; ?>
 
</div>
</form>
</div>
<?php else: ?>
<!--评论已关闭-->
<div id="nocomment" class="ze-nocomment">
<svg aria-hidden="true"><use xlink:href="<?php echo Ze_Icons;?>#icon-comments"></use></svg>
评论已关闭
</div>
<?php endif; ?>


<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()): ?>

<?php 
$comments->listComments([
    'before' => '<ol class="comment-list ze-ol-li">',
    'after'  => '</ol>',
]); ?>

<div class="ze-comments-pagination" data-no-instant>
<?php $comments->pageNav('<svg aria-hidden="true"><use xlink:href="'.Ze_Icons.'#icon-left"></use></svg>', '<svg aria-hidden="true"><use xlink:href="'.Ze_Icons.'#icon-right"></use></svg>'); ?>
</div>

<?php else: ?>
    <?php if($this->allow('comment')): ?> 
<div id="nocomment" class="ze-nocomment">
<svg aria-hidden="true"><use xlink:href="<?php echo Ze_Icons;?>#icon-comments"></use></svg>
    暂无评论，快来抢沙发
</div>
    <?php endif; ?>
<?php endif; ?>
</div>


</div>
<?php endif; ?>

<?php if($this->allow('comment')): ?> 
<script>
    window.TypechoCommentZe = {
        dom: function(id) {
            return document.getElementById(id)
        },
        pom: function(id) {
            return document.getElementsByClassName(id)[0]
        },
        iom: function(id, dis) {
            var alist = document.getElementsByClassName(id);
            if (alist) {
                for (var idx = 0; idx < alist.length; idx++) {
                    var mya = alist[idx];
                    mya.style.display = dis
                }
            }
        },
        create: function(tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key])
            }
            return el
        },
        reply: function(cid, coid) {
            var comment = this.dom(cid),
            parent = comment.parentNode,
            response = this.dom('<?php $this->respondId(); ?>'),
            input = this.dom("comment-parent"),
            form = "form" == response.tagName ? response: response.getElementsByTagName("form")[0],
            textarea = response.getElementsByTagName("textarea")[0];
            if (null == input) {
                input = this.create("input", {
                    "type": "hidden",
                    "name": "parent",
                    "id": "comment-parent"
                });
                form.appendChild(input)
            }
            input.setAttribute("value", coid);
            if (null == this.dom("comment-form-place-holder")) {
                var holder = this.create("div", {
                    "id": "comment-form-place-holder"
                });
                response.parentNode.insertBefore(holder, response)
            }
            comment.appendChild(response);
            this.iom("comment-reply", "");
            this.pom("cp-" + cid).style.display = "none";
            this.iom("cancel-comment-reply", "none");
            this.pom("cl-" + cid).style.display = "";
            if (null != textarea && "text" == textarea.name) {
                textarea.focus()
            }
            return false
        },
        cancelReply: function() {
            var response = this.dom('<?php $this->respondId(); ?>'),
            holder = this.dom("comment-form-place-holder"),
            input = this.dom("comment-parent");
            if (null != input) {
                input.parentNode.removeChild(input)
            }
            if (null == holder) {
                return true
            }
            this.iom("comment-reply", "");
            this.iom("cancel-comment-reply", "none");
            holder.parentNode.insertBefore(response, holder);
            return false
        }
    }
    </script>
<?php endif; ?>