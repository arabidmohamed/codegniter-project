$(function(){
		
    $(".select2").select2({
        theme:'bootstrap'
    });
    
    var dTable = $('#events_list').DataTable({
        order: false,
        lengthChange: false,
        ordering: false,
        processing: false,
        info: false,
        filter: false,
        scrollX: false,
        autoWidth:false,
        lengthMenu: [ [16, 48, 96, 192, -1], [16, 48, 96, 192, "All"] ],
        pageLength: 16,
        serverSide: true,
        ajax: {
            url: Utilities.functions.getBaseUrl() + "events/getEvents",
            type: "POST",
            data: function(data){
              data.category_slug = $('#category').val();
              data.subcategory_slug = $('#subcategory').val();
              data.name = $('#pname').val();
              data.search = $('#filter_search').val();
              return data;
            }
            
        },
        drawCallback: function(settings){
            if(settings.json.data.length == 0){
                $(".dataTables_wrapper > .row:last-child").addClass('hide');					
            } else {
                $(".dataTables_wrapper > .row:last-child").removeClass('hide');
            }
            // hide pagination if less than one page
            
            if(settings._iRecordsTotal <= 16){
                $(".dataTables_wrapper .dataTables_paginate").addClass('hide');
            } else {
                $(".dataTables_wrapper .dataTables_paginate").removeClass('hide');
            }
        }
    });

    getSubCategories($('#category').val());

    $("#category").on("change", function(){
        getSubCategories($(this).val(), true);
    });
    
    $("form#events_filter").on("submit", function(){
        $('#events_list').DataTable().draw();
        return false;
    });
    
});

function getSubCategories($title = 0, _change = false)
{
    var _url = $("#getsubcategory_url").val();
    var data = { category : $title };
    $.post(_url, data, function(r){
        var result = JSON.parse(r);
        if(_change)
        {
            $("#subcategory option:not(:first)").remove();
            //$("#subcategory option:first").attr();
            
            for(var i = 0; i < result.length; i++)
            {
                $("#subcategory").append($('<option ></option>').val(result[i]['SCSlug']).html(result[i][$("#subcategory_lang").val()]));
            }
        }
        
        $(".select2").select2({
            theme:'bootstrap'
        });
    });
}