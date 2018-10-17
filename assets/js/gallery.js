$(document).ready(function(){

    var imagesPreview = function(input, input_preview){
        if(input.files){
            // Count leght files
            var filesAmount = input.files.length;
            // Roam array of files
            for(let i=0; i < filesAmount; i++){
                var reader = new FileReader()
                reader.onload = function(e){
                    console.log(e)
                    // Var to receive DOM element - action delete media
                    var elem;
                    // conditional to separete video files and image files
                    if(e.target.result.indexOf('data:video') > -1){
                        /**
                         * @description the class data_upload enables script identify which are files to upload to server backend
                         */
                        $($.parseHTML('<video controls>')).attr({'class':'data_upload fg_id_'+i,'src':e.target.result}).appendTo(input_preview)
                    }else if(e.target.result.indexOf('data:image') > -1){
                        $($.parseHTML('<img />')).attr({'class':'data_upload fg_id_'+i,'src':e.target.result}).appendTo(input_preview)
                    }else{
                        // response default to invalid file extension
                        alert('A seleção possui arquivos não permitidos e não serão adicionados!')
                    }
                    
                    // create img to listener click delete event
                    elem = $($.parseHTML('<img />')).attr({'id':'iapy_delete','class':'fg_id_'+i, 'src':pathPlugin.url+'assets/images/delete.png'}).appendTo(input_preview)
                    
                    // bind action click and handle event for remove all selected class
                    elem.bind('click', function(){
                        var classname = ".".concat($(this).attr('class'))
                        $(classname).remove()
                    })
                }
                reader.readAsDataURL(input.files[i])
            }
        }
    }
    // input handler on change event to preview images before upload
    $('#wp_full_gallery_input').on('change', function(){
        imagesPreview(this, 'div.iapy_preview')
    })
});
