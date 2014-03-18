var Accountancy = new Marionette.Application();

Accountancy.addRegions({
	mainRegion: '#main-region'
});

Accountancy.SayHello = Marionette.ItemView.extend({
	template: "#greeting-tmp"

});

Accountancy.on("initialize:after", function () {
	var sayHello = new Accountancy.SayHello();
	Accountancy.mainRegion.show(sayHello);
});