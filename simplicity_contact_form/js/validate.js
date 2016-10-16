$(function(){

	$("form").submit(function(){

		// HTMLでの送信をキャンセル(Firefoxで効かなくなるので使用しない)
    // event.preventDefault();
		
		//エラーの初期化
		$("p.error").remove();
		$("dl dd").removeClass("error");
		
		$(":text,textarea").filter(".validate").each(function(){
			
			//必須項目のチェック
			$(this).filter(".required").each(function(){
				if($(this).val() == ""){
					$(this).parent().prepend('<p class="error">※未入力です</p>');
				}
			});

			// メールアドレスのチェック
			$(this).filter(".mail").each(function(){
				if($(this).val() && !$(this).val().match(/.+@.+\..+/g)){
					$(this).parent().prepend('<p class="error">メールアドレスの形式が正しくありません。</p>');
				}
			});

			// メールアドレス確認のチェック
			$(this).filter(".mail_check").each(function(){
				if($(this).val() && $(this).val() != $("input[name="+$(this).attr("name").replace(/^(.+)_check$/, "$1")+"]").val()){
					$(this).parent().prepend('<p class="error">メールアドレスが一致していません。</p>');
				}
			});

		});
		
		//エラーチェック
		if($("p.error").size() > 0){
			$("p.error").parent().addClass("error");
			return false;
		} else {
			//エラーなければメール送信Ajax表示
			$.ajax({
				type: "POST",
				url: "contact.php",
				data: {
					name: $("#name").val(),
					mail: $("#mail").val(),
					mail_check: $("#mail_check").val(),
					comment: $("#comment").val(),
					token: $("#token").val()
				},
        success: function(data){
        	$("#form_window p.message").append(data);

        	// メッセージが挿入された時に高さ取得
        	var form_window_width = $("#form_window").innerWidth();
					var form_window_height = $("#form_window").innerHeight();
					// if(window.innerWidth >= 768){

						$("#form_window").css('marginLeft', - (form_window_width/2) + 'px');
						$("#form_window").css('marginTop', - (form_window_height/2) + 'px');
					// } else {
					// 	$("#form_window").css('marginLeft', - (form_window_width/2) + 'px');
					// 	$("#form_window").css('marginTop','0px');
					// }

        	$("#glay_layer,#form_window").fadeIn(500);
        	$(".close ,#form_window").click(function(){
        		$("#glay_layer,#form_window").fadeOut(500, function(){
        			$("#name").val(''),
							$("#mail").val(''),
							$("#mail_check").val(''),
							$("#comment").val('')
							$("#form_window p.message").empty();
        		});
        	});
        }

			});

			return false;

		}

	});

});