<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Directory Selectbox</title>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
 <script>
			$.getJSON( "folderlist.php", function( data ) {
				  var items = "";
				  $.each( data, function( key, val ) {
					items += "<option value='" + val.path+val.name + "'>" + val.name + "</option>";
				  });
				 console.log(items);
				  $("select[id=dynamic][apply=yes]").html(items);
			});
</script>
<style>
		#dynamic {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			padding: 2px 30px 2px 2px;
			border: none;
			outline:none;
			background: transparent url("img/br_down.png") no-repeat right center;
		  }
</style>
</head>

<body>
<div class="selects">
                            <label>Select Folder : </label>
                            <select name="folder1" id="dynamic" apply="yes" onchange="addSelectChange()">
                                
                            </select>
                            
</div>
</body>
</html>
<script>
function addSelectChange(){ 
$("select[apply=yes]").bind('click',function () {
	
    var folder = $(this).val();
    var select_id = $(this).attr("name").replace('folder', '');
     //console.log(folder +':'+ select_id);
	 
	            var myRegExp = /.php/;
				var string1 = folder;
				var matchPos1 = string1.search(myRegExp);
	 
	 ///// main if start here  ////////	
			 if(matchPos1 != -1){
				 
				 // if .php file dont do anything ///
				 // but delete previously vies directory select box removed if ther ///
				 $("select[apply=yes][name=folder"+select_id+"]").nextAll("select[apply=yes]").remove();
				 
			 }else{
				 
				// but its a directory do it ////
    $.ajax({
        url: 'filefolder_api.php',
        type: "POST",
        data: {"folder": folder},
        success: function(data) {
            
             //console.log(data);
			 var actual = Number(select_id);
			     actual = actual+1;
			 //console.log($("select[name=folder"+actual+"]").length);
		     
			 $("select[apply=yes][name=folder"+select_id+"]").nextAll("select[apply=yes]").remove();
			 
			  
				 
			 if($("select[name=folder"+actual+"]").length >= 0){
				 
				 if($("select[name=folder"+actual+"]").length == 1){
				    $("select[name=folder"+actual+"]").html(data);	 
				 }else{
				 var newSelectbox   = '<select name="folder'+actual+'" id="dynamic" apply="yes" onchange="addSelectChange()">';
				 var selectBoxClose = '</select>';
				 
				 $( newSelectbox+data+selectBoxClose ).insertAfter( "select[name=folder"+select_id+"]");
				 //console.log("ye");
				 }
			 }else{
				 $("select[apply=yes][name=folder"+select_id+"]").html(data);
				 //console.log("oh");
			 }
			 
			 }
            
			
            
        
    });
	/////////////////////    main else over  ///////////////////////
			 }
	
});
}
</script>