$("a").removeAttr("contenteditable");

$('iframe').each(function(){
    $(this).attr('src',$(this).attr('data-src'));
});


var uid=$("body").attr( "uid" );
if(uid=='1'){
	
}else{
	var base_url='https://slimweb.vn/api/valid-user/'+uid;
	$.getJSON(base_url, function(data) {   
	if(!data.nodes[0]){
		// $("body").hide();
		// alert('Tài khoản của bạn đã hết hạn. Vui lòng thanh toán để trang web hoạt động bình thường!');
		$.get("https://slimweb.vn/api/brand/top.php", function( data ) {
          $("body" ).append(data);
        });
        $.get("https://slimweb.vn/api/brand/bottom.php", function( data ) {
          $("body" ).append(data);
        });
		
	}
	});
}