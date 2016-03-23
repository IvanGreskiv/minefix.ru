function extract_color(color) {
	var mc_color_codes  = new Array('&f','&0','&1','&2','&3','&4','&5','&6','&7','&8','&9','&a','&b','&c','&d','&e');
	var rgb_color_codes = new Array('#ffffff','#000000','#0000bf','#00bf00','#00bfbf','#bf0000','#bf00bf','#bfbf00','#bfbfbf','#404040','#4040ff','#40ff40','#40ffff','#ff4040','#ff40ff','#ffff40');
	for (var i = 0; i < 16; i++) if(color==mc_color_codes[i]) color_code = i;
	rgb_color_code = rgb_color_codes[color_code];
	return rgb_color_code;
}
$(function() {
	$("#prefix_color").change(function(){
		$("#prefix_view").css('background', 'none');
		var prefix_color_code = $(this).val();	
		var prefix_color = extract_color(prefix_color_code);
		$("#prefix_view").css('color', prefix_color);
		if(prefix_color_code=="&f") $("#prefix_view").css('background-color', '#999999');
	});
	$("#prefix").keyup(function(){
		var prefix = $(this).val();	
		if(prefix!='') prefix = '['+prefix+']';
		$("#prefix_view").text(prefix);
		var prefix_caret_position = doGetCaretPosition(document.getElementById('prefix'))-1;
		if(prefix.length>gl_prefix_length+1) {
			var cuted_prefix = prefix.substr(1,gl_prefix_length);
			$("#prefix").val(cuted_prefix);
			setCaretPosition(document.getElementById('prefix'),prefix_caret_position+1);
			if(cuted_prefix!='') cuted_prefix = '['+cuted_prefix+']';
			$("#prefix_view").text(cuted_prefix);
		}
		if(prefix.length!=0) {
			var word = $("#prefix").val();
			word = word.substr(prefix_caret_position,1);
			var expword = /^[a-z0-9_]+$/i;
			var resword = word.search(expword);
			if(resword == -1){
				var word_prefix = prefix.substr(1,prefix_caret_position);
				var word_suffix = prefix.substr(prefix_caret_position+2,(gl_prefix_length-prefix_caret_position));
				word = word_prefix+word_suffix;
				$("#prefix").val(word);
				setCaretPosition(document.getElementById('prefix'),prefix_caret_position);
				if(word!='') word = '['+word+']';
				$("#prefix_view").text(word);
			}
		}
	});
	$("#nick_color").change(function(){
		$("#nick_view").css('background', 'none');
		var nickname_color_code = $(this).val();	
		var nickname_color = extract_color(nickname_color_code);
		$("#nick_view").css('color', nickname_color);
		if(nickname_color_code=="&f") $("#nick_view").css('background-color', '#999999');
	});
	$("#text_color").change(function(){
		$("#text_view").css('background', 'none');
		var text_color_code = $(this).val();	
		var text_color = extract_color(text_color_code);
		$("#text_view").css('color', text_color);
		if(text_color_code=="&f") $("#text_view").css('background-color', '#999999');
	});
});