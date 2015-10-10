<?php 
	echo heading('Pošalji novu poruku', 2);
	echo validation_errors();
	echo form_open();
?>
<fieldset>
	<legend>Pošalji poruku</legend>
		<label for="username">Korisničko ime primaoca:</label>
		<?php echo form_input('username', $this->input->post('username')); echo br();?>
		<label for="subject">Tema:</label>
		<?php echo form_input('subject', $this->input->post('subject')); echo br(); ?>
		<label for="message">Tekst poruke:</label>
		<?php 
			echo form_textarea('message', $this->input->post('message'));
			echo br();
			echo form_submit('submit', 'Pošalji');
		?>
</fieldset>