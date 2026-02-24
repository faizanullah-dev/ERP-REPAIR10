<form method="POST" action="{{url('import-leads')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file">
    <button type="submit">Import</button>
</form>
