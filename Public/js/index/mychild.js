
$(document).ready(function(){
	getChild();
});



function getChild()
{
	var username = document.getElementById("username").value;
	var userid = document.getElementById("userid").value;
	var userpid = document.getElementById("userpid").value;
	var cpath = document.getElementById("cpath").value;
	d = new dTree('d');
	d.add(userid,-1,username);
	$.getJSON(cpath+"/index.php/mychild",{},function(data){

			var items = data.child;
			$.each(items,function(index,item){

				var totalbance = item.totalbalance;
				if(!totalbance)
				{
					totalbance=0;
				}
				d.add(item.id,item.pid,item.name+",累计消费"+totalbance);

			});
			$("#rightinfo").html(d.toString());
	});



}