(function(b,a,c){a.extend(b.Slider.options,{viewNum:2,travelSize:2});b.Slider.register("multiview",{_arrange:function(d,g){var h=this._items,m=this._options.viewNum,k=g%m,e=0,j=this.perWidth=Math.ceil(d/m),l,f;this._slidePos=new Array(h.length);for(f=h.length;e<f;e++){l=h[e];l.style.cssText+="width:"+j+"px;left:"+(e*-j)+"px;";l.setAttribute("data-index",e);e%m===k&&this._move(e,e<g?-d:e>g?d:0,0,Math.min(m,f-e))}this._container.css("width",j*f)},_move:function(f,l,k,e,j){var d=this.perWidth,h=this._options,g=0;j=j||h.viewNum;for(;g<j;g++){this.origin(h.loop?this._circle(f+g):f+g,l+g*d,k,e)}},_slide:function(m,n,g,e,f,d,i){var k=this,o=d.viewNum,j=this._items.length,h,l;d.loop||(n=Math.min(n,g>0?m:j-o-m));l=k._circle(m-g*n);d.loop||(g=Math.abs(m-l)/(m-l));n%=j;if(j-n<o){n=j-n;g=-1*g}h=Math.max(0,o-n);if(!i){this._move(l,-g*this.perWidth*Math.min(n,o),0,true);this._move(m+h*g,h*g*this.perWidth,0,true)}this._move(m+h*g,e*g,f);this._move(l,0,f);this.index=l;return this.trigger("slide",l,m)},prev:function(){var e=this._options,d=e.travelSize;if(e.loop||(this.index>0,d=Math.min(this.index,d))){this.slideTo(this.index-d)}return this},next:function(){var f=this._options,e=f.travelSize,d=f.viewNum;if(f.loop||(this.index+d<this.length&&(e=Math.min(this.length-1-this.index,e)))){this.slideTo(this.index+e)}return this}})})(gmu,gmu.$);