<div class="card-embed-fix"><div class="row" style="margin-right:0px;"><div class="col-xl-2 d-none d-xl-block">@include('pages.rooms.form.leftpanel')</div><div class="col-xl-8 d-none d-xl-block chat-area">	<section class="feeds">				<div class="body-room" id="body-room">		@foreach( $chats as $chat)		<article class="feed">            <section class="feeds-user-avatar">                <img src="{{ isset($chat->avatar_filename) ? url('/storage/avatars/'.$chat->avatar_directory.'/'.$chat->avatar_filename) :  url('/storage/avatars/system/default_avatar.jpg') }}" alt="{{ $chat->first_name }}" width="40">                              </section>            <section class="feed-content">                <section class="feed-user-info">                    <h4>{{ $chat->first_name }} <span class="time-stamp">{{ date_format(date_create($chat->chatroom_created),'H:i') }}</span></h4>                </section>                                  <p>{!! clean($chat->message) !!}</p>                                  </section>        </article>				@endforeach				              		</div>			<section class="form-group input-msg">					<form id="form_room"  method="post">				<textarea class="form-control message" id="message" name="message" rows="8"></textarea>				<input type="hidden" name="groupemployee_id" id="groupemployee_id" value="{{ $mygroup->grouproom_id ?? '' }}" />				<button type="submit" title="" class="data-toggle-action-tooltip btn btn-sm btn-send">					<i class="sl-icon-paper-plane"></i>				</button> 				</form>			</section>					</section>							</div><div class="col-xl-2 right-panel-room d-none d-xl-block">Empty for nowSmaller when the Left side menu widget is expanded</div></div></div><script>$("#body-room").scrollTop($("#body-room")[0].scrollHeight);tinymce.init({	selector: '#message',  // change this value according to your HTML	mode: 'exact',    theme: "modern",    skin: 'light',	toolbar: false,	branding: false,	menubar: false,	statusbar: false,	height: 200,		forced_root_block : false,	force_br_newlines : true,	force_p_newlines : false,	convert_newlines_to_brs : true,});$("form#form_room").submit(function(e) {		var obj = {};		var csrf_token = "{{ csrf_token() }}";	e.preventDefault();	var url = "{{ $page['action_url'] }}";	var formData = new FormData(this);		$.ajaxSetup({		headers: {			'X-CSRF-TOKEN': "{{ csrf_token() }}"		}	});	$.ajax({		url: url,		type: 'POST',		data: formData,		success: function (response) {						tinymce.get('message').setContent('');			var notification = response['notification'];			obj['type'] = notification['type'];			obj['message'] = notification['value'];					if(obj['type'] != 'success'){				NX.notification(obj);			}						if(obj['type'] == 'success'){				var dom_html = response['dom_html'][0];				$("#body-room").replaceWith(dom_html['value']);					$("#body-room").scrollTop($("#body-room")[0].scrollHeight);			}					},		cache: false,		contentType: false,		processData: false	});});function load_chats(){	var max_id = $('#max_id').val();		var groupemployee_id = $('#groupemployee_id').val();		if(groupemployee_id > 0){		var url = "{{ $page['refresh_url'] }}/"+groupemployee_id;		$.ajaxSetup({			headers: {				'X-CSRF-TOKEN': "{{ csrf_token() }}"			}		});		$.ajax({			data : {max_id : max_id},			url : url,			type : "POST",							success:function(response){			    				var dom_html = response['dom_html'][0];				$("#body-room").replaceWith(dom_html['value']);							$("#body-room").scrollTop($("#body-room")[0].scrollHeight);			}		});			}}function showChat(id, title){		$('#groupemployee_id').val(id);	$('.room-name').text(title);	load_chats();	var new_url = "{{ url('rooms') }}/"+id;	window.history.pushState("data","Title",new_url);	}setInterval(function(){load_chats()}, 2200);</script>