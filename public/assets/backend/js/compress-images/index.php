<!DOCTYPE html> 
<html lang="en"> 
    <head>
        <meta charset="utf-8" /> 
        <style>      
            #area div p { display: block; width: 300px; }
            #area div p span { display: block; padding: 2px 0; width: 0; background: #193; text-align: center; }
            #area b, #area img { display: block; }
            #area img { margin: 10px 0; width: 300px; }   
        </style>
        <!-- jquery --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    </head>
    <body>
        <div id="devcontainer">
            <!-- development area -->

            <!-- SAMPLE -->
            <section> 
                <style>

                </style>
                <div id="area"> 
                    <div>
                        <input name="photo" type="file" multiple="TRUE"/> 
                        <p><span></span></p>
                    </div>
                    <script>

                        $().ready(function () {

                            $('input[name=photo]').change(function (e) {
                                // var file = e.target.files[0];
                                // console.log(e.target.files);
                                $.map(e.target.files, function (file, indexOrKey) { 
                                    $('#area p span').css('width', 0 + "%").html('');
                                    $('#area img, #area canvas').remove();
    
                                    // CANVAS RESIZING
                                    canvasResize(file, {
                                        width: 900,
                                        height: 900,
                                        crop: false,
                                        quality: 80,
                                        rotate: 0,
                                        callback: function (data) {
    
                                            // Create a new formdata
                                            var fd = new FormData();
                                            // Add file data
                                            var f = canvasResize('dataURLtoBlob', data);
                                            f.name = file.name;
                                            fd.append($('#area input').attr('name'), f);
    
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'uploader.php', true);
                                            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                                            xhr.setRequestHeader("pragma", "no-cache");
                                            //Upload progress
                                            xhr.upload.addEventListener("progress", function (e) {
                                                if (e.lengthComputable) {
                                                    var loaded = Math.ceil((e.loaded / e.total) * 100);
                                                    $('#area p span').css({'width': loaded + "%"}).html(loaded + "%");
                                                }
                                            }, false);
                                            // File uploaded
                                            xhr.addEventListener("load", function (e) {
                                                var response = JSON.parse(e.target.responseText);
                                                if (response.filename) {
                                                    // Complete
                                                    $('#area p span').html('done');
                                                    $('#area b').html(response.filename);
                                                    $('<img>').attr({'src': 'uploads/' + response.filename}).appendTo($('#area div'));
                                                }
                                            }, false);
                                            // Send data
                                            xhr.send(fd);
                                        }
                                    });
                                }); 

                            });
                        });
                    </script>

                    <script src="js/binaryajax.js"></script>
                    <script src="js/exif.js"></script>
                    <script src="js/canvasResize.js"></script>
                </div> 
            </section> 
        </div>
    </body>
</html> 
