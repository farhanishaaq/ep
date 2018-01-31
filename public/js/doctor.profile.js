//
// $(function () {
//     $.ajax({
//         type : "get",
//         url : "starRating.index",
//         data : {
//             "doctorId" : $('#Doctro_id').val()
//         },
//         dataType : "json",
//         success : function(response){
//             if(response.toString() == "noRecord"){
//
//                 $("#rateYo").rateYo({
//                     rating: 0,
//                     fullStar:true
//                     //readOnly: true
//                 })
//                 // console.log('in no record')
//             }else {
//                 $("#rateYo").rateYo({
//                     rating: response[0].rating,
//                     fullStar:true,
//                     readOnly: true
//                 })
//                 //  console.log(response)
//                 // console.log('in found record '+response[0].rating)
//                 $('#drRate').html(response[0].rating+'<i class="fa fa-star fa-2x" style="color: goldenrod;margin-top: 4px" aria-hidden="true"></i>')
//             }
//         },
//         error : function(response){
//             //console.log('fail')
//         }
//     });
// })
//
// $(function () {
//
//     $("#rateYo")
//         .on("rateyo.set", function (e, data) {
//             $.ajax({
//                 type : "post",
//                 url : "starRating.store",
//                 data : {
//                     "rating" : data.rating,
//                     "userId" : $('#auth_user').val(),
//                     "doctorId" : $('#Doctro_id').val()
//                 },
//                 dataType : "json",
//                 success : function(response){
//                     if(response.toString() == "sucess"){
//
//                         //  console.log('sucess')
//                     }
//                 },
//                 error : function(response){
//                     //  console.log('fail')
//                 }
//             });
// //                    alert("The rating is set to " + data.rating + "!");
//         });
//
// });
//
//
//
//
//
//            getComments();
function getComments() {

    $.ajax({
        type: 'get',
        url: '/showComment',
        dataType: 'json',
        data: {

            'id': $('#target_Id').val(),
            'type': $('#type').val()

        },
        success: function (data) {

            if ((data.errors)) {
                // console.log(JSON.stringify(data));
            } else {
                //  console.log(JSON.stringify(data));
                $("#commentList").empty();
                $.each( data, function( key, val ) {
                    imagePath = "";
                    if(val.photo === null) {
                        if (val.gender === 'Male')
                            imagePath = "/uploads/maleUnknown.jpg";
                        else
                            imagePath = "/uploads/femaleUnknown.jpg";
                    }
                    else {
                        imagePath =  "/"+val.photo;
                    }
                    var txt2 = $(" <li>  "
                    //     +"<div>" +
                    //     "<strong  class='pR10' style='color: #01ADD5'>"+val.full_name+"</strong>" +
                    //     "<strong class='mT5 text-muted' style='font-size: 10px;' >"+ (val.created_at).slice(0,-3)
                    //     +"</strong>"+
                    //     // "<span class='ali' style='font-size: 10px'>"+ (val.created_at).slice(0,-3)
                    //     // +"</span>"+
                    // "</div>"+
// ----------------
                        // +"<div class='col-md-12'>" +
                        // +"<div class='col-md-2'>"+
                        // "<strong  class='pR10' style='color: #01ADD5'>"+val.full_name+"</strong>"
                        // +"</div>" +
                        // +"<div class='col-md-10'>"+
                        // "<strong class='mT5 text-muted' style='font-size: 10px;' >"+ (val.created_at).slice(0,-3)
                        // +"</strong>"+
                        // +"</div>" +
                        // +"</div>" +




                    //     +"<div>" +
                    //     "<strong  class='pR10' style='color: #01ADD5'>"+val.full_name+"</strong>" +
                    //     "<strong class='mT5 text-muted' style='font-size: 10px;' >"+ (val.created_at).slice(0,-3)
                    //     +"</strong>"+
                    //     // "<span class='ali' style='font-size: 10px'>"+ (val.created_at).slice(0,-3)
                    //     // +"</span>"+
                    // "</div>"+



                        + "<div  style='padding-bottom: 10px; margin-bottom: 25px' class='commentText col-md-12'>"
                        + "<span class='col-md-1 p0'> "
                        + "<img src='"+imagePath+"' class='p0'>"


                    //        if(isset($doctors[$i]->photo))
                    // {{asset('uploads/'.$doctors[$i]->photo)}}
                    //             else
                // if($doctors[$i]->gender =="Male")
                //     'uploads/maleUnknown.jpg'
                // else
                //     'uploads/femaleUnknown.jpg'







                        + "</span>"
                        + "<span class='col-md-11'> "
                        + "<strong  class='pR10' style='color: #01ADD5'>"+val.full_name+"</strong>"
                        + "<strong class='mT5 text-muted' style='font-size: 10px; position: absolute' >"+ (val.created_at).slice(0,-3)
                        + "</strong>"
                        + "<br>"
                        + "<p>"
                        + val.comments
                        + "</p>"
                        + "</span>"
                        + "</div>"
                        + "<hr class='w95p fL mT0'/>"
                        + "</li>") ;  // Create text with jQuery

                    $("#commentList").append(txt2);     // Append new elements

//                            $("#commentList").appendChild(txt2);
                    //alert(val.comments);
                });


            }
        }
    });


}

getComments();

//        getComments();

$("#ajax").click(function(event) {
    event.preventDefault();
    if($('#comment').val().length>5){
        $.ajax({
            type: "get",
            url: "/comment",
            dataType: "json",
            data: {
                //'_token': $('input[name=_token]').val(),

                'target_Id': $('#target_Id').val(),
                'type': $('#type').val(),
                'comment': $('#comment').val()
            },

//                data: $('#ajax').serialize(),
            success: function(data){
                commentsreload();
                getComments();
                $('#comment').val('')
            },

            error: function(data){

            }
        });

    }else {
        return 0
    }


});



function commentsreload() {

    $.ajax({
        type: 'get',
        url: '/showComment',
        dataType: 'json',
        data: {

            'id': $('#Doctro_id').val()

        },
        success: function (data) {

            if ((data.errors)) {
                console.log(JSON.stringify(data));
            } else {
                console.log(JSON.stringify(data));
                $.each( data, function( key, val ) {
                    var txt2 = $(" <li>  " +
                        "<div  class='commentText'><p> " + val.comments+"</p>"+"<span>"+ val.created_at+"</span>" +
                        "</div>" +
                        "</li>");  // Create text with jQuery

                    // Append new elements
                    $("#commentList").empty();
//                            $("#commentList").append( txt2)

//                            $("#commentList").appendChild(txt2);
                    //alert(val.comments);
                });
            }
        }
    });
}




function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    //  document.getElementById('submit').addEventListener('click', function() {
    geocodeAddress(geocoder, map);
    //   });
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

