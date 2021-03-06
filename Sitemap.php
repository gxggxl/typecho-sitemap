<?php
/**
 *网站地图-sitemap
 * @package custom
 */
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php $this->options->charset(); ?>"/>
    <title>站点地图 - <?php $this->options->title() ?></title>
    <meta name="keywords" content="站点地图,<?php $this->options->title() ?>"/>
    <meta name="copyright" content="<?php $this->options->title() ?>"/>
    <link rel="canonical" href="<?php $this->permalink() ?>"/>
    <style type="text/css">
		body {
			font-family: Microsoft Yahei, Verdana;
			font-size: 12px;
			margin: 0 auto;
			color: #000000;
			background: #ffffff;
			width: 990px;
		}

		a:link, a:visited {
			color: #000;
			text-decoration: none;
		}

		a:hover {
			color: #08d;
			text-decoration: none;
		}

		h1, h2, h3, h4, h5, h6 {
			font-weight: normal;
		}

		img {
			border: 0;
		}

		li {
			margin-top: 11px;
		}

		#nav, #content, #footer {
			padding: 8px;
			border: 1px solid #EEEEEE;
			clear: both;
			width: 95%;
			margin: 10px auto auto;
		}
    </style>
</head>

<body vlink="#333333" link="#333333">
<h2 style="text-align: center; margin-top: 18px"><?php $this->options->title() ?>'s SiteMap </h2>
<div id="nav"><a href="<?php $this->options->siteUrl(); ?>"><strong><?php $this->options->title() ?></strong></a>
    &raquo; <a href="<?php $this->permalink() ?>">站点地图</a></div>
<div id="content">
    <h3>最新文章</h3>
    <ul>
		<?php
		$stat = Typecho_Widget::widget('Widget_Stat');
		$this->widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
		$year = 0;
		$mon = 0;
		$i = 0;
		$j = 0;
		while ($archives->next()) {
			$year_tmp = date('Y', $archives->created);
			$mon_tmp = date('m', $archives->created);
			$y = $year;
			$m = $mon;
			if ($year > $year_tmp || $mon > $mon_tmp) {
				$output .= '</ul>';
			}
			$output .= '<li><a href="' . $archives->permalink . '">' . $archives->title . '</a></li>';
		}
		$output .= '</ul>';
		echo $output;
		?>
    </ul>
</div>
<div id="content">
    <ul><li class="categories">分类目录
        <?php $this->widget('Widget_Metas_Category_List')
				->parse('<li><a href="{permalink}">{name}</a> ({count})</li>'); ?>

    </li>
    </ul>
</div>

<div id="content">
    <ul>
    <li class="categories">单页面</li>
        <li><a href="<?php $this->options->siteUrl(); ?>">Home</a></li>
		<?php $this->widget('Widget_Contents_Page_List')
			->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
    </ul>
</div>
<div id="content">
    <ul>
    <li>文章统计</li>
		<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
        <li>文章总数：<?php $stat->publishedPostsNum() ?>篇</li>
        <li>分类总数：<?php $stat->categoriesNum() ?>个</li>
        <li>评论总数：<?php $stat->publishedCommentsNum() ?>条</li>
        <li>页面总数：<?php $stat->publishedPagesNum() ?>个</li>
    </ul>
</div>

<div id="footer">查看博客首页: <strong><a
                href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></strong></div>
<br/>
<div style="text-align: center; font-size: 11px"><br/> &copy; <?php echo date('Y'); ?> <strong><a href="#" target="_blank"></a></strong>
    版权所有<br/><br/><br/>
</div>
</body>

</html>
