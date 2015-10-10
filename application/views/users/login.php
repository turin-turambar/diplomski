<?php
  $attributes = array(
    'class' => 'form-horizontal'
  );
  echo form_open('', $attributes);
?>
        <fieldset>
           <div class="control-group">
              <div class="controls">
                  <h1>Ulogujte se</h1>
              </div>
           </div>
                <div class="control-group">
                <label for="" class="control-label">Korisničko ime</label>
                <div class="controls">
                  <div class="input-prepend">
                   <span class="add-on"><i class="icon-user"></i></span>
                   <input type="text" id="prependedInput" placeholder="Unesite korisničko ime" name="username">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Lozinka</label>
                <div class="controls">
                   <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input type="password" id="inputPassword" placeholder="Unesite lozinku" name="password">
                   </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary btn-large" name="login">Ulogujte se</button>
                </div>
            </div>
        </fieldset>
    <?php
      echo validation_errors();
      echo form_close();
    ?>
