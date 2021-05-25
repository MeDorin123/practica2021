//CUSTOM JS
$('#userEditModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let user = button.data('user');

    let modal = $(this);

    modal.find('#userEditId').val(user.id);
    modal.find('#userEditName').text(user.name);
    modal.find('#userEditRole').val(user.role);
});

$('#userEditModalAjax').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let user = button.data('user');

    let modal = $(this);

    modal.find('#userEditIdAjax').val(user.id);
    modal.find('#userEditNameAjax').text(user.name);
    modal.find('#userEditRoleAjax').val(user.role);
});

$('#userDeleteModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let user = button.data('user');

    let modal = $(this);

    modal.find('#userDeleteId').val(user.id);
    modal.find('#userDeleteName').text(user.name);
});

$('#boardEditModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let board = button.data('board');

    let modal = $(this);

    modal.find('#boardEditId').val(board.id);
    modal.find('#boardEditName').val(board.name);

    let usersSelected = [];

    board.board_users.forEach(function(boardUser) {
        usersSelected.push(boardUser.user_id);
    });

    modal.find('#boardEditUsers').val(usersSelected);
    modal.find('#boardEditUsers').trigger('change');
});

$('#boardDeleteModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let board = button.data('board');

    let modal = $(this);

    modal.find('#boardDeleteId').val(board.id);
    modal.find('#boardDeleteName').text(board.name);
});

$('#taskEditModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let task = button.data('task');

    let modal = $(this);

    modal.find('#taskEditId').val(task.id);
    modal.find('#taskEditName').val(task.name);
    modal.find('#taskEditDescription').text(task.description);
    modal.find('#taskEditAssignment').val(task.assignment ? task.assignment : '');
    modal.find('#taskEditStatus').val(task.status);
});

$('#taskDeleteModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let task = button.data('task');

    let modal = $(this);

    modal.find('#taskDeleteId').val(task.id);
    modal.find('#taskDeleteName').text(task.name);
});

$(document).ready(function() {
    $('#userEditButtonAjax').on('click', function() {
        $('#userEditAlert').addClass('hidden');

        let id = $('#userEditIdAjax').val();
        let role = $('#userEditRoleAjax').val();

        $.ajax({
            method: 'POST',
            url: '/user-update/' + id,
            data: {role: role}
        }).done(function(response) {
            if (response.error !== '') {
                $('#userEditAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

    $('#userDeleteButton').on('click', function() {
        $('#userDeleteAlert').addClass('hidden');
        let id = $('#userDeleteId').val();

        $.ajax({
            method: 'POST',
            url: '/user/delete/' + id
        }).done(function(response) {
            if (response.error !== '') {
                $('#userDeleteAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

    $('#changeBoard').on('change', function() {
        let id = $(this).val();

        window.location.href = '/board/' + id;
    });

    $('#boardEditUsers').select2();

    $('#boardEditButton').on('click', function() {
        $('#boardEditAlert').addClass('hidden');

        let id = $('#boardEditId').val();
        let name = $('#boardEditName').val();
        let boardUsersData = $('#boardEditUsers').select2('data');

        let boardUsers = [];

        boardUsersData.forEach(function(item) {
            boardUsers.push(item.id);
        });

        $.ajax({
            method: 'POST',
            url: '/board/update/' + id,
            data: {name, boardUsers}
        }).done(function(response) {
            if (response.error !== '') {
                $('#boardEditAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

    $('#boardDeleteButton').on('click', function() {
        $('#boardDeleteAlert').addClass('hidden');
        let id = $('#boardDeleteId').val();

        $.ajax({
            method: 'POST',
            url: '/board/delete/' + id
        }).done(function(response) {
            if (response.error !== '') {
                $('#boardDeleteAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

    $('#taskEditButton').on('click', function() {
        $('#taskEditAlert').addClass('hidden');

        let id = $('#taskEditId').val();
        let name = $('#taskEditName').val();
        let description = $('#taskEditDescription').text();
        let assignment = $('#taskEditAssignment').val();
        let status = $('#taskEditStatus').val();

        $.ajax({
            method: 'POST',
            url: '/task/update/' + id,
            data: {name, description, assignment, status}
        }).done(function(response) {
            if (response.error !== '') {
                $('#taskEditAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

    $('#taskDeleteButton').on('click', function() {
        $('#taskDeleteAlert').addClass('hidden');
        let id = $('#taskDeleteId').val();

        $.ajax({
            method: 'POST',
            url: '/task/delete/' + id
        }).done(function(response) {
            if (response.error !== '') {
                $('#taskDeleteAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

});


$('#ButtonBoardAddModal').on('shown.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    

    let modal = $(this);



});

$(document).ready(function () {
    $('#boardAddButton').on('click', function () {
        $('#boardAddAlert').addClass('hidden');

        let Name = $('#boardAddName').val();
        let user_id = $('#boardAddUser').val();
       
        // console.log(Name); //
       // console.log(user_id); //
        $.ajax({
            method: 'POST',
            url: '/board/add',
            data: {Name,user_id,}
        }).done(function (response) {
            if (response.error !== '') {
                $('#taskAddAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });

    });
});

$('#ButtonTaskAddModal').on('shown.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let task = button.data('task');

    let modal = $(this);


    
});

$(document).ready(function () {
    $('#AddTaskSave').on('click', function () {
        $('#taskAddAlert').addClass('hidden');

        let Name = $('#AddTaskName').val();
        let Description = $('#AddTaskDescription').val();
        let Assignment = $('#AddTaskAssignment').val();
        let Status = $('#AddTaskStatus').val();
        let Board_Id = $('#taskAddBoard_Id').val();

// console.log(Name); //
// console.log(Description);//Descriere
// console.log(Assignment);//Id-ul Numelui
// console.log(Status);//created,progress,done
 //console.log(Board_Id);//created,progress,done

        $.ajax({
            method: 'POST',
            url: '/task/add',
            data: { Name, Description, Assignment, Status, Board_Id }
        }).done(function (response) {
            if (response.error !== '') {
                $('#taskAddAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
   
    });
});


$(function () {
    'use strict'

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true


    var $visitorsChart = $('#visitors-chart')



//Numarul zilelor din divuri
    var $SixdaysagoVal = $('#SixdaysagoVal').val();
    var $FivedaysagosagoVal = $('#FivedaysagosagoVal').val();
    var $FourdaysagoVal = $('#FourdaysagoVal').val();
    var $ThreedaysagoVal = $('#ThreedaysagoVal').val();
    var $OtherdayVal = $('#OtherdayVal').val();
    var $YesterdayVal = $('#YesterdayVal').val();
    var $todayVal = $('#todayVal').val();
  
//   Numarul de vizitatori pe zile

    var $VizitatoriSixdaysagoVal = $('#VizitatoriSixdaysagoVal').val();
    var $VizitatoriFivedaysagoVal = $('#VizitatoriFivedaysagoVal').val();
    var $VizitatoriFourdaysagoVal = $('#VizitatoriFourdaysagoVal').val();
    var $VizitatoriThreedaysagoVal = $('#VizitatoriThreedaysagoVal').val();
    var $VizitatoriOtherdayVal = $('#VizitatoriOtherdayVal').val();
    var $VizitatoriYesterdayVal = $('#VizitatoriYesterdayVal').val();
    var $VizitatoriTodayVal = $('#VizitatoriTodayVal').val();


    //   Numarul de vizite pe zile

    var $ViziteSixdaysagoVal = $('#ViziteSixdaysagoVal').val();
    var $ViziteFivedaysagoVal = $('#ViziteFivedaysagoVal').val();
    var $ViziteFourdaysagoVal = $('#ViziteFourdaysagoVal').val();
    var $ViziteThreedaysagoVal = $('#ViziteThreedaysagoVal').val();
    var $ViziteOtherdayVal = $('#ViziteOtherdayVal').val();
    var $ViziteYesterdayVal = $('#ViziteYesterdayVal').val();
    var $ViziteTodayVal = $('#ViziteTodayVal').val();

 
    var visitorsChart = new Chart($visitorsChart, {
        data: { //zilele
            labels: [$SixdaysagoVal+'th', $FivedaysagosagoVal+'th', $FourdaysagoVal+'th', $ThreedaysagoVal+'th', $OtherdayVal+'th', $YesterdayVal+'th', $todayVal+'th' ],
            datasets: [{
                type: 'line',
                data: [ //Numarul de vizitatori pe zile
                    $VizitatoriSixdaysagoVal,//vizitatorii de acum 6 zile
                    $VizitatoriFivedaysagoVal,//vizitatorii de acum 5 zile
                    $VizitatoriFourdaysagoVal,
                    $VizitatoriThreedaysagoVal,
                     $VizitatoriOtherdayVal,
                      $VizitatoriYesterdayVal,
                    $VizitatoriTodayVal //vizitatorii Today
                    ],

                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
              
            },
            {
                type: 'line',
                data: [
                    $ViziteSixdaysagoVal,
                     $ViziteFivedaysagoVal,
                      $ViziteFourdaysagoVal,
                       $ViziteThreedaysagoVal,
                        $ViziteOtherdayVal, 
                        $ViziteYesterdayVal, 
                        $ViziteTodayVal],//Numarul de vizite Azi

              
                backgroundColor: 'tansparent',
                borderColor: '#ced4da',
                pointBorderColor: '#ced4da',
                pointBackgroundColor: '#ced4da',
                fill: false
               
            }]
        },
        options: {
           maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        //lineWidth: '4px',
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 200
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
})

























