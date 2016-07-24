<?php
  //echo $this->user_id;
  $attributes = array(
      'class' => 'form-horizontal'
  );
  echo form_open('admin/changeUserPassword/', $attributes);
  echo form_hidden('username', $user_id);
?>
<fieldset>
  <div class="control-group">
    <div class="controls">
      <h1>Promeni lozinku korisnika</h1>
      <!--<h2><?php echo $userName; ?></h2>-->
    </div>
  </div>
  <div class="control-group">
  <label for="" class="control-label">Unesi novu lozinku</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-lock"></i></span>
      <input type="password" id="prependedInput" placeholder="Unesite novu lozinku" name="password">
    </div>
    </div>
  </div>
    <div class="control-group">
      <label for="" class="control-label">Ponovi lozinku</label>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-lock"></i></span>
          <input type="password" id="prependedInput" placeholder="Ponovi lozinku" name="repeatPassword">
        </div>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary" name="search">Sačuvaj</button>
    </div><br>
      <div class="alert alert-danger">
        <span><strong>Važna informacija:</strong>Posle promene lozinke obavezno javiti korisniku!</span>
      </div>
  </div>
</div>
</fieldset>
<?php
  echo validation_errors();
  echo form_close();
?>
