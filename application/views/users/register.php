<?php
	echo form_open();
?>
<fieldset>
	<legend>Unesite Vaše podatke:</legend>
	<label for="username">Korisničko ime:</label>
	<?php echo form_input('username', $this->input->post('username')); echo br(); ?>
	<label for="password">Lozinka:</label>
	<?php echo form_password('password'); echo br();?>
	<label for="repeatPassword">Ponovi lozinku:</label>
	<?php echo form_password('repeatPassword'); echo br();?>
	<label for="email">Email:</label>
	<?php echo form_input('email', $this->input->post('email')); echo br();?>
	<label for="first_name">Ime:</label>
	<?php echo form_input('first_name', $this->input->post('first_name')); echo br();?>
	<label for="last_name">Prezime:</label>
	<?php echo form_input('last_name', $this->input->post('last_name'));	echo br();?>
	<label for="role">Funkcija:</label>
	<?php
		$options = array(
			1		=>	'administrator',
			2		=>	'nastavnik',
			3 	=>	'saradnik',
			4		=>	'nenastavno osoblje'
			);
		echo form_dropdown('roles',$options, 2);
		echo br();
		echo form_submit('register', 'Registruj novi nalog');
		echo form_reset('reset', 'Resetuj polja');

		echo validation_errors();
	?>
</fieldset>
