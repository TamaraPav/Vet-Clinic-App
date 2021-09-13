$(document).ready(function() {
    console.log('radi');
    filterApps();
    $('#filterApp').change(filterApps);
});
var _token   = $('meta[name="csrf-token"]').attr('content');
function filterApps(){
    console.log('radi');
    let app = $('#filterApp').val();
    console.log(app);
    $.ajax({
        "url":url+'/doctors',
        "method":'post',
        "data":{
            app: app,
            _token:_token
        },
        success: function (data){
            console.log('data.data');
            WriteApp(data);
        },
        error: function (xhr){
            console.log(xhr);
        }
    })
}
function WriteApp(data){
    let html='';

    for(let app of data){
        html+=`
        <div class="col-md-3 col-sm-12 app-card">
            <p>${app.firstName} ${app.lastName}</p>
            <p>${app.pet} - ${app.type}</p>
            <p>${app.date}</p>
            <p>${app.time}</p>
            <a class="btn btn-edit" href="`+url+`/user/${app.idPet}">Show Chart</a>
        </div>`;
    }
    $('#showApps').html(html);
}


