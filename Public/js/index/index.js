$(function() {
	var zongticheng = $("#zongticheng").val();
	var ticheng = $("#ticheng").val();
	var kejiesuan = $("#kejiesuan").val();
	var kexiaofei = $("#kexiaofei").val();

	var data = [ {
		name : '总业绩',
		value : zongticheng,
		color : '#a5c2d5'
	}, {
		name : '已结算',
		value : ticheng,
		color : '#cbab4f'
	}, {
		name : '可结算',
		value : kejiesuan,
		color : '#76a871'
	}, {
		name : '可用消费',
		value : kexiaofei,
		color : '#a56f8f'
	} ];

	new iChart.Column2D({
		render : 'canvasDiv',
		data : data,
		title : '业绩统计图',
		showpercent : true,
		decimalsnum : 2,
		width : 800,
		height : 400
	}).draw();
});