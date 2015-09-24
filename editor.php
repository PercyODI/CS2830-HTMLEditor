<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        
        <style>
            #textAreaEditor {
                height: 100%;
                width: 100%;
                resize: none;
                overflow-y: scroll;
            }
            
            #editorRow, #editorCell, #editorForm {
                height: 100%;
            }
            
            
        </style>
        
        <script>
            function textAreaHeight() {
                var elementOffset = $('#editorRow').offset().top;
                var distanceFromBotom = ($(window).height() - elementOffset);
                $('#editorRow').height(distanceFromBotom - 5);
            }
            
            $(document).ready(function() {
                textAreaHeight();
            });
            
            $(window).resize(function() {
                textAreaHeight();
            });
            
            $('#textAreaEditor').change(function() {
                console.log("anything?");
                $('#resultPane').html($('#textAreaEditor').val());
            });
        </script>
    </head>
    <body>
        <h1 class="text-center">pah9qd HTML Editor</h1>
        <div class="container">
            <div class="row" id="editorRow">
                <div class="col-md-6" id="editorCell">
                    <form id="editorForm">
                        <textarea name="textEdit" id="textAreaEditor">Test test test</textarea>
                    </form>
                </div>
                <div class="col-md-6 id="resultPane">
                    Test
                </div>
            </div>
        </div>
    </body>
</html>