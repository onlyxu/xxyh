var Script = function () {

    $.validator.setDefaults({
        submitHandler: function(form) {
        	//form.submit();
        	updatepass();
        }
    });

    $().ready(function() {

        $("#form1").validate({
            rules: {
            	pass: {
                    required: true,
                    minlength : 6
                },
                newpass:{
                	 required: true,
                	 minlength : 6
                },
                newpass2:{
               	 required: true,
               	 minlength : 6,
               	 equalTo : "#newpass"
               }
            },
            messages: {
            	pass: {
                    required: "请输入原密码",
                    minlength : "密码长度不小于6位"
                },
                newpass:{
                	required: "请输入新密码",
                    minlength : "密码长度不小于6位"
                },
                newpass2:{
                	required: "请确认新密码",
                    minlength : "密码长度不小于6位",
               	    equalTo : "两次密码输入不一致"
               }

            }
        });


    });


}();

function updatepass()
{
	var pass = $("#pass").val();
	var newpass = $("#newpass").val();

	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.getJSON(cpath+"/index.php/updatepass",{pass:pass,newpass:newpass},function(data){
		art.dialog.tips(data.msg,2);
		if(data.errorcode==-1)
		{
			window.location=cpath+"/index.php/gologin";
		}
	});
}

