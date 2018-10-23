/**
 * @description The code to manage form for multiple upload media, to control we needed make a elements
 * and action for manipulate data form, to this we need use ID var for control elements of DOM
 */

$(document).ready(function(){

    var imagesView = function(media, input_preview){
        console.log(media)
        if(media.length > 0){
            // Count leght files
            // Roam array of files
            for(let i=0; i < media.length; i++){
                    // Container for media files
                    let container;
                    container = $($.parseHTML('<div>')).attr({'class':'media_container', 'id':'stored-'+media[i]['id']}).appendTo(input_preview)

                    // Variable to receive DOM element - action delete media
                    let elem;
                    // Description media file
                    let description;
                    /**
                    * @description The class data_uploaded enables script identify which are files to upload to server backend.
                    * Conditional to separete video files and image files.
                    */
                    if($.inArray(media[i]['source'].split('.')[1], ['mp4','mpeg','avi']) > -1){
                        $($.parseHTML('<video controls>')).attr({'id':media[i]['id'],'src':pathPlugin.url+'upload/'+media[i]['source']}).appendTo(container)
                    }else if($.inArray(media[i]['source'].split('.')[1], ['jpeg','jpg','png']) > -1){
                        $($.parseHTML('<img />')).attr({'id':media[i]['id'],'src':pathPlugin.url+'upload/'+media[i]['source']}).appendTo(container)
                    }
                    
                    // Create img to listener click delete event - data attributes contain file ID
                    elem = $($.parseHTML('<img />')).attr({'class':'iapy_delete_stored', 'data-media-id':media[i]['id'],'src':pathPlugin.url+'assets/images/delete.png'}).appendTo(container)
                    
                    // Create input text to description media file
                    description = $($.parseHTML('<input />')).attr({'disabled':'disabled','class':'description_stored', 'type': 'text'}).val(media[i]['description']).appendTo(container)

                    // Bind action click and handle event for remove all selected class
                    elem.bind('click', function(e){
                        deleteMedia(elem.attr('data-media-id'))
                    })
            }
        }
    }

    /**
     * @description Get full gallery to manage
     */
    
     $.ajax({
        type: 'POST',
        url: Ajax.url,
        data: {action: 'getGallery'},
        success: function(data){
            imagesView(JSON.parse(data), 'div.iapy_stored')
        },
        error: function(err){
            console.log(err)
        }
     })

     /**
      * @description Delete files of host and database.
      * @param {*} id Identify to remove file and data stored in database
      */
     var deleteMedia = function(id){
        console.table(id)
        showLoading()
        $.ajax({
            type: 'POST',
            url: Ajax.url,
            data: {action: 'deleteMedia', id: id},
            complete: function(){
                removeLoading()
            },
            success: function(data){
                let json = JSON.parse(data)
                console.log(json)
                $('#stored-'+json.id).remove()
            },
            error: function(err){
                console.log(err)
            }
        })
     }

     /**
      * @description Preview files (image&video) before upload in host and database.
      * @param {*} input Classname for input upload file
      * @param {*} input_preview Classname for input div show preview
      */
    var imagesPreview = function(input, input_preview){
        if(input.files){
            // Count leght files
            var filesAmount = input.files.length;
            // Roam array of files
            for(let i=0; i < filesAmount; i++){
                var reader = new FileReader()
                reader.onload = function(e){
                    var container;
                    // Variable to receive DOM element - action delete media
                    var elem;
                    // To description media file
                    var description;
                    // Conditional to separete video files and image files
                    container = $($.parseHTML('<div>')).attr({'class':'media_container fg_id_'+i}).appendTo(input_preview)
                    // The class data_upload enables script identify which are files to upload to server backend     
                    if(e.target.result.indexOf('data:video') > -1){
                        $($.parseHTML('<video controls>')).attr({'id':'fg_id_'+i,'class':'data_upload fg_id_'+i,'src':e.target.result}).appendTo(container)
                    }else if(e.target.result.indexOf('data:image') > -1){
                        $($.parseHTML('<img />')).attr({'id':'fg_id_'+i,'class':'data_upload fg_id_'+i,'src':e.target.result}).appendTo(container)
                    }else{
                        // Response default to invalid file extension
                        alert('A seleção possui arquivos não permitidos e não serão adicionados!')
                    }
                    // Create img to listener click delete event
                    elem = $($.parseHTML('<img />')).attr({'class':'iapy_delete fg_id_'+i, 'src':pathPlugin.url+'assets/images/delete.png'}).appendTo(container)
                    // Create input text to description media file
                    description = $($.parseHTML('<input />')).attr({'id':'fg_id_'+i,'class':'description fg_id_'+i, 'type': 'text', 'placeholder':'Descrição'}).appendTo(container)
                    // Bind action click and handle event for remove all selected class
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

    // click element button, this element is responsibility to save images in database
    $('#send_images').on('click',function(e){

        // create element to rotate the load by clicking action and apply the request action while waiting for the callback
        showLoading()

        // to make object with values to save in database
        var objs = new Array()
        $('.data_upload').each(function(){
            let id = $(this).attr('id')
            let source = $(this).attr('src')
            var description = $('input#'+id).val()

            //to make an array of objects that contain data from media files
            objs.push({'source':source, 'description':description})
        })

        // ajax request to send data for action wordpress
        $.ajax({
            type: 'POST',
            url: Ajax.url,
            data: {action: 'saveGallery',data: objs},
            complete: function(){
                removeLoading()
            },
            success: function(data){
                console.log(data);
                location.reload()
            },
            error: function(err){
                console.log(err)
            }
        })

    });
    function showLoading(){
        // create element to rotate the load by clicking action and apply the request action while waiting for the callback
        $($.parseHTML('<div>')).attr({'id':'spinner'}).appendTo('body')
        $("#spinner").fadeIn("slow")
    }
    function removeLoading(){
        $("#spinner").fadeOut("slow")
    }
});