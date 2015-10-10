<?php
  echo validation_errors();
  $attributes = array(
      'class' => 'form-horizontal'
  );
  echo form_open('', $attributes);
  ?>

  <fieldset>
     <div class="control-group">
        <div class="controls">
            <h1>Promenite lozinku</h1>
        </div>
     </div>
          <div class="control-group">
          <label for="" class="control-label">Unesite sadasnju lozinku</label>
          <div class="controls">
            <div class="input-prepend">
             <span class="add-on"><i class="icon-lock"></i></span>
             <input type="password" id="prependedInput" placeholder="Unesite lozinku" name="oldPassword">
              </div>
          </div>
      </div>
      <div class="control-group">
          <label for="" class="control-label">Nova lozinka</label>
          <div class="controls">
             <div class="input-prepend">
                  <span class="add-on"><i class="icon-lock"></i></span>
                  <input type="password" id="inputPassword" placeholder="Unesite novu lozinku" name="password">
             </div>
          </div>
      </div>
      <div class="control-group">
          <label for="" class="control-label">Nova lozinka</label>
          <div class="controls">
             <div class="input-prepend">
                  <span class="add-on"><i class="icon-lock"></i></span>
                  <input type="password" id="inputPassword" placeholder="Unesite novu lozinku" name="repeatPassword">
             </div>
          </div>
      </div>
      <div class="control-group">
          <div class="controls">
              <button type="submit" class="btn btn-primary btn-large" name="save">Sačuvaj</button>
              <button type="reset" class="btn btn-large" name="reset">Resetuj polja</button>
          </div><br>
          <div class="alert alert-danger">
            <span><strong>Važna informacija:</strong> Nakon promene lozinke bićete redirektovani na stranicu za login</span>
          </div>
      </div>
  </fieldset>
  <?php
    echo form_close();
?>
