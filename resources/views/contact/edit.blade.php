<form action="{{ url('/contact/'.$contact->id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
{{ method_field('PATCH') }}
@include('contact.form');
</form>
