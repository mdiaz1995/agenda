<label for="name">Nombre</lable>
<input type="text" name="name" id="name" value="{{ isset($contact->name)?$contact->name:'' }}">
<br>
<label for="last_name">Apellido</lable>
<input type="text" name="last_name" id="last_name" value="{{ isset($contact->last_name)?$contact->last_name:''}}">
<br>
<label for="phone">Telefono</lable>
<input type="text" name="phone" id="phone" value="{{ isset($contact->phone)?$contact->phone:''}}">
<br>
<label for="email">Correo</lable>
<input type="text" name="email" id="email" value="{{ isset($contact->email)?$contact->email:''}}">
<br>
<label for="address">Direccion</lable>
<input type="text" name="address" id="address" value="{{ isset($contact->address)?$contact->address:''}}">
<br>
<label for="photo">Foto</lable>
@if(isset($contact->photo))
<img src="{{ asset('storage').'/'.$contact->photo }}" width="150" alt="">
@endif
<input type="file" name="photo" id="photo" value="">
<br>
<input type="submit" value="Guardar Datos">

<a href="{{ url('contact/') }}">Regresar</a>