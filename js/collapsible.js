animatedcollapse.addDiv('isaac', 'fade=1,height=80px')
animatedcollapse.addDiv('jeff', 'fade=1,height=100px')
animatedcollapse.addDiv('liew', 'fade=1,height=120px')
animatedcollapse.addDiv('kuan', 'fade=1,height=140px')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

