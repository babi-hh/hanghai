(function(b,a){b.Popover.options.collision=true;b.Popover.option("collision",true,function(){var d=this,c=d._options;function f(g){var h=a(g);g=h[0];if(g!==window&&g.nodeType!==9){return h.offset()}return{width:h.width(),height:h.height(),top:g.pageYOffset||g.scrollTop||0,left:g.pageXOffset||g.scrollLeft||0}}function e(j,i,g,h){return j.left>=h.left&&j.left+i<=h.left+h.width&&j.top>=h.top&&j.top+g<=h.top+h.height}d.on("before.placement",function(m,l,h,k){var j=f(c.within||window),g=h.placement,p=h.coord,n=Object.keys(k),o=n.indexOf(g)+1,i=n.splice(o,n.length-o);n=i.concat(n);while(n.length&&!e(l,p.width,p.height,j)){g=n.shift();a.extend(l,k[g]())}h.preset=g})})})(gmu,gmu.$);