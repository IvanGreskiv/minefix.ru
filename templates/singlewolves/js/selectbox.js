(function($){
$.fn.selectBox = function(options){
	var DefaultOptions = {
		cssClass: "",
	};
	var options = $.extend(DefaultOptions,options);
	if(options.cssClass) options.cssClass = " "+options.cssClass;
	this.each(function(){
		var select = $(this);
		if(! select.parent().hasClass("selectBoxContainer")) select.wrap('<span class="selectBoxContainer'+options.cssClass+'"></span>');
		var box = select.parent(".selectBoxContainer");
		if(! select.attr("multiple")){
			/* обычный select */
			var selectedOptionText = "";
			var selectedOptionValue = "";
			select.find("option").each(function(){
				var optVal = $(this).attr('value');
				var optText = $(this).html();
				if(! selectedOptionText) selectedOptionText = optText;
				if(! selectedOptionValue) selectedOptionValue = optVal;
				if($(this).attr("selected")) {
					selectedOptionText = optText;
					selectedOptionValue = optVal;
				}
			});
			var selectHtml = '<span class="selectBox selectBox-dropdown" style="display: inline-block; -moz-user-select: none;" title="" tabindex="0"><span class="selectBox-label">'+selectedOptionText+'</span><span class="selectBox-arrow"></span></span>';
			select.hide().unbind("click");
			box.find(".selectBox").remove();
			box.append(selectHtml);
			var newSel = box.find(".selectBox.selectBox-dropdown");
			
			select.bind("change", function(){
				var selectedValue = $(this).val();
				var optionText = $(this).find("option[value='"+selectedValue+"']").html();
				newSel.find(".selectBox-label").html(optionText);
			});
			
			newSel.bind("click", function(){
				var menuTop = $(this).offset().top + $(this).height() + parseInt($(this).css('padding-top')) + parseInt($(this).css('padding-bottom')) + parseInt($(this).css('border-top-width')) + parseInt($(this).css('border-bottom-width'));
				var menuLeft = $(this).offset().left;
				var menuWidth = $(this).width() + parseInt($(this).css('padding-left')) + parseInt($(this).css('padding-right'));
				var menuOpened = $(this).hasClass("selectBox-menuShowing") ? true : false;
				if(menuOpened) {
					$(this).removeClass("selectBox-menuShowing");
					$(".selectBox-dropdown-menu").fadeOut('fast', function(){
						$(this).remove();
					});
				} else {
					var selectMenu = '<ul class="selectBox-dropdown-menu selectBox-options" style="-moz-user-select: none; display:none;">';
					box.find("select option").each(function(){
						var value = $(this).attr('value');
						var label = $(this).html();
						var selectedValue = box.find("select").val();
						var liClass = "";
						if(selectedValue == value) liClass = "selectBox-hover selectBox-selected";
						selectMenu += '<li class="'+liClass+'"><span rel="'+value+'" href="#">'+label+'</span></li>';
					});
					selectMenu += '</ul>';
					$(".selectBox-dropdown-menu").remove();
					$(this).addClass("selectBox-menuShowing");
					$("body").append(selectMenu);
					$(".selectBox-dropdown-menu").css({position: "absolute", top: menuTop+"px", left: menuLeft+"px", width: menuWidth+"px"}).show();
					$(".selectBox-dropdown-menu li").bind("hover", function(){
						$(this).parents(".selectBox-dropdown-menu").find("li").removeClass("selectBox-hover");
						$(this).addClass("selectBox-hover");
					}).bind("click", function(){
						var clickVal = $(this).find("span").attr('rel');
						select.val(clickVal).change();
						$(".selectBox-dropdown").removeClass("selectBox-menuShowing");
						$(".selectBox-dropdown-menu").fadeOut('fast', function(){
							$(this).remove();
						});
						return false;
					});
					
					$(document).one("click", function() {
						$(".selectBox-dropdown").removeClass("selectBox-menuShowing");
						$(".selectBox-dropdown-menu").fadeOut('fast', function(){
							$(this).remove();
						});
					});
				}
				return false;
			}).css('min-width', select.width() - 20);
		} else {
			/* multiple select */
			box.find(".multiple-select-box").remove();
			box.append("<div class='multiple-select-box'></div>");
			var box = box.find(".multiple-select-box");
			select.find("option").each(function(){
				var text = $(this).html();
				var val = $(this).attr('value');
				box.append('<span value="'+val+'">'+text+'</span>');
			});
			box.css('width', select.width() + 20);
			box.find("span").click(function(){
				var selvalue = $(this).attr("value");
				if($(this).hasClass("active")){
					select.find("option[value='"+selvalue+"']").removeAttr("selected");
					$(this).removeClass("active");
				} else {
					select.find("option[value='"+selvalue+"']").attr("selected", "selected");
					$(this).addClass("active");
				}
				return false;
			});
			select.change(function(){
				box.find("span").removeClass("active");
				$(this).find("option:selected").each(function(){
					var val = $(this).attr('value');
					box.find("span[value='"+val+"']").addClass("active");
				});
			});
			select.change().hide();
		}
	});
	
}
})(jQuery);