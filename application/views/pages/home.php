<ul class="nav nav-pills">
			<li>
				<?php 
					echo anchor('/news', 'Obaveštenja');
				?>
			</li>
			<li>
				<?php 
					echo anchor('/users/login', 'Ulogujte se');
				?>
			</li>
			<li>
				<?php 
					echo anchor('/users/register', 'Registrujte novi nalog');
				?>
			</li>
			<li>
				<?php 
					echo anchor('messages/inbox', 'Poruke');
				?>
			</li>
			<li>
				<?php 
					echo $username;
				?>
			</li>
		</ul>
<?php
	echo heading('Važna obaveštenja', 3);
?>