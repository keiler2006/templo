$(document).ready(function() {

    $('.photo-row').delegate('a.close','click', function(e) {
        e.preventDefault();
        var tr = $(this).attr('data-tr');
        $('#' + tr).remove();
    });
    
    $('.add-photo a').on('click', function(e) {        
        e.preventDefault();        
        
        collectionHolder_id = $(this).attr('data-table');
        collectionHolder = $('#'+collectionHolder_id);
        
        var count = collectionHolder.find('.photo-row').length;
        var index=0;
        if(count>0)
        {
            var name =  collectionHolder.find('.photo-row').last().find('input').attr('name');
            re = /.*(\d+).*/;
            if(re.exec(name))
            {             
                index=parseInt(RegExp.$1)+1;              
            }           
        }

        var file = collectionHolder.attr('data-prototype-file').replace(/__name__/g, index);      
        var file_label = collectionHolder.attr('data-prototype-file-label').replace(/__name__/g, index);      
        var name = collectionHolder.attr('data-prototype-name').replace(/__name__/g, index); 
        var name_label = collectionHolder.attr('data-prototype-name-label').replace(/__name__/g, index);
        var main = collectionHolder.attr('data-prototype-main').replace(/__name__/g, index); 
        var main_label = collectionHolder.attr('data-prototype-main-label').replace(/__name__/g, index);
        
        var file_id_prefix = collectionHolder.attr('data-file-id-prefix')+'_'+index+'_file';      
    
        $(this).parent().parent().before('<tr id="tr-'+index+'" class="photo-row">'+
                            '<td>'+
                                '<div class="container">'+
                                    '<div class="row">'+                                   
                                           file+                                                                 
                                    '</div>'+                                  
                                    
                                    
                                    '<div class="row">'+
                                        '<div class="pull-right">'+
                                            '<a href="#" class="del-photo">Eliminar</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</td>'+                          
                        '</tr>');  
               
            $("#"+file_id_prefix).removeClass('form-control').fileinput({
                    showCaption: true,
                    showPreview: true,
                    showRemove: false,
                    showUpload: false
                });
   
    });     


});
/*
'<div class="row">'+
                                        '<div class="col-sm-4">'+

                                        '</div>'+
                                        '<div class="form-horizontal col-sm-8">'+
                                            '<div class="form-group">'+
                                                name_label+
                                                '<div class="col-sm-8">'+
                                                name+
                                                '</div>'+
                                             '</div>'+
                                             '<div class="form-group">'+
                                                '<div class="col-sm-8 col-sm-offset-3">'+
                                                    main+
                                                '</div>'+
                                             '</div>'+                                            
                                       '</div>'+
                                    '</div>'+*/