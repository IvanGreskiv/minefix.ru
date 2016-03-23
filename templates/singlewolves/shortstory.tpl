<article class="post short">
	<div class="post-date right">
		<div class="d">{date=d}</div>
		<div class="m">{date=F}</div>
		<div class="y">{date=y}</div>
	</div>
	
	<div class="clearfix post-div">
		<div class="post-image"><a href="{full-link}"><img src="{image-1}" alt="{title}" /></a></div>
		<div class="right-part">
			<h3><a href="{full-link}">{title}</a></h3>
			<div class="maincont">{short-story limit="200"}</div>
			<a href="{full-link}" class="button">Подробнее</a>
			<ul class="pdetails">
				<li><span>Просмотры:</span> <b>{views}</b></li>
				<li><span>Комментарии:</span> <b>{comments-num}</b></li>
			</ul>
		</div>
	</div>
</article>