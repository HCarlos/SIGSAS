@section('scripts')

    <script src="{{asset('js/dropzone.js')}}"></script>
    <script>

            Dropzone.options.myAwesomeDropzone = {
                paramName: "file",
                maxFilesize: 512,
                maxFiles: 20,
                dictFileSizeUnits: "mb",
                dictRemoveFile: 'Quitar archivo',
                dictFileTooBig: 'Archivo demasiado grande: 32MB',
                timeout: 60000,
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg,.bmp,.mp4,.3gp,.bin",
                parallelUploads: 20,
                success: function (file, response) {
                    if (file.previewElement) {
                        file.Id = response.Id;
                        file.filename = response.filename;
                        return file.previewElement.classList.add("dz-success");
                    }
                },
                removedfile: function (file) {
                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                        $.get({
                            url: '/{{ $removeItem }}/' + file.Id,
                            dataType: 'json',
                            success: function (data) {
                                alert(data.mensaje);
                                file.previewElement.parentNode.removeChild(file.previewElement);
                            }
                        });
                    }
                    return this._updateMaxFilesReachedClass();
                },

            };


        // alert("hola");

    </script>

@endsection
