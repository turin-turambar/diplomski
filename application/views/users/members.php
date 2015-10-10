<?php
	echo heading('Dobrodošli u odeljak za članove');
	echo br();

	//print_r ($this->session->all_userdata());
	echo anchor(base_url().'users/logout', 'Izlogujte se');
?>
	<article>
		<h2>Vaši podaci</h2>

	</article>
<?php
?>
