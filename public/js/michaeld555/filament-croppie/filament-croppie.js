var He=Object.create;var re=Object.defineProperty;var We=Object.getOwnPropertyDescriptor;var De=Object.getOwnPropertyNames;var Me=Object.getPrototypeOf,Oe=Object.prototype.hasOwnProperty;var je=(S,y)=>()=>(y||S((y={exports:{}}).exports,y),y.exports);var Xe=(S,y,v,h)=>{if(y&&typeof y=="object"||typeof y=="function")for(let p of De(y))!Oe.call(S,p)&&p!==v&&re(S,p,{get:()=>y[p],enumerable:!(h=We(y,p))||h.enumerable});return S};var Be=(S,y,v)=>(v=S!=null?He(Me(S)):{},Xe(y||!S||!S.__esModule?re(v,"default",{value:S,enumerable:!0}):v,S));var se=je((D,U)=>{(function(S,y){if(typeof D=="object"&&typeof U=="object")U.exports=y();else if(typeof define=="function"&&define.amd)define([],y);else{var v=y();for(var h in v)(typeof D=="object"?D:S)[h]=v[h]}})(window,function(){return function(S){var y={};function v(h){if(y[h])return y[h].exports;var p=y[h]={i:h,l:!1,exports:{}};return S[h].call(p.exports,p,p.exports,v),p.l=!0,p.exports}return v.m=S,v.c=y,v.d=function(h,p,F){v.o(h,p)||Object.defineProperty(h,p,{enumerable:!0,get:F})},v.r=function(h){typeof Symbol<"u"&&Symbol.toStringTag&&Object.defineProperty(h,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(h,"__esModule",{value:!0})},v.t=function(h,p){if(1&p&&(h=v(h)),8&p||4&p&&typeof h=="object"&&h&&h.__esModule)return h;var F=Object.create(null);if(v.r(F),Object.defineProperty(F,"default",{enumerable:!0,value:h}),2&p&&typeof h!="string")for(var P in h)v.d(F,P,function(N){return h[N]}.bind(null,P));return F},v.n=function(h){var p=h&&h.__esModule?function(){return h.default}:function(){return h};return v.d(p,"a",p),p},v.o=function(h,p){return Object.prototype.hasOwnProperty.call(h,p)},v.p="",v(v.s=0)}([function(S,y,v){"use strict";v.r(y);var h,p="fslightbox-",F="".concat(p,"styles"),P="".concat(p,"cursor-grabbing"),N="".concat(p,"full-dimension"),k="".concat(p,"flex-centered"),_="".concat(p,"open"),Y="".concat(p,"transform-transition"),M="".concat(p,"absoluted"),J="".concat(p,"slide-btn"),G="".concat(J,"-container"),O="".concat(p,"fade-in"),j="".concat(p,"fade-out"),R=O+"-strong",$=j+"-strong",ae="".concat(p,"opacity-"),ce="".concat(ae,"1"),H="".concat(p,"source");function K(t){return(K=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol=="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(t)}function le(t){var e=t.stageIndexes,i=t.core.stageManager,o=t.props.sources.length-1;i.getPreviousSlideIndex=function(){return e.current===0?o:e.current-1},i.getNextSlideIndex=function(){return e.current===o?0:e.current+1},i.updateStageIndexes=o===0?function(){}:o===1?function(){e.current===0?(e.next=1,delete e.previous):(e.previous=0,delete e.next)}:function(){e.previous=i.getPreviousSlideIndex(),e.next=i.getNextSlideIndex()},i.i=o<=2?function(){return!0}:function(n){var c=e.current;if(c===0&&n===o||c===o&&n===0)return!0;var a=c-n;return a===-1||a===0||a===1}}(typeof document>"u"?"undefined":K(document))==="object"&&((h=document.createElement("style")).className=F,h.appendChild(document.createTextNode(".fslightbox-absoluted{position:absolute;top:0;left:0}.fslightbox-fade-in{animation:fslightbox-fade-in .3s cubic-bezier(0,0,.7,1)}.fslightbox-fade-out{animation:fslightbox-fade-out .3s ease}.fslightbox-fade-in-strong{animation:fslightbox-fade-in-strong .3s cubic-bezier(0,0,.7,1)}.fslightbox-fade-out-strong{animation:fslightbox-fade-out-strong .3s ease}@keyframes fslightbox-fade-in{from{opacity:.65}to{opacity:1}}@keyframes fslightbox-fade-out{from{opacity:.35}to{opacity:0}}@keyframes fslightbox-fade-in-strong{from{opacity:.3}to{opacity:1}}@keyframes fslightbox-fade-out-strong{from{opacity:1}to{opacity:0}}.fslightbox-cursor-grabbing{cursor:grabbing}.fslightbox-full-dimension{width:100%;height:100%}.fslightbox-open{overflow:hidden;height:100%}.fslightbox-flex-centered{display:flex;justify-content:center;align-items:center}.fslightbox-opacity-0{opacity:0!important}.fslightbox-opacity-1{opacity:1!important}.fslightbox-scrollbarfix{padding-right:17px}.fslightbox-transform-transition{transition:transform .3s}.fslightbox-container{font-family:Arial,sans-serif;position:fixed;top:0;left:0;background:linear-gradient(rgba(30,30,30,.9),#000 1810%);touch-action:pinch-zoom;z-index:1000000000;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-tap-highlight-color:transparent}.fslightbox-container *{box-sizing:border-box}.fslightbox-svg-path{transition:fill .15s ease;fill:#ddd}.fslightbox-nav{height:45px;width:100%;position:absolute;top:0;left:0}.fslightbox-slide-number-container{display:flex;justify-content:center;align-items:center;position:relative;height:100%;font-size:15px;color:#d7d7d7;z-index:0;max-width:55px;text-align:left}.fslightbox-slide-number-container .fslightbox-flex-centered{height:100%}.fslightbox-slash{display:block;margin:0 5px;width:1px;height:12px;transform:rotate(15deg);background:#fff}.fslightbox-toolbar{position:absolute;z-index:3;right:0;top:0;height:100%;display:flex;background:rgba(35,35,35,.65)}.fslightbox-toolbar-button{height:100%;width:45px;cursor:pointer}.fslightbox-toolbar-button:hover .fslightbox-svg-path{fill:#fff}.fslightbox-slide-btn-container{display:flex;align-items:center;padding:12px 12px 12px 6px;position:absolute;top:50%;cursor:pointer;z-index:3;transform:translateY(-50%)}@media (min-width:476px){.fslightbox-slide-btn-container{padding:22px 22px 22px 6px}}@media (min-width:768px){.fslightbox-slide-btn-container{padding:30px 30px 30px 6px}}.fslightbox-slide-btn-container:hover .fslightbox-svg-path{fill:#f1f1f1}.fslightbox-slide-btn{padding:9px;font-size:26px;background:rgba(35,35,35,.65)}@media (min-width:768px){.fslightbox-slide-btn{padding:10px}}@media (min-width:1600px){.fslightbox-slide-btn{padding:11px}}.fslightbox-slide-btn-container-previous{left:0}@media (max-width:475.99px){.fslightbox-slide-btn-container-previous{padding-left:3px}}.fslightbox-slide-btn-container-next{right:0;padding-left:12px;padding-right:3px}@media (min-width:476px){.fslightbox-slide-btn-container-next{padding-left:22px}}@media (min-width:768px){.fslightbox-slide-btn-container-next{padding-left:30px}}@media (min-width:476px){.fslightbox-slide-btn-container-next{padding-right:6px}}.fslightbox-down-event-detector{position:absolute;z-index:1}.fslightbox-slide-swiping-hoverer{z-index:4}.fslightbox-invalid-file-wrapper{font-size:22px;color:#eaebeb;margin:auto}.fslightbox-video{object-fit:cover}.fslightbox-youtube-iframe{border:0}.fslightboxl{display:block;margin:auto;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:67px;height:67px}.fslightboxl div{box-sizing:border-box;display:block;position:absolute;width:54px;height:54px;margin:6px;border:5px solid;border-color:#999 transparent transparent transparent;border-radius:50%;animation:fslightboxl 1.2s cubic-bezier(.5,0,.5,1) infinite}.fslightboxl div:nth-child(1){animation-delay:-.45s}.fslightboxl div:nth-child(2){animation-delay:-.3s}.fslightboxl div:nth-child(3){animation-delay:-.15s}@keyframes fslightboxl{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.fslightbox-source{position:relative;z-index:2;opacity:0}")),document.head.appendChild(h));function ue(t){var e,i=t.props,o=0,n={};this.getSourceTypeFromLocalStorageByUrl=function(a){return e[a]?e[a]:c(a)},this.handleReceivedSourceTypeForUrl=function(a,s){if(n[s]===!1&&(o--,a!=="invalid"?n[s]=a:delete n[s],o===0)){(function(r,l){for(var u in l)r[u]=l[u]})(e,n);try{localStorage.setItem("fslightbox-types",JSON.stringify(e))}catch{}}};var c=function(a){o++,n[a]=!1};if(i.disableLocalStorage)this.getSourceTypeFromLocalStorageByUrl=function(){},this.handleReceivedSourceTypeForUrl=function(){};else{try{e=JSON.parse(localStorage.getItem("fslightbox-types"))}catch{}e||(e={},this.getSourceTypeFromLocalStorageByUrl=c)}}function de(t,e,i,o){t.data;var n=t.elements.sources,c=i/o,a=0;this.adjustSize=function(){if((a=t.mw/c)<t.mh)return i<t.mw&&(a=o),s();a=o>t.mh?t.mh:o,s()};var s=function(){n[e].style.width=a*c+"px",n[e].style.height=a+"px"}}function fe(t,e){var i=this,o=t.collections.sourceSizers,n=t.elements,c=n.sourceAnimationWrappers,a=n.sources,s=t.isl,r=t.resolve;function l(u,d){o[e]=r(de,[e,u,d]),o[e].adjustSize()}this.runActions=function(u,d){s[e]=!0,a[e].classList.add(ce),c[e].classList.add(R),c[e].removeChild(c[e].firstChild),l(u,d),i.runActions=l}}function pe(t,e){var i,o=this,n=t.elements.sources,c=t.props,a=(0,t.resolve)(fe,[e]);this.handleImageLoad=function(s){var r=s.target,l=r.naturalWidth,u=r.naturalHeight;a.runActions(l,u)},this.handleVideoLoad=function(s){var r=s.target,l=r.videoWidth,u=r.videoHeight;i=!0,a.runActions(l,u)},this.handleNotMetaDatedVideoLoad=function(){i||o.handleYoutubeLoad()},this.handleYoutubeLoad=function(){var s=1920,r=1080;c.maxYoutubeDimensions&&(s=c.maxYoutubeDimensions.width,r=c.maxYoutubeDimensions.height),a.runActions(s,r)},this.handleCustomLoad=function(){var s=n[e],r=s.offsetWidth,l=s.offsetHeight;r&&l?a.runActions(r,l):setTimeout(o.handleCustomLoad)}}function W(t,e,i){var o=t.elements.sources,n=t.props.customClasses,c=n[e]?n[e]:"";o[e].className=i+" "+c}function X(t,e){var i=t.elements.sources,o=t.props.customAttributes;for(var n in o[e])i[e].setAttribute(n,o[e][n])}function he(t,e){var i=t.collections.sourceLoadHandlers,o=t.elements,n=o.sources,c=o.sourceAnimationWrappers,a=t.props.sources;n[e]=document.createElement("img"),W(t,e,H),n[e].src=a[e],n[e].onload=i[e].handleImageLoad,X(t,e),c[e].appendChild(n[e])}function me(t,e){var i=t.collections.sourceLoadHandlers,o=t.elements,n=o.sources,c=o.sourceAnimationWrappers,a=t.props,s=a.sources,r=a.videosPosters;n[e]=document.createElement("video"),W(t,e,H),n[e].src=s[e],n[e].onloadedmetadata=function(u){i[e].handleVideoLoad(u)},n[e].controls=!0,X(t,e),r[e]&&(n[e].poster=r[e]);var l=document.createElement("source");l.src=s[e],n[e].appendChild(l),setTimeout(i[e].handleNotMetaDatedVideoLoad,3e3),c[e].appendChild(n[e])}function ge(t,e){var i=t.collections.sourceLoadHandlers,o=t.elements,n=o.sources,c=o.sourceAnimationWrappers,a=t.props.sources;n[e]=document.createElement("iframe"),W(t,e,"".concat(H," ").concat(p,"youtube-iframe"));var s=a[e],r=s.split("?")[1];n[e].src="https://www.youtube.com/embed/".concat(s.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/)[2],"?").concat(r||""),n[e].allowFullscreen=!0,X(t,e),c[e].appendChild(n[e]),i[e].handleYoutubeLoad()}function ve(t,e){var i=t.collections.sourceLoadHandlers,o=t.elements,n=o.sources,c=o.sourceAnimationWrappers,a=t.props.sources;n[e]=a[e],W(t,e,"".concat(n[e].className," ").concat(H)),c[e].appendChild(n[e]),i[e].handleCustomLoad()}function be(t,e){var i=t.elements,o=i.sources,n=i.sourceAnimationWrappers;t.props.sources,o[e]=document.createElement("div"),o[e].className="".concat(p,"invalid-file-wrapper ").concat(k),o[e].innerHTML="Invalid source",n[e].classList.add(R),n[e].removeChild(n[e].firstChild),n[e].appendChild(o[e])}function xe(t){var e=t.collections,i=e.sourceLoadHandlers,o=e.sourcesRenderFunctions,n=t.core.sourceDisplayFacade,c=t.resolve;this.runActionsForSourceTypeAndIndex=function(a,s){var r;switch(a!=="invalid"&&(i[s]=c(pe,[s])),a){case"image":r=he;break;case"video":r=me;break;case"youtube":r=ge;break;case"custom":r=ve;break;default:r=be}o[s]=function(){return r(t,s)},n.displaySourcesWhichShouldBeDisplayed()}}function ye(t,e,i){var o=t.props,n=o.types,c=o.type,a=o.sources;this.getTypeSetByClientForIndex=function(s){var r;return n&&n[s]?r=n[s]:c&&(r=c),r},this.retrieveTypeWithXhrForIndex=function(s){(function(r,l){var u=document.createElement("a");u.href=r;var d=u.hostname;if(d==="www.youtube.com"||d==="youtu.be")return l("youtube");var f=new XMLHttpRequest;f.onreadystatechange=function(){if(f.readyState!==4){if(f.readyState===2){var g,b=f.getResponseHeader("content-type");switch(b.slice(0,b.indexOf("/"))){case"image":g="image";break;case"video":g="video";break;default:g="invalid"}f.onreadystatechange=null,f.abort(),l(g)}}else l("invalid")},f.open("GET",r),f.send()})(a[s],function(r){e.handleReceivedSourceTypeForUrl(r,a[s]),i.runActionsForSourceTypeAndIndex(r,s)})}}function we(t,e){var i=t.core.stageManager,o=t.elements,n=o.smw,c=o.sourceWrappersContainer,a=t.props,s=0,r=document.createElement("div");function l(d){r.style.transform="translateX(".concat(d+s,"px)"),s=0}function u(){return(1+a.slideDistance)*innerWidth}r.className="".concat(M," ").concat(N," ").concat(k),r.s=function(){r.style.display="flex"},r.h=function(){r.style.display="none"},r.a=function(){r.classList.add(Y)},r.d=function(){r.classList.remove(Y)},r.n=function(){r.style.removeProperty("transform")},r.v=function(d){return s=d,r},r.ne=function(){l(-u())},r.z=function(){l(0)},r.p=function(){l(u())},i.i(e)||r.h(),n[e]=r,c.appendChild(r),function(d,f){var g=d.elements,b=g.smw,L=g.sourceAnimationWrappers,m=document.createElement("div"),w=document.createElement("div");w.className="fslightboxl";for(var x=0;x<3;x++){var E=document.createElement("div");w.appendChild(E)}m.appendChild(w),b[f].appendChild(m),L[f]=m}(t,e)}function B(t,e,i,o){var n=document.createElementNS("http://www.w3.org/2000/svg","svg");n.setAttributeNS(null,"width",e),n.setAttributeNS(null,"height",e),n.setAttributeNS(null,"viewBox",i);var c=document.createElementNS("http://www.w3.org/2000/svg","path");return c.setAttributeNS(null,"class","".concat(p,"svg-path")),c.setAttributeNS(null,"d",o),n.appendChild(c),t.appendChild(n),n}function Q(t,e){var i=document.createElement("div");return i.className="".concat(p,"toolbar-button ").concat(k),i.title=e,t.appendChild(i),i}function Se(t,e){var i=document.createElement("div");i.className="".concat(p,"toolbar"),e.appendChild(i),function(o,n){var c=o.componentsServices,a=o.data,s=o.fs,r="M4.5 11H3v4h4v-1.5H4.5V11zM3 7h1.5V4.5H7V3H3v4zm10.5 6.5H11V15h4v-4h-1.5v2.5zM11 3v1.5h2.5V7H15V3h-4z",l=Q(n);l.title="Enter fullscreen";var u=B(l,"20px","0 0 18 18",r);c.ofs=function(){a.ifs=!0,l.title="Exit fullscreen",u.setAttributeNS(null,"width","24px"),u.setAttributeNS(null,"height","24px"),u.setAttributeNS(null,"viewBox","0 0 950 1024"),u.firstChild.setAttributeNS(null,"d","M682 342h128v84h-212v-212h84v128zM598 810v-212h212v84h-128v128h-84zM342 342v-128h84v212h-212v-84h128zM214 682v-84h212v212h-84v-128h-128z")},c.xfs=function(){a.ifs=!1,l.title="Enter fullscreen",u.setAttributeNS(null,"width","20px"),u.setAttributeNS(null,"height","20px"),u.setAttributeNS(null,"viewBox","0 0 18 18"),u.firstChild.setAttributeNS(null,"d",r)},l.onclick=s.t}(t,i),function(o,n){var c=Q(n,"Close");c.onclick=o.core.lightboxCloser.closeLightbox,B(c,"20px","0 0 24 24","M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z")}(t,i)}function Le(t){var e=t.props.sources,i=t.elements.container,o=document.createElement("div");o.className="".concat(p,"nav"),i.appendChild(o),Se(t,o),e.length>1&&function(n,c){var a=n.componentsServices,s=n.props.sources,r=(n.stageIndexes,document.createElement("div"));r.className="".concat(p,"slide-number-container");var l=document.createElement("div");l.className=k;var u=document.createElement("span");a.setSlideNumber=function(g){return u.innerHTML=g};var d=document.createElement("span");d.className="".concat(p,"slash");var f=document.createElement("div");f.innerHTML=s.length,r.appendChild(l),l.appendChild(u),l.appendChild(d),l.appendChild(f),c.appendChild(r),setTimeout(function(){l.offsetWidth>55&&(r.style.justifyContent="flex-start")})}(t,o)}function Z(t,e,i,o){var n=t.elements.container,c=i.charAt(0).toUpperCase()+i.slice(1),a=document.createElement("div");a.className="".concat(G," ").concat(G,"-").concat(i),a.title="".concat(c," slide"),a.onclick=e,function(s,r){var l=document.createElement("div");l.className="".concat(J," ").concat(k),B(l,"20px","0 0 20 20",r),s.appendChild(l)}(a,o),n.appendChild(a)}function Ae(t){var e=t.core,i=e.lightboxCloser,o=e.slideChangeFacade,n=t.fs;this.listener=function(c){switch(c.key){case"Escape":i.closeLightbox();break;case"ArrowLeft":o.changeToPrevious();break;case"ArrowRight":o.changeToNext();break;case"F11":c.preventDefault(),n.t()}}}function Ce(t){var e=t.elements,i=t.sourcePointerProps,o=t.stageIndexes;function n(c,a){e.smw[c].v(i.swipedX)[a]()}this.runActionsForEvent=function(c){var a,s,r;e.container.contains(e.slideSwipingHoverer)||e.container.appendChild(e.slideSwipingHoverer),a=e.container,s=P,(r=a.classList).contains(s)||r.add(s),i.swipedX=c.screenX-i.downScreenX;var l=o.previous,u=o.next;n(o.current,"z"),l!==void 0&&i.swipedX>0?n(l,"ne"):u!==void 0&&i.swipedX<0&&n(u,"p")}}function Ee(t){var e=t.props.sources,i=t.resolve,o=t.sourcePointerProps,n=i(Ce);e.length===1?this.listener=function(){o.swipedX=1}:this.listener=function(c){o.isPointering&&n.runActionsForEvent(c)}}function Fe(t){var e=t.core.slideIndexChanger,i=t.elements.smw,o=t.stageIndexes,n=t.sws;function c(s){var r=i[o.current];r.a(),r[s]()}function a(s,r){s!==void 0&&(i[s].s(),i[s][r]())}this.runPositiveSwipedXActions=function(){var s=o.previous;if(s===void 0)c("z");else{c("p");var r=o.next;e.changeTo(s);var l=o.previous;n.d(l),n.b(r),c("z"),a(l,"ne")}},this.runNegativeSwipedXActions=function(){var s=o.next;if(s===void 0)c("z");else{c("ne");var r=o.previous;e.changeTo(s);var l=o.next;n.d(l),n.b(r),c("z"),a(l,"p")}}}function ee(t,e){t.contains(e)&&t.removeChild(e)}function Ie(t){var e=t.core.lightboxCloser,i=t.elements,o=t.resolve,n=t.sourcePointerProps,c=o(Fe);this.runNoSwipeActions=function(){ee(i.container,i.slideSwipingHoverer),n.isSourceDownEventTarget||e.closeLightbox(),n.isPointering=!1},this.runActions=function(){n.swipedX>0?c.runPositiveSwipedXActions():c.runNegativeSwipedXActions(),ee(i.container,i.slideSwipingHoverer),i.container.classList.remove(P),n.isPointering=!1}}function Ne(t){var e=t.resolve,i=t.sourcePointerProps,o=e(Ie);this.listener=function(){i.isPointering&&(i.swipedX?o.runActions():o.runNoSwipeActions())}}function ze(t){var e=this,i=t.core,o=i.eventsDispatcher,n=i.globalEventsController,c=i.scrollbarRecompensor,a=t.data,s=t.elements,r=t.fs,l=t.props,u=t.sourcePointerProps;this.isLightboxFadingOut=!1,this.runActions=function(){e.isLightboxFadingOut=!0,s.container.classList.add($),n.removeListeners(),l.exitFullscreenOnClose&&a.ifs&&r.x(),setTimeout(function(){e.isLightboxFadingOut=!1,u.isPointering=!1,s.container.classList.remove($),document.documentElement.classList.remove(_),c.removeRecompense(),document.body.removeChild(s.container),o.dispatch("onClose")},270)}}function q(t,e){var i=t.classList;i.contains(e)&&i.remove(e)}function Te(t){var e,i,o;i=(e=t).core.eventsDispatcher,o=e.props,i.dispatch=function(n){o[n]&&o[n]()},function(n){var c=n.componentsServices,a=n.data,s=n.fs,r=["fullscreenchange","webkitfullscreenchange","mozfullscreenchange","MSFullscreenChange"];function l(d){for(var f=0;f<r.length;f++)document[d](r[f],u)}function u(){document.fullscreenElement||document.webkitIsFullScreen||document.mozFullScreen||document.msFullscreenElement?c.ofs():c.xfs()}s.o=function(){c.ofs();var d=document.documentElement;d.requestFullscreen?d.requestFullscreen():d.mozRequestFullScreen?d.mozRequestFullScreen():d.webkitRequestFullscreen?d.webkitRequestFullscreen():d.msRequestFullscreen&&d.msRequestFullscreen()},s.x=function(){c.xfs(),document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen?document.webkitExitFullscreen():document.msExitFullscreen&&document.msExitFullscreen()},s.t=function(){a.ifs?s.x():s.o()},s.l=function(){l("addEventListener")},s.q=function(){l("removeEventListener")}}(t),function(n){var c=n.core,a=c.globalEventsController,s=c.windowResizeActioner,r=n.fs,l=n.resolve,u=l(Ae),d=l(Ee),f=l(Ne);a.attachListeners=function(){document.addEventListener("pointermove",d.listener),document.addEventListener("pointerup",f.listener),addEventListener("resize",s.runActions),document.addEventListener("keydown",u.listener),r.l()},a.removeListeners=function(){document.removeEventListener("pointermove",d.listener),document.removeEventListener("pointerup",f.listener),removeEventListener("resize",s.runActions),document.removeEventListener("keydown",u.listener),r.q()}}(t),function(n){var c=n.core.lightboxCloser,a=(0,n.resolve)(ze);c.closeLightbox=function(){a.isLightboxFadingOut||a.runActions()}}(t),function(n){var c=n.data,a=n.core.scrollbarRecompensor;function s(){document.body.offsetHeight>innerHeight&&(document.body.style.marginRight=c.scrollbarWidth+"px")}a.addRecompense=function(){document.readyState==="complete"?s():addEventListener("load",function(){s(),a.addRecompense=s})},a.removeRecompense=function(){document.body.style.removeProperty("margin-right")}}(t),function(n){var c=n.core,a=c.slideChangeFacade,s=c.slideIndexChanger,r=c.stageManager;n.props.sources.length>1?(a.changeToPrevious=function(){s.jumpTo(r.getPreviousSlideIndex())},a.changeToNext=function(){s.jumpTo(r.getNextSlideIndex())}):(a.changeToPrevious=function(){},a.changeToNext=function(){})}(t),function(n){var c=n.componentsServices,a=n.core,s=a.slideIndexChanger,r=a.sourceDisplayFacade,l=a.stageManager,u=n.elements,d=u.smw,f=u.sourceAnimationWrappers,g=n.isl,b=n.stageIndexes,L=n.sws;s.changeTo=function(m){b.current=m,l.updateStageIndexes(),c.setSlideNumber(m+1),r.displaySourcesWhichShouldBeDisplayed()},s.jumpTo=function(m){var w=b.previous,x=b.current,E=b.next,A=g[x],I=g[m];s.changeTo(m);for(var C=0;C<d.length;C++)d[C].d();L.d(x),L.c(),requestAnimationFrame(function(){requestAnimationFrame(function(){var z=b.previous,T=b.next;function ie(){l.i(x)?x===b.previous?d[x].ne():x===b.next&&d[x].p():(d[x].h(),d[x].n())}A&&f[x].classList.add(j),I&&f[b.current].classList.add(O),L.a(),z!==void 0&&z!==x&&d[z].ne(),d[b.current].n(),T!==void 0&&T!==x&&d[T].p(),L.b(w),L.b(E),g[x]?setTimeout(ie,260):ie()})})}}(t),function(n){var c=n.core.sourcesPointerDown,a=n.elements,s=a.smw,r=a.sources,l=n.sourcePointerProps,u=n.stageIndexes;c.listener=function(d){d.target.tagName!=="VIDEO"&&d.preventDefault(),l.isPointering=!0,l.downScreenX=d.screenX,l.swipedX=0;var f=r[u.current];f&&f.contains(d.target)?l.isSourceDownEventTarget=!0:l.isSourceDownEventTarget=!1;for(var g=0;g<s.length;g++)s[g].d()}}(t),function(n){var c=n.collections.sourcesRenderFunctions,a=n.core.sourceDisplayFacade,s=n.props,r=n.stageIndexes;function l(u){c[u]&&(c[u](),delete c[u])}a.displaySourcesWhichShouldBeDisplayed=function(){if(s.loadOnlyCurrentSource)l(r.current);else for(var u in r)l(r[u])}}(t),function(n){var c=n.core.stageManager,a=n.elements,s=a.smw,r=a.sourceAnimationWrappers,l=n.isl,u=n.stageIndexes,d=n.sws;d.a=function(){for(var f in u)s[u[f]].s()},d.b=function(f){f===void 0||c.i(f)||(s[f].h(),s[f].n())},d.c=function(){for(var f in u)d.d(u[f])},d.d=function(f){if(l[f]){var g=r[f];q(g,R),q(g,O),q(g,j)}}}(t),function(n){var c=n.collections.sourceSizers,a=n.core.windowResizeActioner,s=(n.data,n.elements.smw),r=n.props.sourceMargin,l=n.stageIndexes,u=1-2*r;a.runActions=function(){innerWidth>992?n.mw=u*innerWidth:n.mw=innerWidth,n.mh=u*innerHeight;for(var d=0;d<s.length;d++)s[d].d(),c[d]&&c[d].adjustSize();var f=l.previous,g=l.next;f!==void 0&&s[f].ne(),g!==void 0&&s[g].p()}}(t)}function Pe(t){var e=t.componentsServices,i=t.core,o=i.eventsDispatcher,n=i.globalEventsController,c=i.scrollbarRecompensor,a=i.sourceDisplayFacade,s=i.stageManager,r=i.windowResizeActioner,l=t.data,u=t.elements,d=(t.props,t.stageIndexes),f=t.sws;function g(){var b,L;l.i=!0,l.scrollbarWidth=function(){var m=document.createElement("div"),w=m.style,x=document.createElement("div");w.visibility="hidden",w.width="100px",w.msOverflowStyle="scrollbar",w.overflow="scroll",x.style.width="100%",document.body.appendChild(m);var E=m.offsetWidth;m.appendChild(x);var A=x.offsetWidth;return document.body.removeChild(m),E-A}(),Te(t),u.container=document.createElement("div"),u.container.className="".concat(p,"container ").concat(N," ").concat(R),function(m){var w=m.elements;w.slideSwipingHoverer=document.createElement("div"),w.slideSwipingHoverer.className="".concat(p,"slide-swiping-hoverer ").concat(N," ").concat(M)}(t),Le(t),function(m){var w=m.core.sourcesPointerDown,x=m.elements,E=m.props.sources,A=document.createElement("div");A.className="".concat(M," ").concat(N),x.container.appendChild(A),A.addEventListener("pointerdown",w.listener),x.sourceWrappersContainer=A;for(var I=0;I<E.length;I++)we(m,I)}(t),t.props.sources.length>1&&(L=(b=t).core.slideChangeFacade,Z(b,L.changeToPrevious,"previous","M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788S18.707,9.212,18.271,9.212z"),Z(b,L.changeToNext,"next","M1.729,9.212h14.656l-4.184-4.184c-0.307-0.306-0.307-0.801,0-1.107c0.305-0.306,0.801-0.306,1.106,0l5.481,5.482c0.018,0.014,0.037,0.019,0.053,0.034c0.181,0.181,0.242,0.425,0.209,0.66c-0.004,0.038-0.012,0.071-0.021,0.109c-0.028,0.098-0.075,0.188-0.143,0.271c-0.021,0.026-0.021,0.061-0.045,0.085c-0.015,0.016-0.034,0.02-0.051,0.033l-5.483,5.483c-0.306,0.307-0.802,0.307-1.106,0c-0.307-0.305-0.307-0.801,0-1.105l4.184-4.185H1.729c-0.436,0-0.788-0.353-0.788-0.788S1.293,9.212,1.729,9.212z")),function(m){for(var w=m.props.sources,x=m.resolve,E=x(ue),A=x(xe),I=x(ye,[E,A]),C=0;C<w.length;C++)if(typeof w[C]=="string"){var z=I.getTypeSetByClientForIndex(C);if(z)A.runActionsForSourceTypeAndIndex(z,C);else{var T=E.getSourceTypeFromLocalStorageByUrl(w[C]);T?A.runActionsForSourceTypeAndIndex(T,C):I.retrieveTypeWithXhrForIndex(C)}}else A.runActionsForSourceTypeAndIndex("custom",C)}(t),o.dispatch("onInit")}t.open=function(){var b=arguments.length>0&&arguments[0]!==void 0?arguments[0]:0,L=d.previous,m=d.current,w=d.next;d.current=b,l.i||le(t),s.updateStageIndexes(),l.i?(f.c(),f.a(),f.b(L),f.b(m),f.b(w),o.dispatch("onShow")):g(),a.displaySourcesWhichShouldBeDisplayed(),e.setSlideNumber(b+1),document.body.appendChild(u.container),document.documentElement.classList.add(_),c.addRecompense(),n.attachListeners(),r.runActions(),u.smw[d.current].n(),o.dispatch("onOpen")}}function te(t,e,i){return(te=ke()?Reflect.construct.bind():function(o,n,c){var a=[null];a.push.apply(a,n);var s=new(Function.bind.apply(o,a));return c&&ne(s,c.prototype),s}).apply(null,arguments)}function ke(){if(typeof Reflect>"u"||!Reflect.construct||Reflect.construct.sham)return!1;if(typeof Proxy=="function")return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch{return!1}}function ne(t,e){return(ne=Object.setPrototypeOf?Object.setPrototypeOf.bind():function(i,o){return i.__proto__=o,i})(t,e)}function Re(t){return function(e){if(Array.isArray(e))return V(e)}(t)||function(e){if(typeof Symbol<"u"&&e[Symbol.iterator]!=null||e["@@iterator"]!=null)return Array.from(e)}(t)||function(e,i){if(e){if(typeof e=="string")return V(e,i);var o=Object.prototype.toString.call(e).slice(8,-1);if(o==="Object"&&e.constructor&&(o=e.constructor.name),o==="Map"||o==="Set")return Array.from(e);if(o==="Arguments"||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o))return V(e,i)}}(t)||function(){throw new TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`)}()}function V(t,e){(e==null||e>t.length)&&(e=t.length);for(var i=0,o=new Array(e);i<e;i++)o[i]=t[i];return o}function oe(){for(var t=document.getElementsByTagName("a"),e=function(n){if(!t[n].hasAttribute("data-fslightbox"))return"continue";var c=t[n].hasAttribute("data-href")?t[n].getAttribute("data-href"):t[n].getAttribute("href");if(!c)return console.warn('The "data-fslightbox" attribute was set without the "href" attribute.'),"continue";var a=t[n].getAttribute("data-fslightbox");fsLightboxInstances[a]||(fsLightboxInstances[a]=new FsLightbox);var s=null;c.charAt(0)==="#"?(s=document.getElementById(c.substring(1)).cloneNode(!0)).removeAttribute("id"):s=c,fsLightboxInstances[a].props.sources.push(s),fsLightboxInstances[a].elements.a.push(t[n]);var r=fsLightboxInstances[a].props.sources.length-1;t[n].onclick=function(L){L.preventDefault(),fsLightboxInstances[a].open(r)},b("types","data-type"),b("videosPosters","data-video-poster"),b("customClasses","data-class"),b("customClasses","data-custom-class");for(var l=["href","data-fslightbox","data-href","data-type","data-video-poster","data-class","data-custom-class"],u=t[n].attributes,d=fsLightboxInstances[a].props.customAttributes,f=0;f<u.length;f++)if(l.indexOf(u[f].name)===-1&&u[f].name.substr(0,5)==="data-"){d[r]||(d[r]={});var g=u[f].name.substr(5);d[r][g]=u[f].value}function b(L,m){t[n].hasAttribute(m)&&(fsLightboxInstances[a].props[L][r]=t[n].getAttribute(m))}},i=0;i<t.length;i++)e(i);var o=Object.keys(fsLightboxInstances);window.fsLightbox=fsLightboxInstances[o[o.length-1]]}window.FsLightbox=function(){var t=this;this.props={sources:[],customAttributes:[],customClasses:[],types:[],videosPosters:[],sourceMargin:.05,slideDistance:.3},this.data={isFullscreenOpen:!1,scrollbarWidth:0},this.isl=[],this.sourcePointerProps={downScreenX:null,isPointering:!1,isSourceDownEventTarget:!1,swipedX:0},this.stageIndexes={},this.elements={a:[],container:null,slideSwipingHoverer:null,smw:[],sourceWrappersContainer:null,sources:[],sourceAnimationWrappers:[]},this.componentsServices={setSlideNumber:function(){}},this.resolve=function(e){var i=arguments.length>1&&arguments[1]!==void 0?arguments[1]:[];return i.unshift(t),te(e,Re(i))},this.collections={sourceLoadHandlers:[],sourcesRenderFunctions:[],sourceSizers:[]},this.core={eventsDispatcher:{},globalEventsController:{},lightboxCloser:{},lightboxUpdater:{},scrollbarRecompensor:{},slideChangeFacade:{},slideIndexChanger:{},sourcesPointerDown:{},sourceDisplayFacade:{},stageManager:{},windowResizeActioner:{}},this.fs={},this.sws={},Pe(this),this.close=function(){return t.core.lightboxCloser.closeLightbox()}},window.fsLightboxInstances={},oe(),window.refreshFsLightbox=function(){for(var t in fsLightboxInstances){var e=fsLightboxInstances[t].props;fsLightboxInstances[t]=new FsLightbox,fsLightboxInstances[t].props=e,fsLightboxInstances[t].props.sources=[],fsLightboxInstances[t].elements.a=[]}oe()}}])})});var Ve=Be(se(),1);
