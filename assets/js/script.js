
function onSignIn(googleUser) {
  var id_token = googleUser.getAuthResponse().id_token;
$.ajax({
    url:'/ci_project/users/googleLog',
    dataType:'json',
    type:'post',
    data:{id_token:id_token},
    success:function(json){
      if(json['status'] == 'ok'){
          
          $(location).attr('href','/ci_project/');
      }
    }
    
});
}
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }


$(document).ready(function(){
    
    
$('.datepicker').datetimepicker({
    pickTime : true
});

$('input[name=\'team_input\']').autocomplete({
   
	'source': function(request, response) {
       
		$.ajax({
           
			url: '/ci_project/users/autocomplete/'+encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {  
					return {
						label:item['username'],
                        value:item['id']
					}
                   
				}));
			}
		});
	},
	'select': function(event,ui) {

		$(this).val('');
        
		$('#team_member' + ui.item.value).remove();

		$('#team_member').append('<div class="margin-sm" id="team_member' + ui.item.value + '"><i class="fa fa-minus-circle"></i> ' + ui.item.label + '<input type="hidden" name="task_user[]" value="' + ui.item.value + '" /></div>');
        return false;
	}
});
    
$('#team_member').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
}); 
    
$('input[name=\'join_team\']').autocomplete({
   
	'source': function(request, response) {
       
		$.ajax({
           
			url: '/ci_project/teams/autocomplete/'+encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {  
					return {
						label:item['name'],
                        value:item['id']
					}
                   
				}));
			}
		});
	},
	'select': function(event,ui) {

		$(this).val('');
        
		$('#team_name' + ui.item.value).remove();

		$('#team_name').append('<div class="margin-sm" id="join_team' + ui.item.value + '"><i class="fa fa-minus-circle"></i> ' + ui.item.label + '<input type="hidden" name="team_user[]" value="' + ui.item.value + '" /></div>');
        return false;
	}
});
    
    
//    $('input[name^=\'selected\']:checked')

    
$('#team_name').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$('.toggle-status').change(function() {
          $.ajax({
               url:'/ci_project/tasks/mark_finish/' + $(this).val() + '/' + $(this).prop('checked'),
               dataType:'json',
               type:'get'
          });
    });

    
$('select[name="type"]').on('change', function() {
   
	$.ajax({
		url: '/ci_project/teams/get_team_members/'+ $('select[name="type"]').val(),
		dataType: 'json',
        beforeSend: function() {
		      $('#members').text('');
		},
		success: function(json) {
                for(var i=0;i<json.length;i++){
                    $('#members').append('<li>'+json[i]+'</li>');
                }
                
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
$('select[name="type"]').trigger('change');
    
    
    
});



