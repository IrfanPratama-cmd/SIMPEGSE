<form action="/cobaUpload" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="example-fileinput" class="form-label">Coba Upload</label>
        <input type="file" id="example-fileinput" name="coba" class="form-control">
        <button type="submit" class="btn btn-info md-3">Upload</button>
    </div>
</form>