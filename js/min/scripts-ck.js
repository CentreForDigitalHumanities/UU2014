function getScrollBarWidth(){var t=document.createElement("p");t.style.width="100%",t.style.height="200px";var e=document.createElement("div");e.style.position="absolute",e.style.top="0px",e.style.left="0px",e.style.visibility="hidden",e.style.width="200px",e.style.height="150px",e.style.overflow="hidden",e.appendChild(t),document.body.appendChild(e);var i=t.offsetWidth;e.style.overflow="scroll";var n=t.offsetWidth;return i==n&&(n=e.clientWidth),document.body.removeChild(e),i-n}window.getComputedStyle||(window.getComputedStyle=function(t,e){return this.el=t,this.getPropertyValue=function(e){var i=/(\-([a-z]){1})/g;return"float"==e&&(e="styleFloat"),i.test(e)&&(e=e.replace(i,function(){return arguments[2].toUpperCase()})),t.currentStyle[e]?t.currentStyle[e]:null},this}),jQuery(document).ready(function($){$("[data-toggle=offcanvas]").click(function(){$(".row-offcanvas").toggleClass("active")})}),jQuery(document).ready(function($){$("select").chosen({no_results_text:"Oops, nothing found!",width:"99.5%"}),$.fn.iCheck&&$("input").iCheck({checkboxClass:"icheckbox_square",radioClass:"iradio_square",increaseArea:"20%"});var t=$("iframe[src*='youtube'], iframe[src*='hulu'], iframe[src*='revision3'], iframe[src*='vimeo'], iframe[src*='blip'], iframe[src*='dailymotion'], iframe[src*='funnyordie'], object, embed").wrap("<figure></figure>"),e=$("figure");t.each(function(){$(this).attr("data-aspectRatio",this.height/this.width).css({"max-width":this.width+"px","max-height":this.height+"px"}).removeAttr("height").removeAttr("width")}),$(window).resize(function(){var i=e.width();t.each(function(){var t=$(this);t.width(i).height(i*t.attr("data-aspectRatio"))})}).resize();var i=$(window).width()+getScrollBarWidth(),n=$("#main-navigation > ul");if($("#main-navigation > .container > .row > .menu-button").on("click",function(t){$("body").toggleClass("menu-open")}),$(".menu-item > .menu-button").on("click",function(t){$(this).next(".sub-menu").addClass("sub-menu-open")}),$(".sub-menu .menu-back-button").on("click",function(t){$(this).parent("li").parent("ul").removeClass("sub-menu-open")}),$(window).resize(function(t){Modernizr&&Modernizr.touch?t.preventDefault():(i=$(window).width()+getScrollBarWidth(),i>=768?$("body").removeClass("menu-open"):768>i&&!n.is(":hidden")&&$("body").removeClass("menu-open"))}),481>i&&!$("body").hasClass("home")){var o=jQuery("#main").offset();"undefined"!=typeof o&&jQuery("html, body").animate({scrollTop:o.top},2e3)}i>=767&&$(".comment img[data-gravatar]").each(function(){$(this).attr("src",$(this).attr("data-gravatar"))}),$("#back-top").hide(),$(function(){$(window).scroll(function(){$(this).scrollTop()>300?$("#back-top").fadeIn():$("#back-top").fadeOut()}),$("#back-top a").click(function(){return $("body,html").animate({scrollTop:0},800),!1})})}),function(t){function e(){a.setAttribute("content",c),u=!0}function i(){a.setAttribute("content",s),u=!1}function n(n){m=n.accelerationIncludingGravity,l=Math.abs(m.x),d=Math.abs(m.y),h=Math.abs(m.z),!t.orientation&&(l>7||(h>6&&8>d||8>h&&d>6)&&l>5)?u&&i():u||e()}if(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1){var o=t.document;if(o.querySelector){var a=o.querySelector("meta[name=viewport]"),r=a&&a.getAttribute("content"),s=r+",maximum-scale=1",c=r+",maximum-scale=10",u=!0,l,d,h,m;a&&(t.addEventListener("orientationchange",e,!1),t.addEventListener("devicemotion",n,!1))}}}(this);