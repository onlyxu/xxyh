$(document).ready(function(){
	var cpath = $("#cpath").val();
	 KindEditor.ready(function(K) {
		   var options = {
				   items : [ 'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
					 	        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
						        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
						        'superscript', 'quickformat', 'selectall', '|', 'fullscreen', '/',
						        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
						        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
						        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'pagebreak',
						        'anchor', 'link', 'unlink']
			};
 		editor = K.create('textarea[name="content"]',options);

			var uploadbutton = K.uploadbutton({
				button : K('#uploadButton')[0],
				fieldName : 'imgFile',
				url : cpath+'/Public/kindeditor-4.1.10/php/upload_json.php?dir=image',
				afterUpload : function(data) {
					if (data.error === 0) {
						var url = K.formatUrl(data.url, 'absolute');
						K('#uploads').val(url);
						K('#uploadimgs').attr("src",url);
						$("#img_td").css("display","block");
					} else {
						alert(data.message);
					}
				},
				afterError : function(str) {
					alert('上传失败: ' + str);
				}
			});
			uploadbutton.fileBox.change(function(e) {
				uploadbutton.submit();
			});

		});

});