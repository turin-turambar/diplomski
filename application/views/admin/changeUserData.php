<?php
  $attributes = array(
      'class' => 'form-horizontal'
  );
  echo form_open('admin/changeUserData', $attributes);
?>
<fieldset>
  <div class="control-group">
    <div class="controls">
      <h1>Pronađi korisnika kog želiš da urediš</h1>
    </div>
  </div>
  <div class="control-group">
  <label for="" class="control-label">Korisničko ime</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-user"></i></span>
      <input type="text" id="prependedInput" placeholder="Unesite korisničko ime" name="username">
    </div>
      <button type="submit" class="btn btn-primary" name="search">Pronađi</button>
  </div>
</div>
</fieldset>
<?php
  echo validation_errors();
  echo form_close();
?>
