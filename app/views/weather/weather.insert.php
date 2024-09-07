<form class="weather" name="form_weather" class="needs-validation">
    <div class="input-group mb-3">
        <input type="hidden" name="input_uid" value="<?php echo $_SESSION['SUid'] ?>">
        <input type="text" class="form-control" name="input_city" placeholder="Ingresar ciudad" aria-label="Ingresar ciudad" aria-describedby="button-addon">
        <button class="btn btn-outline-secondary" type="button" id="button-addon" onclick="searchCity()">Consultar</button>
    </div>
</form>