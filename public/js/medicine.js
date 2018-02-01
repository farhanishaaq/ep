//
// function openNav() {
//     document.getElementById("mySidenav").style.width = "70%";
//     // document.getElementById("flipkart-navbar").style.width = "50%";
//     document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
// }
//
// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
//     document.body.style.backgroundColor = "rgba(0,0,0,0)";
// }

$( function() {


    $( "#searchMed" ).autocomplete({
//'http://localhost:8008/ep/public/medicinename'
        source: function (request, response ) {
            $.ajax({
                type: "GET",
                url:"/medicinename",
                data: {
                    'name': $('#searchMed').val()

                },
                success: response,
                dataType: 'json'
            });
        },

    }, {minLength: 3,  delay: 500 });
} );



