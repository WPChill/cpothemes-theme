jQuery(document).ready(function(){
	jQuery('.cpotheme-editor-xml').each(function(index){
		var editor = CodeMirror.fromTextArea(this, {
        viewportMargin: Infinity,
        tabMode: "indent",
        matchBrackets: true,
		theme: "default",
        lineNumbers: true,
        lineWrapping: false,
        indentUnit: 4,
        mode: "application/xml",
		});
		jQuery('.cpothemes-menu-item').click(function(event){
			setTimeout(function(){ editor.refresh(); }, 500);
		});
	});
	
	jQuery('.cpotheme-editor-css').each(function(index){
		var editor = CodeMirror.fromTextArea(this, {
        tabMode: "indent",
        matchBrackets: true,
		theme: "default",
        lineNumbers: true,
        lineWrapping: false,
        indentUnit: 4,
        mode: "text/css",
		});
		jQuery('.cpothemes-menu-item').click(function(event){
			setTimeout(function(){ editor.refresh(); }, 500);
		});
	});
	
	jQuery('.cpotheme-editor-js').each(function(index){
		var editor = CodeMirror.fromTextArea(this, {
        tabMode: "indent",
        matchBrackets: true,
		theme: "default",
        lineNumbers: true,
        lineWrapping: false,
        indentUnit: 4,
        mode: "text/javascript",
		});
		jQuery('.cpothemes-menu-item').click(function(event){
			setTimeout(function(){ editor.refresh(); }, 500);
		});
	});
});