var HintTimeout = 0;
var HintObj = {};

(function($){
	$.fn.enable = function(){
		this.removeAttr("disabled");
		return this;
	};
	$.fn.disable = function(){
		this.attr("disabled", "disabled");
		return this;
	};
}(jQuery));

var monitorBglineColor = "rgba(0,0,0,0.4)";
var monitorlineColors = ["#43A5DE","#7EBB1F","#FF7600","#FFDE00"];
var monitorlineWidth = 6;
var monitorCircleRaduis = 20;

function getPercentColor(percent){
	var colPercent = 100 / monitorlineColors.length;
	var color = "";
	for(var i = 0; i < monitorlineColors.length; i++){
		if(percent >= (colPercent * i)){
			color = monitorlineColors[i];
		}
	}
	if(percent >= 100) color = "#FFFFFF";
	return color;
}

messageTimeout = 0;
function displayMessage(text, messClass){
	$("#messagePanel").remove();
	$("body").prepend('<div class="messagepanel '+messClass+'" id="messagePanel" style="display: none;">'+text+'</div>');
	$("#messagePanel").css({marginTop: -40, opacity: 0}).show().animate({marginTop: 0, opacity: 1}, 250);
	clearTimeout(messageTimeout);
	messageTimeout = setTimeout(function(){
		$("#messagePanel").fadeOut('slow', function(){ $(this).remove(); });
	}, 8000);
}

function showPane(text){
	if($(".ui-widget-overlay").length == 0) $("body").append('<div class="ui-widget-overlay"></div>');
	$(".ui-pane").remove();
	$("body").append('<div class="ui-pane"><div class="ui-pane-text">'+text+'</div></div>');
	var pane = $(".ui-pane");
	var posTop = Math.round($(window).height() / 2) - Math.round(pane.realHeight() / 2);
	var posLeft = Math.round($(window).width() / 2) - Math.round(pane.realWidth() / 2);
	pane.css({top: posTop, left: posLeft});
}
function hidePane(saveBg){
	$(".ui-pane").remove();
	if(! saveBg) $(".ui-widget-overlay").remove();
}

function setupMonitor(monitoring, data){
	//console.log(monitoring);
	var monitoring = $(monitoring);
	if(data['online']){
		var percent = Math.round(data['playerCount'] / data['maxPlayers'] * 100);
		if(percent > 100) percent = 100;
		monitoring.find(".sstatus").html("Доступен: "+data['playerCount']+" из "+data['maxPlayers']);
		var showValue = data['playerCount'];
		var percentStr = showValue + "";
		if(showValue < 10) percentStr = "0" + percentStr;
		var par1 = percentStr.substr(-2, 1);
		var par2 = percentStr.substr(-1, 1);
		monitoring.find(".onlinePercent .num-display.part1").addClass('n'+par1);
		monitoring.find(".onlinePercent .num-display.part2").addClass('n'+par2);
		if(showValue >= 100) {
			var par3 = percentStr.substr(-3, 1);
			monitoring.find(".onlinePercent .num-display.part3").addClass('n'+par3).show();
		}
		
		var canvas = monitoring.find("canvas:first").get(0);
		var context = canvas.getContext("2d");
		var circleXY = monitorCircleRaduis + monitorlineWidth - 1;
		
		var positionsCount = 60;
		var currentPosition = Math.round(positionsCount * percent / 100); 
		/*for(var i = 1; i <=currentPosition; i++){
			context.beginPath();
			context.arc(circleXY, circleXY, monitorCircleRaduis, Math.PI * (1.5 + (2 * ((i-1) / positionsCount))), (Math.PI * (1.5 + (2 * (i / positionsCount)))) - 0.025, false);
			context.lineWidth = 5;
			context.strokeStyle = getPercentColor(percent);
			context.stroke();
		}*/
		
		context.beginPath();
		context.arc(circleXY, circleXY, monitorCircleRaduis, Math.PI * 1.5, Math.PI * (1.5 + (2 * (percent / 100))), false);
		context.lineWidth = monitorlineWidth;
		context.strokeStyle = getPercentColor(percent);
		context.stroke();
		
				
	} else {
		monitoring.find(".sstatus").html("Сервер недоступен");
		monitoring.find(".onlinePercent .num-display.part3").show().removeClass('n1').addClass('n0');
		monitoring.find(".onlinePercent .num-display.part1").addClass('nf');
		monitoring.find(".onlinePercent .num-display.part2").addClass('nf');
	}
}

$(function(){
	$(".slider > ul").bxSlider({
		auto: true,
		autoHover: true,
		pause: 5000,
		useCSS: false,
	});
	$(".slider").hover(function(){
		$(this).addClass('hover');
	}).mouseleave(function(){
		$(this).removeClass('hover');
	});
	
	// menu
	$("ul.mainmenu > li").hover(function(){
		if($(this).find("div").length == 0) return false;
		$(this).find("div").stop(true, true);
		if($(this).find("div").is(":visible")) return false;
		$(this).children("a, span").addClass("hover");
		$(this).find("div").css({marginTop: -42, opacity: 0}).show().animate({marginTop: 0, opacity: 1}, "fast");
	});
	$("ul.mainmenu > li").mouseleave(function(){
		if($(this).find("div").length == 0) return false;
		$(this).children("a, span").removeClass("hover");
		$(this).find("div").stop(true, true).delay(100).animate({marginTop: -42, opacity: 0}, "fast", function(){
			$(this).hide();
		});
	});
	
	setTimeout(function(){
		$("#votebous").show().removeClass('big');
	}, 500);
	$("#votebous > .close").click(function(){
		$("#votebous").addClass('big');
		setTimeout(function(){
		$("#votebous").hide();
		}, 500);
		return false;
	});

	$("a.nolink").click(function(){ return false; });
	
	$(".hint, abbr").rHint();
	
	// мониторинг
	$(".monitor-server").each(function(){
		var canvas = $(this).find('canvas');
		if(canvas.length > 0){
			var canvas = canvas.get(0);
			var context = canvas.getContext("2d");
			var circleXY = monitorCircleRaduis + monitorlineWidth - 1;
			context.beginPath();
			context.arc(circleXY, circleXY, monitorCircleRaduis, 1.5 * Math.PI, (Math.PI * 1.5) - 0.001, false);
			context.lineWidth = monitorlineWidth;
			context.strokeStyle = monitorBglineColor;
			context.stroke();
		}
	});
	
	
	$(".monitor-server").each(function(){
		$(this).find(".sstatus").html("Загрузка...");
	});
	
	$.ajax({
		cache: false,
		dataType: "json",
		url: "/server/servers.json",
		success: function(data){
	
			var slotsTotal = data['maxPlayers'];
			var playersTotal = data['onlineCount'];
			for(var key in data['servers']){
				setupMonitor("#server_"+key, data['servers'][key]);
			}
			//console.log(playersTotal);
			var totalPercent = (playersTotal / slotsTotal) * 100;
			if(totalPercent > 100) totalPercent = 100;
			var totalPercentRound = Math.round(totalPercent);
			var totalMonitor = $(".monitor-total");
			var barColor = getPercentColor(totalPercentRound);
			if(slotsTotal > 0){
				totalMonitor.find("#monitorTotal").html("Общий онлайн: <b>"+playersTotal+" / "+slotsTotal+"</b>");
				totalMonitor.find(".progressbar .pfill").css('width', totalPercent+"%").css('background-color', barColor);
				
				var recordText = totalMonitor.find("#monitorRecordDay").html();
				recordText = recordText.replace("--", data['records']['dayOnlineCount']);
				totalMonitor.find("#monitorRecordDay").html(recordText).attr('title', "Рекорд зафиксирован "+data['records']['dayOnlineDateF']).rHint();
				
				var recordText = totalMonitor.find("#monitorRecordTotal").html();
				recordText = recordText.replace("--", data['records']['maxOnlineCount']);
				totalMonitor.find("#monitorRecordTotal").html(recordText).attr('title', "Рекорд зафиксирован "+data['records']['maxOnlineDateF']).rHint();
				//console.log(data);
			} else {
				$("#monitorTotal").html("Сервера недоступны");
			}
		},
		});

	var massCommAct = $(".mass_comments_action");
	massCommAct.hide();
	$("input[name^='selected_comments']").change(function(){
		var count = $("input[name^='selected_comments']:checked").length;
		if(count > 0){
			massCommAct.slideDown('fast');
		} else {
			massCommAct.slideUp('fast');
		}
	});
	loadingDefault = $("#loading-layer").html();
	
	if(unreadPMs > 0){
		$(".pmCounter").html("+"+unreadPMs).removeClass('hidden');
	}
	$(".pm_progress_bar").tooltip();

	$("body").append('<div class="r-hint"></div>');
	setTimeout(function(){
		$(window).scroll();
	}, 500);
	
	$(".loginInputs form").submit(function(){
		var name = $(this).find("input[name='login_name']").val();
		var pwd = $(this).find("input[name='login_password']").val();
		$(".loginInputs").hide();
		$(".loginProcess").show();
		$.post("/", {login_name: name, login_password: pwd, login: "submit", ajax: "1"}, function(data){
			if(data == "ok"){
				location.href = "";
				location.reload();
			} else {
				$(".loginInputs").show();
				$(".loginProcess").hide();	
				$(".loginError").html(data).show();
			}
		});
		return false;
	});
	
	var curTid = window.location.hash.replace("#", "");
	$(".faq-spoilers .spoiler-content").hide();
	$(".faq-spoilers > div").addClass('collapsed');
	$(".faq-spoilers .spoiler-head").click(function(){
		var p = $(this).parent();
		if(p.hasClass('collapsed')){
			var tid = $(this).attr("id");
			if(tid) window.location.hash = tid;
			p.find(".spoiler-content").stop(true, true).slideDown('fast');
			p.removeClass('collapsed');
		} else {
			p.find(".spoiler-content").stop(true, true).slideUp('fast');
			p.addClass('collapsed');
		}
	});
	if(curTid){
		$(".faq-spoilers .spoiler-head#"+curTid).click();
	}
	
});

var loadingDefault = "";

/* перегрузка функции вызова прелоадера */
ShowLoading = function(text){
	if(! text) text = "Загрузка...";
	$("#loading-layer").html(text);
	var b = ($(window).width()-$("#loading-layer").width())/2;
	var c = ($(window).height()-$("#loading-layer").height())/2;
	$("#loading-layer").css({left:b+"px",top:c+"px",position:"fixed",zIndex:"9999"});
	$("#loading-layer").show();
}
HideLoading = function(){
	$("#loading-layer").hide();
}

function scrollLocker(mode){
	if(mode){
		var beforeWidth = $(window).width();
		$("body").css('overflow-y', 'hidden');
		var afterWidth = $(window).width();
		$("body").css('padding-right', (afterWidth - beforeWidth) + "px");
	} else {
		$("body").css('padding-right', 0).css('overflow-y', 'auto');
	}
}

function showDialog(title, content, options){
	if(!options) options = {};
	options.title = title;
	var defaults = {
		autoOpen: true,
		closeText: "",
		dialogClass: "showDlg",
		modal: true,
		resizable: false,
		//show: { effect: "fade", duration: "fast" },
		hide: { effect: "fade", duration: "fast" },
		close: function(){
			$(this).remove();
			//scrollLocker(false);
		},
	};
	options = $.extend(defaults, options);
	if(options.modal){
		options.open = function(){
			//scrollLocker(true);
		}
	}
	
	$("#showDialog").remove();
	$("body").append('<div id="showDialog" style="display:none;">'+content+'</div>');
	$("#showDialog").dialog(options);
}

(function($){
	$.fn.rHint = function(){
		this.hover(function(){
			var hint = $(".r-hint");
			if($(this).attr('r-title')) {
				var hintText = $(this).attr('r-title');
			} else {
				if($(this).attr('title')) {
					var hintText = $(this).attr('title');
					$(this).attr('r-title', hintText).removeAttr('title');
				}
				if($(this).attr('data-src-obj')) {
					var objSelector = $(this).attr('data-src-obj');
					var hintText = $(objSelector).html();
					if(hintText) $(this).attr('r-title', hintText).removeAttr('title');
				}
			}
			if(hintText) {
				clearTimeout(HintTimeout);
				HintObj = this;
				$(".r-hint").stop(true, true).hide().html(hintText);
				$(".r-hint").removeClass("bottom");
				$(".r-hint").find("img").load(function(){
					$(HintObj).rHintUpdatePos();
				});
				$(this).rHintUpdatePos();
				HintTimeout = setTimeout(function(){
					$(".r-hint").fadeIn('fast');
				}, 200);
			}
		}).mouseleave(function(){
			clearTimeout(HintTimeout);
			$(".r-hint:visible").stop(true, true).delay(10).fadeOut('fast');
		});		
	};
	$.fn.rHintUpdatePos = function(){
		var yOffset = 5;
		var scroll = $(window).scrollTop();
		var top = this.offset().top - $(".r-hint").realHeight() - yOffset;
		var left = Math.round(this.offset().left + ((this.realWidth() / 2) - ($(".r-hint").realWidth() / 2)));
		// хинс снизу
		if(scroll > top){
			$(".r-hint").addClass("bottom");
			top = this.offset().top + $(HintObj).realHeight() + yOffset;
		}
		$(".r-hint").css({left: left+"px", top: top+"px"});
	};
	$.fn.realHeight = function(){
		return this.height() + parseInt(this.css('paddingTop')) + parseInt(this.css('paddingBottom')) + parseInt(this.css('borderTopWidth')) + parseInt(this.css('borderBottomWidth'));
	};
	$.fn.realWidth = function(){
		return this.width() + parseInt(this.css('paddingLeft')) + parseInt(this.css('paddingRight')) + parseInt(this.css('borderLeftWidth')) + parseInt(this.css('borderRightWidth'));
	};
}(jQuery));
