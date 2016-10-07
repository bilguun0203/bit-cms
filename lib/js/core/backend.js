// Get session if is set
if(sessionStorage.getItem('menuClass')){
    var menuClass = sessionStorage.getItem('menuClass');
}
else {
    sessionStorage.setItem('menuClass', 'active');
    var menuClass = sessionStorage.getItem('menuClass');
}

if(menuClass == 'active'){
    $("#wrapper").addClass("active");
}
else {
    $("#wrapper").removeClass("active");
}
// When click on toggle button
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    if(menuClass == 'active'){
        menuClass = 'inactive';
        sessionStorage.setItem('menuClass', 'inactive');
    }
    else {
        menuClass = 'active';
        sessionStorage.setItem('menuClass', 'active');
        $("#wrapper").addClass("active");
    }
});
// If menuClass is inactive, this function runs
$("#sidebar-wrapper").hover(function (e) {
    e.preventDefault();
    if(menuClass != 'active'){
        $("#wrapper").toggleClass("active");
    }
});

// Data table
if($('#datatable').length > 0) {
    $('#datatable').DataTable({
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }],
        "dom": 'lCfrtip',
        "order": [],
        "colVis": {
            "overlayFade": 0,
            "align": "right"
        },
        "language": {
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                "next": '<i class="fa fa-angle-right"></i>'
            }
        }
    });
}