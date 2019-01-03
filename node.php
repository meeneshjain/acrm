	<script type="text/javascript">
	    /*################### CHAT SCRIPT START ##############*/

	    var mysocketid = 'socket_'+my_socket_id;
		var socket = io.connect( 'http://localhost:8080' );

		function isTyping(socket_id){
			socket.emit( 'isTyping', {id:socket_id} );
		}

		socket.on('isTyping',function(id){
			//console.log(id +' is typing....');
			$(".usertyping").html('is typing...');
			setTimeout(timeoutTyping,2000);
		});

		function timeoutTyping(){
			$(".usertyping").html('');
		}

		function notifytoAll(notification)
		{
			if(notification == ''){ return false; }
			console.log(notification);
			socket.emit( 'notification', {notification} );
			getTips();
		}
	  
		socket.on('notification', function(msg)
		{
				console.log(msg);
				var notice = new PNotify({
					title: msg.notification.user,
					text:  msg.notification.message,
					type: 'success',
					buttons: {
				        closer: true,
				        sticker: false
				    }
				});
				notice.get().click(function() {
			    	notice.remove();
				});
				notifyMe(msg.notification.user,msg.notification.message);
		});

		function notifyMe(title,msg) 
		{
		  var regex = /(<([^>]+)>)/ig;
		  var body = msg;
		  var result = body.replace(regex, "");
		  if (Notification.permission !== "granted")
		    Notification.requestPermission();
		  else {
		    var notification = new Notification(title, 
		    {
		      icon: 'images/logo.png',
		      body: result,
		    });
		  }
		}

	    socket.emit('join', {socket_id: mysocketid});

	    //socket.emit('userlist', {socket_id: mysocketid});

	    /*socket.on('userlist', function(data){
			var from_id = my_socket_id;
			$("#chat_users").html('<p class="text-center"><i class="fa fa-spinner fa-spin"></i> Please wait while getting Tips ...!</p>');
	  		var html = '';
	  		$.each(data.userlist, function( i, item ) {
	  			console.log(data.socket_id+'-'+item.id);
	  			if(from_id !== item.id)
	  			{
	  			var status = 'inactive';
	  			if(item.is_login == '1'){ status = 'active'; }
	  			html +='<div onclick="chatWithUser(this)" class="chat_user" data-fuser='+from_id+' data-tuser='+item.id+'><img src="images/boy.png" /><p><strong id="cht_usr_nm_'+item.id+'">'+item.ename+'</strong></p><div data-active="'+item.id+'" class="status '+status+'"></div></div>';
	  			}
			});
			$("#chat_users").html(html);
	    });*/

	    function chatMsgSend(obj){
			if($.trim($(obj).val()) != '')
			{
				$this = $(obj);
				var msg = $this.val();
				var date = currentDateTime('India','5.5','2');
				var vdate = currentDateTime('India','5.5','1');
				var fid = $("#active_chat_from_user_id").val();
				var tid = $("#active_chat_to_user_id").val();
				$this.val('').focus();

				var cars = [fid, tid, ];
				var chatmsg = {to_id:fid, from_id:tid,messege:msg,db_date:date, send_at:vdate};
				//$('#chat_history_box').append('<div class="rightmsg"><div class="r_spce"></div><div class="r_text">'+msg+'</div><div class="r_time">'+vdate+'</div></div>');
				$('#chat_history_box').append('<div class="m-messenger__message m-messenger__message--out">\
									<div class="m-messenger__message-body">\
										<div class="m-messenger__message-arrow"></div>\
										<div class="m-messenger__message-content">\
										<div class="m-messenger__message-text">'+msg+'</div>\
										<div class="m-messenger__message-username">'+vdate+'</div>\
										</div>\
									</div>\
								</div>');
				$("#chat_history_box").animate({ scrollTop: $('#chat_history_box').prop("scrollHeight")}, 1000);

				//socket.emit( 'chatmsg', {chatmsg} );
				socket.emit( 'new_msg', {chatmsg} );
				//testMe(tid,msg);
			}
		}

		function currentDateTime(city, offset,format) {
		    // create Date object for current location
		    d = new Date();
		   	
		   	var month = new Array();
		   	 month[0] = "Jan";
			 month[1] = "Feb";
			 month[2] = "Mar";
			 month[3] = "Apr";
			 month[4] = "May";
			 month[5] = "Jun";
			 month[6] = "Jul";
			 month[7] = "Aug";
			 month[8] = "Sep";
			 month[9] = "Oct";
			 month[10] = "Nov";
			 month[11] = "Dec";

		    // convert to msec
		    // add local time zone offset
		    // get UTC time in msec
		    utc = d.getTime() + (d.getTimezoneOffset() * 60000);
		   
		    // create new Date object for different city
		    // using supplied offset
		    currentdate = new Date(utc + (3600000*offset));
		   
		    // return time as a string
   			var months = month[d.getMonth()];
   			var date  = currentdate.getDate();
			var hours = currentdate.getHours();
			var minutes = currentdate.getMinutes();
			var seconds = currentdate.getSeconds();

			var ampm = hours >= 12 ? 'PM' : 'AM';
			date = date < 10 ? '0'+date : date;
			hours = hours % 12;
		    hours = hours ? hours : 12; // the hour '0' should be '12'
		    hours = hours < 10 ? '0'+hours : hours;
		    minutes = minutes < 10 ? '0'+minutes : minutes;
		    seconds = seconds < 10 ? '0'+seconds : seconds;

		    var datetime = '';
		    if(format == '1'){ // return 01 Jan 2018 @ 01:15:21 AM
		    	datetime =  date + " "
		                    + months  + " " 
		                    + currentdate.getFullYear() + " @ "  
		                    + hours + ":"  
		                    + minutes + ":" 
		                    + seconds + " " + ampm; 
		    }
		    if(format == '2'){ // return 2018-01-01 01:15:21 AM
		    	var n_month = currentdate.getMonth()+1;
		    	n_month = n_month < 10 ? '0'+n_month : n_month;

		    	datetime =  currentdate.getFullYear() + "-"
		                    + n_month  + "-" 
		                    + date + " "  
		                    + hours + ":"  
		                    + minutes + ":" 
		                    + seconds + " " + ampm; 

		    }
		    return datetime;	                                  
		}

		socket.on("new_msg", function(msg) {
		    var msgforme = my_socket_id;
		    //console.log(msg);
			var chatboxid = msg.chatmsg.to_id+'@'+msg.chatmsg.from_id;
			var chatbox = $('#chat_history_box').attr('data-activechat');
			console.log(chatboxid+' - '+chatbox);

				if(chatbox == '0')
				{
					$('.globalchatbadge').html(parseInt($('.globalchatbadge').html())+1);
					if($('.chat_user[data-tuser="'+msg.chatmsg.to_id+'"]').find('span').length == 0)
					{
						$('.chat_user[data-tuser="'+msg.chatmsg.to_id+'"]').children('p').after('<span class="badge" style="margin-top:10px">1</span>');
					}
					else
					{
						var msgcnt = $('.chat_user[data-tuser="'+msg.chatmsg.to_id+'"]').find('span.badge').html();
						$('.chat_user[data-tuser="'+msg.chatmsg.to_id+'"]').find('span.badge').html(parseInt(msgcnt)+1);
					}
				}
				else if(chatbox == chatboxid)
				{
					//$('#chat_history_box').append('<div class="leftmsg"><div class="l_spce"></div><div class="l_text">'+msg.chatmsg.messege+'</div><div class="l_time">'+msg.chatmsg.send_at+'</div></div>');
					$('#chat_history_box').append('<div class="m-messenger__message m-messenger__message--in">\
									<div class="m-messenger__message-body">\
										<div class="m-messenger__message-arrow"></div>\
										<div class="m-messenger__message-content">\
											<div class="m-messenger__message-text">'+msg.chatmsg.messege+'</div>\
											<div class="m-messenger__message-username">'+msg.chatmsg.send_at+'</div>\
										</div>\
									</div>\
								</div>');
					$("#chat_history_box").animate({ scrollTop: $('#chat_history_box').prop("scrollHeight")}, 1000);
				}
				//document.getElementById("chatsound").play();
				$('#chat_history_box').attr('data-activechat');
				//notifyToUser(msg.chatmsg.to_id,msg.chatmsg.messege);
				notify_alert('info', msg.chatmsg.messege, 'Chat Notification');
		});

		function notifyToUser(id,msg)
		{
			/*var notice = new PNotify({
					title: $("#cht_usr_nm_"+id).text(),
					text:  msg,
					type: 'info',
					addclass: 'chat_notification',
					buttons: {
				        closer: true,
				        sticker: false
				    },
				});
			notice.get().click(function() {
			    notice.remove();
			});	  */
		}

    	function getOnlineUsers()
		{
			var from_id = my_socket_id;
			$("#chat_users").html('<p class="text-center"><i class="fa fa-spinner fa-spin"></i> Please wait while getting Tips ...!</p>');
		  	$.get(base_url+"schedule/get_online_user",function(resp,status){
		  		var html = '';
		  		var res = $.parseJSON(resp);
		  		console.log(res);
		  		$.each(res.data, function( index, item ) {
		  			if(from_id !== res.data[index].id)
		  			{
		  			var status = 'inactive';
		  			if(res.data[index].is_login == '1'){ status = 'active'; }
		  			var badge = '';
		  			if(item.badge !== '0')
		  			{
		  				badge = '<span class="m-list-timeline__badge m-list-timeline__badge--success">'+item.badge+'</span>';
		  			}
		  			//html +='<div onclick="chatWithUser(this)" class="chat_user" data-fuser='+from_id+' data-tuser='+item.id+' data-tooltip="tooltip" data-placement="top" title="Chat with '+item.ename+'"><img src="images/boy.png" /><p><strong id="cht_usr_nm_'+item.id+'">'+item.ename+'</strong></p>'+badge+'<div data-active="'+item.id+'" class="status '+status+'"></div></div>';
		  			
		  			html += '<div onclick="chatWithUser(this)" class="m-widget4__item chat_user" data-fuser='+from_id+' data-tuser='+res.data[index].id+' data-tooltip="tooltip" data-placement="top" title="Chat with '+res.data[index].first_name+'" style="cursor:pointer">\
							<div class="m-widget4__img m-widget4__img--pic">\
								<img src="'+base_url+'assets/app/media/img/users/100_4.jpg" alt="">\
							</div>\
							<div class="m-widget4__info">\
								<span class="m-widget4__title" id="cht_usr_nm_'+res.data[index].id+'">'+ res.data[index].first_name + ' '+res.data[index].last_name+'</span><br>\
								<span class="m-widget4__sub">'+res.data[index].user_role_name+'</span>\
							</div>\
							<div class="m-widget4__ext">'+badge+'</div>\
						</div>';

		  			}
				});
				$("#chat_users").html(html);
		  	});
		}	
		getOnlineUsers();

		function chatWithUser(obj)
		{
			$(obj).children('.badge').remove();
			$(".chattypemsginput").attr('readonly','readonly');
			$("#chat_userlist").fadeOut();
			$("#chat_with_user").fadeIn();
			$("#chat_history_box").attr('data-activechat',$(obj).attr('data-tuser')+'@'+$(obj).attr('data-fuser'));
			$("#active_chat_from_user_id").val($(obj).attr('data-fuser'));
			$("#active_chat_to_user_id").val($(obj).attr('data-tuser'));
			$("#chat_with_user_name").html($(obj).find('strong').text());
			$("#chat_history_box").html('<p class="text-center" style="color:#FFF;margin-top:50px"><i class="fa fa-spinner fa-spin"></i> Please wait while load message ...!</p>');
			var from_id = $(obj).attr('data-fuser');
			var to_id = $(obj).attr('data-tuser');
		  	$.get(base_url+"schedule/get_chat_history/"+from_id+"/"+to_id,function(data,status){
		  		var html = '';
		  		var res = $.parseJSON(data);
		  		$.each(res, function( i, item ) {
		  			if(from_id !== item.from_id)
		  			{
		  				console.log('here');
		  				//html +='<div class="leftmsg"><div class="l_spce"></div><div class="l_text">'+item.messege+'</div><div class="l_time">'+item.send_at+'</div></div>';
		  				html += '<div class="m-messenger__message m-messenger__message--in">\
									<div class="m-messenger__message-body">\
										<div class="m-messenger__message-arrow"></div>\
										<div class="m-messenger__message-content">\
											<div class="m-messenger__message-text">'+item.messege+'</div>\
											<div class="m-messenger__message-username">'+item.send_at+'</div>\
										</div>\
									</div>\
								</div>';
		  			}
		  			else
		  			{
		  				console.log('here1');
			        	//html +='<div class="rightmsg"><div class="r_spce"></div><div class="r_text">'+item.messege+'</div><div class="r_time">'+item.send_at+'</div></div>';
			    		html += '<div class="m-messenger__message m-messenger__message--out">\
									<div class="m-messenger__message-body">\
										<div class="m-messenger__message-arrow"></div>\
										<div class="m-messenger__message-content">\
											<div class="m-messenger__message-text">'+item.messege+'</div>\
											<div class="m-messenger__message-username">'+item.send_at+'</div>\
										</div>\
									</div>\
								</div>';
			    	}
				});
				$(".chattypemsginput").removeAttr('readonly');
				$(".chattypemsginput").focus();
				$("#chat_history_box").html(html);
			    $("#chat_history_box").animate({ scrollTop: $('#chat_history_box').prop("scrollHeight")}, 1000);
		  	});
		}
	</script>