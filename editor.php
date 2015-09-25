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
            // jQuery extension from https://richonrails.com/articles/text-area-manipulation-with-jquery
            jQuery.fn.extend({
            	setCursorPosition: function(position){
            		if(this.length == 0) return this;
            		return $(this).setSelection(position, position);
            	},
            
            	setSelection: function(selectionStart, selectionEnd) {
            		if(this.length == 0) return this;
            		var input = this[0];
            
            		if (input.createTextRange) {
            			var range = input.createTextRange();
            			range.collapse(true);
            			range.moveEnd('character', selectionEnd);
            			range.moveStart('character', selectionStart);
            			range.select();
            		} else if (input.setSelectionRange) {
            			input.focus();
            			input.setSelectionRange(selectionStart, selectionEnd);
            		}
            
            		return this;
            	},
            
            	focusEnd: function(){
            		this.setCursorPosition(this.val().length);
            		return this;
            	},
            
            	getCursorPosition: function() {
            		var el = $(this).get(0);
            		var pos = 0;
            		if('selectionStart' in el) {
            			pos = el.selectionStart;
            		} else if('selection' in document) {
            			el.focus();
            			var Sel = document.selection.createRange();
            			var SelLength = document.selection.createRange().text.length;
            			Sel.moveStart('character', -el.value.length);
            			pos = Sel.text.length - SelLength;
            		}
            		return pos;
            	},
            
            	insertAtCursor: function(myValue) {
            		return this.each(function(i) {
            			if (document.selection) {
            			  //For browsers like Internet Explorer
            			  this.focus();
            			  var sel = document.selection.createRange();
            			  sel.text = myValue;
            			  this.focus();
            			}
            			else if (this.selectionStart || this.selectionStart == '0') {
            			  //For browsers like Firefox and Webkit based
            			  var startPos = this.selectionStart;
            			  var endPos = this.selectionEnd;
            			  var scrollTop = this.scrollTop;
            			  this.value = this.value.substring(0, startPos) + myValue + 
            							this.value.substring(endPos,this.value.length);
            			  this.focus();
            			  this.selectionStart = startPos + myValue.length;
            			  this.selectionEnd = startPos + myValue.length;
            			  this.scrollTop = scrollTop;
            			} else {
            			  this.value += myValue;
            			  this.focus();
            			}
            	  	})
            	}
            })
            
            function textAreaHeight() {
                var elementOffset = $('#editorRow').offset().top;
                var distanceFromBotom = ($(window).height() - elementOffset);
                $('#editorRow').height(distanceFromBotom - 5);
            }
            
            $(document).ready(function() {
                textAreaHeight();
                
                $('#textAreaEditor').bind('input perpertychange', function() {
                    console.log("anything?");
                    $('#resultPane').html($('#textAreaEditor').val());
                });
                
                $('body').on('keydown', '#textAreaEditor', function(e) {
                    if (e.which == 9) {
                        console.dir(this);
                        console.dir($('textAreaEditor'));
                        e.preventDefault();
                        $('#textAreaEditor').insertAtCursor("    ");
                        return false;
                    }
                    if(e.which == 8) {
                        var textAreaEditor = $('#textAreaEditor');
                        textAreaEditor.setSelection((textAreaEditor).getCursorPosition() - 4, textAreaEditor.getCursorPosition());
                        if (textAreaEditor.getSelectedText() == "    ") {
                            textAreaEditor.setText(textAreaEditor.replace(textAreaEditor, ""));
                        } else {
                            alert("Not '    '");
                        }
                    }
                });
            });
            
            $(window).resize(function() {
                textAreaHeight();
            });
            
           
        </script>
    </head>
    <body>
        <h1 class="text-center">pah9qd HTML Editor</h1>
        <h2 class="text-center">Supports HTML, Bootstrap, and jQuery</h2>
        <div class="container">
            <div class="row" id="editorRow">
                <div class="col-md-6" id="editorCell">
                    <form id="editorForm">
                        <textarea name="textEdit" id="textAreaEditor">
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        
    </body>
</html>
                        </textarea>
                    </form>
                </div>
                <div class="col-md-6" id="resultPane">
                    
                </div>
            </div>
        </div>
    </body>
</html>