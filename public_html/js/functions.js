
function questionPageUniqueChecker(elmnt){
	$("#overlay").fadeIn() ;
	var site_url = $("input[name=site_url").val() ;
	lesson_id = elmnt.value ;
	termdate_id = $('select[name="term_date_id"]').val() ;
	seri = $('input[name="seri"]:checked').val() ;
	if(termdate_id == null || seri == undefined){
		bootbox.alert('لطفا قبل از چک کردن , فیلدهای ترم تحصیلی و کد سری سوال را پر کنید .') ;
		return ;
	}
	$.ajax({
			url : site_url + "admin/dash_question/qpage_unique_check/" + termdate_id + '/' + lesson_id + '/' + seri,
			success : function(result){
				bootbox.alert(result) ;
				$("#overlay").fadeOut() ;
			}
	}) ;
}

$(document).ready(function(){

	var site_url = $("input[name=site_url").val() ;
	$("#overlay").fadeOut() ;

	$(".datatable").dataTable( {
		"info" : false ,
		"paging" : true ,
		"filter" :false ,
		language: {
	        processing:     "در حال پردازش ...",
	        loadingRecords: "بار گذاری اطلاعات ...",
	        emptyTable:     "اطلاعاتی برای نمایش وجود ندارد",
	        lengthMenu:    "تعداد ردیف _MENU_",
	        paginate: {
	            first:      "اولین",
	            previous:   "قبلی",
	            next:       "بعدی",
	            last:       "آخرین"
	        },
	    }
	});


	$(".datatable_without_pagin").dataTable( {
		"info" : false ,
		"paging" : false ,
		"filter" :false 
	});
	
		
	//initialize tiny mce with conifigs 
	//
	// //initialize tiny mce with conifigs 
	// tinymce.init({
	// 	selector : ".full_textarea" ,
	// 	language: "fa_IR",
	// 	directionality : 'rtl',
	// 	plugins: [
	// 		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
	// 		"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
	// 		"table contextmenu directionality emoticons paste textcolor responsivefilemanager directionality code"
	// 	],
	// 	toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
	// 	toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | ltr rtl ",
	// 	image_advtab: true ,

	// 	external_filemanager_path:"http://localhost/pnu/public_html/filemanager/",
	// 	filemanager_title:"Responsive Filemanager" ,
	// 	external_plugins: { "filemanager" : "../../../filemanager/plugin.min.js"}
	// });
	tinymce.init({
		selector : ".full_textarea" ,
		language: "fa_IR",
		directionality : 'rtl',
		plugins: [
			"image",
			"wordcount",
			"paste textcolor responsivefilemanager directionality code"
		],
		toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | unlink | image | forecolor backcolor | ltr rtl ",
		image_advtab: true ,

		external_filemanager_path: site_url + "filemanager/",
		filemanager_title:"فایلها" ,
		external_plugins: { "filemanager" : "../../../filemanager/plugin.min.js"},

		content_css : site_url + 'css/custom.css'
	});

	$( ".radio_button" ).each(function( index ) {
		$(this).radiosforbuttons();
		// $('.radio_button2').radiosforbuttons({
			// group: true, // grouped buttons
			// vertical: false, // vertical mode
			// autowidth: true,
			// margin: 2, // space between buttons
		// });
	});


	/**
	 * in new question page when click on Qtype it change answer type fields
	 */
	$("button.radiosforbuttons-type").click(function(){
		if( $(this).val() == 1){
			$('#question_type_1').fadeIn() ;
			$('#question_type_2').hide() ;
		}else{
			$('#question_type_2').fadeIn() ;
			$('#question_type_1').hide() ;
		}

	});

	/**
	 * in new question page when click on Qtype it change answer type fields
	 */
	$("button.radiosforbuttons-type").click(function(){
		if( $(this).val() == '4'){
			$('#ekhtiari_nazari_n').fadeIn() ;
		}else{
			$('#ekhtiari_nazari_n').fadeOut() ;
		}

	});

	$(".add_lesson_btn").click(function(e){
		e.preventDefault() ;
		var lsn_id = $("#lesson_id").val().trim() ; 
		var lsn_name = '' ;
		//put checkboxes into lesson_list
		var lesson_list = $('.lesson_id_checkbox').map(function () { return this.value; }).get();

		if(lsn_id == '' ) {
			bootbox.alert('لطفا مقدار مناسب را در کادر وارد نمایید') ;
			return ;
		}
		if( $.inArray(lsn_id , lesson_list) !== -1 ){
			bootbox.alert("این درس را قبلا وارد نموده اید") ;
			return ;
		}
	
		$("#overlay").fadeIn();
		//send by ajax and get lesson name , if not exist send alert
		$.ajax({
				url : site_url + "admin/dash_lesson/get_lesson_name/" + lsn_id ,
				success : function(result){
					$("#overlay").fadeOut();
					lsn_name = result ;		
								
					if(lsn_name == "-1" || lsn_name == ''){
						//aya mikhahid darse jadid besazid ?? 
						// bootbox.alert($('#id_not_found_new_class_suggestion').html() ) ;	
						bootbox.alert('<p>درس مورد نظر یافت نشد</p><p>اگر میخواهید درس را ایجاد کنید روی لینک کلیک کنید <a target="_blank" href="'+ site_url + 'admin/dash_lesson/add_lesson/'+ lsn_id +'">لینک ساخت درس</a></p>') ;	
					}else{
						var checkbox_div = 
								'<div class="form-inline"><div class="checkbox"><label> ' + lsn_name + '-' + lsn_id + 
								'<input type="checkbox" name="lesson_id[]" class="lesson_id_checkbox" value="'+ 
								lsn_id + '"  checked /></label></div> <button value="'+ 
								lsn_id + '" class="btn btn-default btn-xs" type="button" onClick="questionPageUniqueChecker(this)"> <span class="glyphicon glyphicon-check"></span> </button> </div>' ;
						bootbox.confirm('نام درس ' + lsn_name + ' میباشد ؟' , function(result){
							if(result) {
								$("#lesson_id_div").append(checkbox_div) ;
								$("#lesson_id").val('');
							}
						});
						
						
					}
				}
			}) ;
	});



	
});




