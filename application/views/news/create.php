<?php 
	echo heading('Dodajte novo obaveštenje', 2);

	echo validation_errors();
	echo form_open('news/create');
?>

<label for="title">Naslov</label><br>
<input type="input" name="title" /> <br>

<label for="body">Tekst obaveštenja</label><br>
<textarea name="body" id="obavestenje" cols="30" rows="10"></textarea> <br>

<input type="submit" name="submit" value="Sačuvaj">

</form>