<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="form theme-form" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label" for="">title</label>
                <input wire:model.lazy="page.title" class="form-control" id="title" type="text">
                <div id="page"></div>
                @error('page.title')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label" for="image">Image</label>

                <input class="form-control" id="image" type="file" accept="image/*" placeholder="Select Image">
                @error('image')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
                @if ($image && !$errors->has('image'))
                    <img class="img-thumbnail mt-2" src="{{ $image }}" width="300" alt="">
                @elseif (!empty($page->image))
                    <img class="img-thumbnail mt-2" src="{{ storage('uploads/pages/' . $page->image) }}" width="300"
                        alt="">
                @endif

            </div>
        </div>
        <div class="row mt-3 mb-4">
            <label class="form-label" for="">Content</label>
            <div class="col-sm-12" wire:ignore>
                <textarea wire:model.lazy="page.content" id="content" class="form-control"></textarea>
            </div>
            @error('page.content')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    @section('scripts')
        <script src="{{ asset('assets/backend/libs/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
        <script>
            const ADD_PAGE = () => @this
            let
                image = document.getElementById('image')
            // Upload a file:
            image.addEventListener("change", (e) => {
                let file = e.target.files[0];
                canvasResize(file, {
                    width: 1980,
                    height: 1980,
                    crop: false,
                    quality: 80,
                    //rotate: 90,
                    callback: function(data, width, height) {
                        @this.
                        set('image', data)
                        image.value = ''
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                initTinymce();
            })

            const initTinymce = () => {
                tinymce.init({
                    selector: 'textarea#content',
                    plugins: 'image code table lists',
                    toolbar: 'undo redo | link image | code | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table',
                    /* enable title field in the Image dialog*/
                    image_title: true,
                    /* enable automatic uploads of images represented by blob or data URIs*/
                    automatic_uploads: true,

                    branding: false,

                    promotion: false,

                    extended_valid_elements: 'i[class]',
                    valid_elements: "*[*]",
                    allow_unsafe_link_target: true,
                    // convert_urls: false,
                    /*
                      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                      images_upload_url: 'postAcceptor.php',
                      here we add custom filepicker only to Image dialog
                    */
                    file_picker_types: 'image',
                    /* and here's our custom image picker*/
                    file_picker_callback: function(cb, value, meta) {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');

                        /*
                          Note: In modern browsers input[type="file"] is functional without
                          even adding it to the DOM, but that might not be the case in some older
                          or quirky browsers like IE, so you might want to add it to the DOM
                          just in case, and visually hide it. And do not forget do remove it
                          once you do not need it anymore.
                        */

                        input.onchange = function() {
                            var file = this.files[0];

                            var reader = new FileReader();
                            reader.onload = function() {
                                /*
                                  Note: Now we need to register the blob in TinyMCEs image blob
                                  registry. In the next release this part hopefully won't be
                                  necessary, as we are looking to handle it internally.
                                */
                                var id = 'blobid' + (new Date()).getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);

                                /* call the callback and populate the Title field with the file name */
                                cb(blobInfo.blobUri(), {
                                    title: file.name
                                });
                            };
                            reader.readAsDataURL(file);
                        };

                        input.click();
                    },
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                    setup: (editor) => {
                        editor.on('init', (e) => {
                            console.log('The Editor has initialized.');
                        });
                        editor.on('blur', (e) => {
                            let content = tinymce.get("content").getContent();
                            @this.set('page.content', content);
                        });
                    }
                });
            }

            Livewire.on("initSummernote", (text = null) => {
                initTinymce();
                tinymce.get('content').setContent(text);
            });
        </script>
    @endsection
</div>
