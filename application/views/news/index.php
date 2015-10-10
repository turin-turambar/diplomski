<div class="container">
		<a href="<?php echo base_url()?>news/create" class="btn btn-default btn-large btn-block">
			Dodaj novo obaveštenje
		</a>
<?php foreach ($news as $news_item):?>
		<h2><?php echo $news_item['title'] ?></h2>
		<!--<div class="main">-->
			<?php echo $news_item['body']; ?>
		<!--</div>-->
		<p>
			<a href="<?php echo base_url()?>news/<?php echo $news_item['slug']?>" class="btn btn-default">
				Pročitaj obaveštenje
			</a>
		</p>

		<?php endforeach; ?>
	</div>