<form class="form-horizontal"  method="post" id="form_nuevo_cliente" action="./?action=addpacient" role="form">


    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
        <div >
            <input type="text" name="nombre" required  class="field__input a-field__input" id="name" placeholder="Nombre">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Apellido</label>
        <div >
            <input type="text" name="apellido"   class="field__input a-field__input" id="lastname" placeholder="Apellido">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
        <div>
            <input type="text" name="email"  class="field__input a-field__input" id="email1" placeholder="Email">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
        <div >
            <input type="text" name="telefono"  class="field__input a-field__input" id="phone1" placeholder="Telefono">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">DNI</label>
        <div >
            <input type="text" maxlength="8" name="dni"  class="field__input a-field__input" id="dni" placeholder="Dni">
        </div>
    </div>


    <div >
        <div class="col-lg-offset-2 col-lg-10">
            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
        </div>
        <div class="col-lg-offset-3 col-lg-8">
            <a class="btn btn-default button">Volver</a>
        </div>
    </div>

</form>