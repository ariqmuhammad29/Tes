(function($) {

	
	jQuery(".numberformat").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					 // Allow: Ctrl+A
					(e.keyCode == 65 && e.ctrlKey === true) ||
					 // Allow: Ctrl+C
					(e.keyCode == 67 && e.ctrlKey === true) ||
					 // Allow: Ctrl+X
					(e.keyCode == 88 && e.ctrlKey === true) ||
					 // Allow: home, end, left, right
					(e.keyCode >= 35 && e.keyCode <= 39)) {
						 return;
			}
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
	})

	jQuery('.userformat').keypress(function (e) {
	    var regex = new RegExp("^[a-zA-Z0-9]+$");
	    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	    if (regex.test(str)) {
	        return true;
	    }
	    e.preventDefault();
	    return false;
	});

	
})(jQuery);

jQuery('input[alphanum]').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});

function randomString(length, chars) {
    var mask = '';
    if (chars.indexOf('a') > -1) mask += 'abcdefghijklmnopqrstuvwxyz';
    if (chars.indexOf('A') > -1) mask += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (chars.indexOf('#') > -1) mask += '0123456789';
    if (chars.indexOf('!') > -1) mask += '~`!@#$%^&*()_+-={}[]:";\'<>?,./|\\';
    var result = '';
    for (var i = length; i > 0; --i) result += mask[Math.round(Math.random() * (mask.length - 1))];
    return result;
}

function ShowHide(hide,show){
		jQuery(hide).fadeOut(function(){
			
			jQuery(show).fadeIn();
		})

	}

	function animateFlipY(show,hide){
		jQuery(hide).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuery(hide).removeClass('animated flipInY');
			jQuery(hide).removeClass('animated flipOutY');
		})
		jQuery(show).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuery(show).removeClass('animated flipInY');
			jQuery(show).removeClass('animated flipOutY');
		})

		jQuery(hide).addClass('animated flipOutY').promise().done(function(){
			jQuery(hide).fadeOut(function(){
				jQuery(hide).removeClass('animated flipOutY').promise().done(function(){
					jQuery(show).addClass('animated flipInY');
					jQuery(show).fadeIn(function(){
						jQuery(show).removeClass('animated flipInY');
					});
				});
			});
		})
	}

	/*jQuery(".info-pop").mouseover(function() {
		jQuery(this).children(".info-pop-content").show();
		}).mouseout(function() {
		    jQuery(this).children(".info-pop-content").hide();
		});*/
	 $("input[rule='alphaonly']").keypress(function(event){
        var inputValue = event.charCode;

        if(inputValue == 121){
        	return;
        }
        if(!(inputValue >= 65 && inputValue <= 120 ) && (inputValue != 32 && inputValue != 0 ) || inputValue == 32 ){
            event.preventDefault();
        }
    });

	function goExplode(string,delimiter="-",result) {
	    var response 	= (string).split(delimiter);
	    return response[result];
	}


	function tgl_indo(tgl){
		var tanggal = (tgl).substr(8,2);
		var bulan = "";
	 	switch ((tgl).substr(5,2)){
					case '01': 
						bulan= "Januari";
					case '02':
						bulan= "Februari";
					case '03':
						bulan= "Maret";
					case '04':
						bulan= "April";
					case '05':
						bulan= "Mei";
					case '06':
						bulan= "Juni";
					case '07':
						bulan= "Juli";
					case '08':
						bulan= "Agustus";
					case '09':
						bulan= "September";
					case '10':
						bulan= "Oktober";
					case '11':
						bulan= "November";
					case '12':
						bulan= "Desember";
				}

			var tahun = (tgl).substr(0,4);
			return tanggal+' '+bulan+' '+tahun;		 
	}

	Number.prototype.formatMoney = function(c, d, t){
		  var n = this, 
		      c = isNaN(c = Math.abs(c)) ? 2 : c, 
		      d = d == undefined ? "." : d, 
		      t = t == undefined ? "," : t, 
		      s = n < 0 ? "-" : "", 
		      i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
		      j = (j = i.length) > 3 ? j % 3 : 0;
		     return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	   };

	function readImageAndDisplay(element, selector){
		if (element.files && element.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e){
				// console.log(jQuery(e.target.result));
				// jQuery('img#front-picture').attr('src', e.target.result);
				// jQuery(selector).css('background-image', e.target.result);
				console.log(jQuery(selector).css('background-image', 'url('+e.target.result+')'))
			}

			reader.readAsDataURL(element.files[0]);
		}
	}

	var format_money = function(num){
		var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
		if(str.indexOf(",") > 0) {
			parts = str.split(",");
			str = parts[0];
		}
		str = str.split("").reverse();
		for(var j = 0, len = str.length; j < len; j++) {
			if(str[j] != ".") {
				output.push(str[j]);
				if(i%3 == 0 && j < (len - 1)) {
					output.push(".");
				}
				i++;
			}
		}
		formatted = output.reverse().join("");
		return(formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
	};

	$("input[rule='currency']").keyup(function (e){
		$(this).val(format_money($(this).val()));
	})


	function seo(text) {       
	    var characters = [' ', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '_', '{', '}', '[', ']', '|', '/', '<', '>', ',', '.', '?', '--']; 

	    for (var i = 0; i < characters.length; i++) {
	         var char = String(characters[i]);
	         text = text.replace(new RegExp("\\" + char, "g"), '-');
	    }
	    text = text.toLowerCase();
	    return text;
	}

	function read_more(string,limit){
		string = strip_tags(string);
		if (string.length>limit){
			return string.substr(0,limit)+' . . . ';
		}
		else {
			return string;
		}
	}

function strip_tags(input, allowed) {
	  allowed = (((allowed || '') + '')
	    .toLowerCase()
	    .match(/<[a-z][a-z0-9]*>/g) || [])
	    .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
	  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
	    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
	  return input.replace(commentsAndPhpTags, '')
	    .replace(tags, function($0, $1) {
	      return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
	    });
	}


	function loading(that){
		var html = '<div class="progress" ini-loading style="display:none">'+
	                  '<div class="progress-bar progress-bar-striped active" role="progressbar"'+
	                  'aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">'+
	                    'Please Wait Until Load Data'+
	                  '</div>'+
	                '</div>';
	    var dom  = jQuery(that).parent();
	    jQuery(dom).find('div[ini-loading]').remove();
	    jQuery(dom).append(html);
	    jQuery(that).fadeOut(function(){
	    	jQuery(dom).find('div[ini-loading]').fadeIn();
	    	var out = setTimeout(function(){
	    		jQuery(dom).find('div[ini-loading]').fadeOut(function(){
	    			jQuery(that).fadeIn();
	    			jQuery(dom).find('div[ini-loading]').remove();
	    		});
	    	},1500)
	    })

	}

	Date.prototype.addHours = function(h) {    
	   this.setTime(this.getTime() + (h*60*60*1000)); 
	   return this;   
	}

	// Khusus Limitless
	function showlayout(show,hide){
		jQuery(hide).fadeOut(function(){
			jQuery(show).fadeIn();
		})
	}

	// Khusus Limitless
	function ShowNotif(title,msg,position,theme){
	    $.jGrowl(msg, {
	        position: position,
	        theme: theme,
	        header: title
	    });
	}

	//Khusus Limitless
	function showBlock(element,message,color){
		jQuery(element).block({ 
	        message: message,
	        overlayCSS: {
	            backgroundColor: color,
	            opacity: 0.8,
	            cursor: 'wait'
	        },
	        css: {
	            border: 0,
	            padding: 0,
	            backgroundColor: 'transparent'
	        }
	    });
	}

	function blockMessage(element,message,color){
		jQuery(element).block({
	        	message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; '+message+'</span>',
	            overlayCSS: {
	                backgroundColor: color,
	                opacity: 0.8,
	                cursor: 'wait'
	            },
	            css: {
	                border: 0,
	                padding: '10px 15px',
	                color: '#fff',
	                width: 'auto',
	                '-webkit-border-radius': 2,
	                '-moz-border-radius': 2,
	                backgroundColor: '#333'
	            }
	        });
	}

	function redirect(url){
		window.location.href = url;
	}


	// Upload View Image
	function  UploadPicture(input,element) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            jQuery(element).attr('src', e.target.result);
	            jQuery(element).parent().attr('href',e.target.result);
	            //jQuery("#show-read-only").val(jQuery('#img-change-konf').attr('src'));
	        }

	        reader.readAsDataURL(input.files[0]);
	        
	    }
	}
	    
	 function openReview(that){
	        if(jQuery(that).attr('data-open')=='true'){
	            jQuery(that).parent().prev().find('article').css({
	                'max-height': 'none',
	                'overflow':'visible'
	            })    
	            jQuery(that).html('<i class="fa fa-chevron-up"></i> Hide More');
	            jQuery(that).attr('data-open','false')
	        }
	        else {
	            jQuery(that).parent().prev().find('article').css({
	                'max-height': '100px',
	                'overflow':'hidden'
	            })    
	            jQuery(that).html('<i class="fa fa-chevron-down"></i> Show More');
	            jQuery(that).attr('data-open','true')   
	        }
	        

	    }

	 function parseURLParams(url) {
		    var queryStart = url.indexOf("?") + 1,
		        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
		        query = url.slice(queryStart, queryEnd - 1),
		        pairs = query.replace(/\+/g, " ").split("&"),
		        parms = {}, i, n, v, nv;

		    if (query === url || query === "") {
		        return;
		    }

		    for (i = 0; i < pairs.length; i++) {
		        nv = pairs[i].split("=");
		        n = decodeURIComponent(nv[0]);
		        v = decodeURIComponent(nv[1]);

		        if (!parms.hasOwnProperty(n)) {
		            parms[n] = [];
		        }

		        parms[n].push(nv.length === 2 ? v : null);
		    }
		    return parms;
		}