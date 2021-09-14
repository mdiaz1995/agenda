<form action="{{ url('/contact') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
@include('contact.form');
</form>