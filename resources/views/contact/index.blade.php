@extends('layouts.app')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <h3>Contactos</h3>
    <hr>
    <a href="{{ url('contact/create') }}">Registrar nuevo contacto</a>
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Nombre" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Apellido" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Telefono" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Correo" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Direccion" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Acciones" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    
    @foreach($contacts as $contact)
    <tr>
        <td>{{ $contact->id }}</td>
        <td>
            <img src="{{ asset('storage').'/'.$contact->photo }}" width="150" alt="">
</td>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->last_name }}</td>
        <td>{{ $contact->phone }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->address }}</td>
        <td>
            <a href="{{ url('/contact/'.$contact->id.'/edit')}}">
                Editar
</a>
            <form action="{{url('/contact/'.$contact->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        <input type="submit" onclick="return confirm('desea eliminar?')" value="Borrar"> 
        </form>
</td>
    </tr>
    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}
</style>
<script>
    /*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>