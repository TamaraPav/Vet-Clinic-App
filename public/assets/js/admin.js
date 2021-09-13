$(document).ready(function() {
    $(".page-link").click(sortActivities);
    $("#updateUser").click(editUser);
    $('#act').change(sortActivities);
    $('.deleteDiagnose').click(deleteDiagnose);
    $('.deleteMed').click(deleteMed);
    $('.deleteType').click(deleteType);
    $('.deletePet').click(deletePet);
    $("#search").keyup(searchPet);

});

function searchPet(){
    searchPetX(1)
}

function searchPetX(page){
    var search = $("#search").val();
    console.log("radi");
    console.log(search)
    if(search){
        $.ajax({
            url: url+"/admin/search",
            type: "GET",
            data : {search:search},
            dataType: "json",
            success: function(data){
                console.log(data)

                var output = "";
                if(data.length == 0){
                    output = "No matches."
                }else{
                    for(let d of data) {
                        //alert(d)
                        output += `<tr>
                            <th scope="row">${d.idPet}</th>
                            <td>${d.firstName} ${d.lastName}</td>
                            <td>${d.name}</td>
                            <td>${d.gender}</td>
                            <td>${d.bloodType}</td>
                            <td>${d.dateOfBirth}</td>`;
                        if(d.allergies == null){
                            output += `<td>None</td>`;
                        }
                        else{
                            output += `<td>${d.allergies}</td>`;
                        }
                        output += `<td><a class="btn btn-success" href="${url}/admin/${d.idPet}/edit">Edit</a></td>


                        <td><a href="#" class="btn btn-danger deletePet" data-id="${d.idPet}">Delete</a>
                        </td>
                    </tr>`;
                        }
                    }
                $('#searchPet').html(output);
            }
        });
    }else{
        window.location.href = urlCurrent;
    }
}
function deletePet(){
    let id = this.dataset.id;
    console.log(urlCurrent);
    console.log(id);

    $.ajax({
        url:url+'/user/deletePet/delete',
        method:'get',
        data: {
            id:id
        },
        success: function(data){
            console.log(data.data);
            window.location.href = urlCurrent;
        },
        error: function(xhr){
            console.log(xhr);
        }
    })
}

function deleteDiagnose(){
    let id = this.dataset.id;
    console.log(id);

    $.ajax({
        url:url+'/admin/deleteDg',
        method:'get',
        data: {
            id:id
        },
        success: function(data){
            console.log(data.data);
            window.location.href = urlCurrent;
        },
        error: function(xhr){
            console.log(xhr);
        }
    })
}
function deleteMed(){
    let id = this.dataset.id;
    console.log(id);

    $.ajax({
        url:url+'/admin/deleteMed',
        method:'get',
        data: {
            id:id
        },
        success: function(data){
            console.log(data.data);
            window.location.href = urlCurrent;
        },
        error: function(xhr){
            console.log(xhr);
        }
    })
}
function deleteType(){
    let id = this.dataset.id;
    console.log(id);

    $.ajax({
        url:url+'/admin/deleteType',
        method:'get',
        data: {
            id:id
        },
        success: function(data){
            console.log(data.data);
            window.location.href = urlCurrent;
        },
        error: function(xhr){
            console.log(xhr);
        }
    })
}
function sortActivities(e){
    e.preventDefault();
    var order = $('#act').val();
    let pgNum;
    if(this.classList.contains('page-link')){
        pgNum = this.dataset.page;
    }else{
        pgNum = 1;
    }
    $.ajax({
        "url":url+'/admin/activities',
        "method":'get',
        dataType:'json',
        data: {
            'order':order,
            'page':pgNum
        },
        success: function (data){
            console.log(data.data);
            writeLog(data.data);
            changePagination(data.last_page, data.current_page);
            changeActivePageLink(data.current_page);
        },
        error: function (xhr){
            console.log(xhr);
        }

    })
}








var _token   = $('meta[name="csrf-token"]').attr('content');

function editUser(){
    console.log("radi");
    var reName = /^[A-Z][a-z]{2,20}$/;
    var reAddress = /^[a-zA-Z0-9\s,.]{3,}$/;
    var reEmail = /^([a-z0-9]+\.*)+@(gmail|hotmail|yahoo|ict\.edu)\.(com|rs)$/;
    var rePhone = /^[0-9]+$/;
    var reRole = /^(1|2|3)$/;

    let id=$("#updateUser").data('id');
    let firstName = $('#firstName').val();
    let lastName = $('#lastName').val();
    let email = $('#email').val();
    let phone = $('#phone').val();
    let address = $('#address').val();
    let role = $('#role').val();
    console.log(id);

    let error = [];
    if(!reName.test(firstName)){
        $('#firstName').css('border-color','red');
        error.push("<p class='text-danger'> First name not in valid format</p>");
    }else{
        $('#firstName').css('border-color','transparent');
    }
    if(!reName.test(lastName)){
        $('#lastName').css('border-color','red');
        error.push("<p class='text-danger'> Last name not in valid format</p>");
    }else{
        $('#lastName').css('border-color','transparent');
    }
    if(!reEmail.test(email)){
        $('#email').css('border-color','red');
        error.push("<p class='text-danger'> Email not in valid format</p>");
    }else{
        $('#email').css('border-color','transparent');
    }
    if(!reAddress.test(address)){
        $('#address').css('border-color','red');
        error.push("<p class='text-danger'> Address not in valid format</p>");
    }else{
        $('#address').css('border-color','transparent');
    }

    if(!rePhone.test(phone)){
        $('#phone').css('border-color','red');
        error.push("<p class='text-danger'> Phone not in valid format</p>");
    }else{
        $('#phone').css('border-color','transparent');
    }
    if(!reRole.test(role)){
        $('#role').css('border-color','red');
        error.push("<p class='text-danger'> Role not in valid format</p>");
    }else{
        $('#role').css('border-color','transparent');
    }

    if(!error.length){
        $.ajax({
            url:url+"/admin/updateUser",
            method:"post",
            dataType: "json",
            data:{
                id:id,
                firstName:firstName,
                lastName:lastName,
                email:email,
                address:address,
                phone:phone,
                role:role,
                _token:_token
            },
            success: function (data){
                console.log(data.data);
                alert('User has been updated!');
            },
            error: function (xhr){
                console.log(xhr)
                alert('User has not been updated!');
            }

        })
    }else{
        for(let e of error){
            console.log(e);
            $('#err-message').html(e);
        }
    }

}
function activity(){
    showLog(1);
}

function loadMoreLogs(e){
    e.preventDefault();
    let page = $(this).data("page");
    console.log(page);
    showLog(page);
}

function showLog(page){
    //e.preventDefault();
    $.ajax({
        type:"GET",
        url:url+"/admin/activities",
        dataType:"json",
        data: {page:page},
        success:function(response){
            console.log(response.data);
            //console.log(response.last_page, response.current_page)
            changePagination(response.last_page,response.current_page);
            writeLog(response.data);
            //changeActivePageLink(response.current_page);

        },
        error:ajaxError
    })
}

function writeLog(data){

    let html = `<thead>
                        <tr>
                            <td>ID User</td>
                            <td>Ip</td>
                            <td>Activity</td>
                            <td>Date</td>
                        </tr>
                        </thead>
                        <tbody>`;
    for(let d of data){
        html += htmlWrite(d);
    }
    html+="</tbody>";

    $("#ispisLoga").html(html);
}

function htmlWrite(data){
    return `<tr>
            <td>${data.idUser}</td>
            <td>${data.ip}</td>
            <td>${data.activity}</td>
            <td>${data.date}</td>
            </tr>`;
}
function changeActivePageLink(currentPage){
    $('.page-item').removeClass('active');
    $('#link' + currentPage).parent().addClass('active');
}

function changePagination(totalLinks, currentPage){
    let html = "";
    for(let i = 1; i <= totalLinks; i++){
        if(i != currentPage){
            html += `<li class="page-item"><a class="page-link" id="link${i}" data-page="${i}" href="#">${i}</a></li>`;
        }else{
            html += `<li class="page-item active"><a class="page-link" id = "link${i}" data-page="${i}" href="#">${i}</a></li>`;
        }
    }
    $(".pagination").html(html);
    $(".page-link").click(sortActivities);

}

function ajaxError(greska, status, statusText){
    console.error('Error AJAX: ');
    console.log(status);
    console.log(statusText);
    if(greska.status == 500){
        console.log(greska.parseJSON);
        alert(greska.parseJSON.poruka);
    }
    else if(greska.status == 400){
        alert('Niste poslali ispravno parametre!')
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



