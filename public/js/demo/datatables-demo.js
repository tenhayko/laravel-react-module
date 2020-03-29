// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  $('.edit-user').click(function(event) {
  	/* Act on the event */
  	var userid = $(this).data('userid');
  	var name = $(this).data('name');
  	var phone = $(this).data('phone');
  	var mail = $(this).data('mail');
  	var thunhap = $(this).data('thunhap');
  	var hinhthucvay = $(this).data('hinhthucvay');
  	var sotienvay = $(this).data('sotienvay');
  	var note = $(this).data('note');
  	var status = $(this).data('status');
  	$('#myModal #userId').val(userid);
  	$('#myModal #name').val(name);
  	$('#myModal #phone').val(phone);
  	$('#myModal #mail').val(mail);
  	$('#myModal #thunhap').val(thunhap);
  	$('#myModal #hinhthucvay').val(hinhthucvay);
  	$('#myModal #sotienvay').val(sotienvay);
  	$('#myModal #note').val(note);
  	$('#myModal #status').val(status);
  	$('#myModal').modal('show');
  });

  $('#formEditUser').submit(function (e) {
  	e.preventDefault();
  	var dataForm = $('#formEditUser').serialize();
    var action = $(this).attr('action');
    var savingItem = $.post(action, dataForm, null, 'json');
    savingItem.done(function(res) {
        var userid = $('#myModal #userId').val();
	  	var name = $('#myModal #name').val();
	  	var phone = $('#myModal #phone').val();
	  	var mail = $('#myModal #mail').val();
	  	var thunhap = $('#myModal #thunhap').val();
	  	var hinhthucvay = $('#myModal #hinhthucvay').val();
	  	var sotienvay = $('#myModal #sotienvay').val();
	  	var note = $('#myModal #note').val();
	  	var status = $('#myModal #status').val();
	  	var trSelect = $('#data-id-'+userid);
	  	trSelect.children('td.data-name').text(name);
	  	trSelect.children('td.data-phone').text(phone);
	  	trSelect.children('td.data-mail').text(mail);
	  	trSelect.children('td.data-thunhap').text(thunhap);
	  	trSelect.children('td.data-hinhthucvay').text(hinhthucvay);
	  	trSelect.children('td.data-sotienvay').text(sotienvay);
	  	trSelect.children('td.data-note').text(note);
	  	trSelect.children('td.data-edit').children('span').data('name', name).data('phone', phone).data('mail', mail).data('thunhap', thunhap).data('hinhthucvay', hinhthucvay).data('sotienvay', sotienvay).data('note', note).data('status', status);
	  	switch(status) {
		  case '0':
		    trSelect.children('td.data-status').html('<span class="btn btn-primary btn-sm">New</span>');
		    break;
		  case '1':
		    trSelect.children('td.data-status').html('<span class="btn btn-info btn-sm">Called</span>');
		    break;
		   case '2':
		    trSelect.children('td.data-status').html('<span class="btn btn-success btn-sm">Success</span>');
		    break;
		   case '3':
		    trSelect.children('td.data-status').html('<span class="btn btn-danger btn-sm">False</span>');
		    break;
		  default:
		    trSelect.children('td.data-status').html('<span class="btn btn-primary btn-sm">New</span>');
		}
	  	$('#myModal').modal('hide');
    });
    savingItem.fail(function(res) {
       $('#myModal').modal('hide');
    });
  });
});
