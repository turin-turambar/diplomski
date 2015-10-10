<?php echo heading('Primljene poruke', 2); ?>
<div class="messages">
	<?php 
		foreach ($messages as $message) {?>
			<div class="single_message">
				<?php
					echo heading($message['subject'], 3);
					echo $message['username'];
					//echo $message['sent_at'];
					echo date("d.m.Y H:i", strtotime($message['sent_at']));
					//echo substr($message['sent_at'], 0,16);//($message['sent_at'], 'd.m.Y H:i');
					echo br();
					echo substr($message['message_text'],0,150).'...';
					//echo anchor()
				?>
			</div>
		<?php }	?>
</div>