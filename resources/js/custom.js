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

/**
 * Update user using ajax
 */
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

});


$('#boardEditModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let board = button.data('board');
    let modal = $(this);


//modal.find('#select2').val(board.tasks.id);

     modal.find('#boardEditId').val(board.id);
     modal.find('#NumeEditBoard').val(board.name);


     modal.find('#boardEditName').text(board.name);


     
//preluare  id 
     modal.find('#userID').val(board.user.id); 

 
     
   
});



        $('#boardDeleteModal').on('shown.bs.modal', function(event) {
            let button = $(event.relatedTarget); // Button that triggered the modal
            let board = button.data('board');
            let modal = $(this);

        
            modal.find('#boardDeleteId').val(board.id);
            modal.find('#boardDeleteName').text(board.name);

            modal.find('#DeleteuserID').val(board.user.id);
        
          
        });




        $(document).ready(function() {
    $('#boardEditButton').on('click', function() {
        $('#boardEditAlert').addClass('hidden');

        let id = $('#boardEditId').val();
        let name = $('#NumeEditBoard').val();
        let IdUserCreator= $('#userID').val();
        let assignment = $('#AssignmentEditBoard').val();
        
        //let task_assignment=$('#select2').val();

        //  console.log(IdUserCreator);
         //console.log(id);
        //  console.log(name);
        // console.log(assignment);

    
         $.ajax({
             method: 'POST',
             url: '/board/update/'+id,
             data: {
                IdUserCreator:IdUserCreator,
                 name:name,
                 assignment:assignment,
             }
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
        let DeleteIdUserCreator= $('#DeleteuserID').val();

        console.log(DeleteIdUserCreator);

        $.ajax({
            method: 'POST',
            url: '/board/delete/' + id,
            data:
            {
                DeleteIdUserCreator:DeleteIdUserCreator, 

            }
        }).done(function(response) {
            if (response.error !== '') {
                $('#boardDeleteAlert').text(response.error).removeClass('hidden');
            } else {
                window.location.reload();
            }
        });
    });

});






    $('#TaskEditModalAjax').on('shown.bs.modal', function(event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let task = button.data('task');
        let user = button.data('user');
        let board = button.data('board');
   
    
        let modal = $(this);
        modal.find('#TaskEditName').text(task.name); //title

    
        modal.find('#TaskEditId').val(task.id); //Id Task
        

        modal.find('#TaskEditNameInput').val(task.name); //Textul Din input Name

        modal.find('#TaskEditDescription').val(task.description);//Textul din input description

       // modal.find('#AssignmentEditTask').val(task.assignment);//Id-ul userlui asignat

        //modal.find('#AssignmentEditTask').val(user.name);

        modal.find('#TaskEditStatus').val(task.status);//Textul Din input Status

        modal.find('#TaskEditDateofcreation').val(task.created_at);

    
        modal.find('#IdUserCareACreatBoard').val(board.user_id);







    });
    
  




    $('#TaskDeleteModal').on('shown.bs.modal', function(event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let task = button.data('task');
        let user = button.data('board');
    
        let modal = $(this);
    
        modal.find('#TaskDeleteId').val(task.id);
        modal.find('#TaskDeleteName').text(task.name);
        modal.find('#IDCreatorDelete').val(user.user_id);
   
    });


$(document).ready(function() {
    $('#TaskEditButton').on('click', function() {
        $('#TaskEditAlert').addClass('hidden');

        let  IdCreatorBoard= $('#IdUserCareACreatBoard').val(); //ID user creator

        let id = $('#TaskEditId').val(); //Id-ul Taskului
        let name=$('#TaskEditNameInput').val();//Textul Din input Name
        let description=$('#TaskEditDescription').val();//Textul din input description
        let assignment = $('#AssignmentEditTask').val(); //Id-ul userului asignat
        let status=$('#TaskEditStatus').val();//Textul Din input Status
       



        // console.log(id); 
        // console.log(IdCreatorBoard); 
        // console.log(name);
        // console.log(description);
        // console.log(assignment);
        // console.log(status);
        // console.log(creation);



        

         $.ajax({
             method: 'POST',
             url: '/task/update/' + id,
             data: {
                 id: id,
                IdCreatorBoard:IdCreatorBoard,
                name:name,
                description:description,
                assignment:assignment,
                status:status,
               
               

            } 
         }).done(function(response) {
             if (response.error !== '') {
                 $('#TaskEditAlert').text(response.error).removeClass('hidden');
             } else {
                window.location.reload();
             }
         });
    });

    $('#TaskDeleteButton').on('click', function() {
                 $('#TaskDeleteAlert').addClass('hidden');
                 let id = $('#TaskDeleteId').val();
                 let IdCreator = $('#IDCreatorDelete').val();

                 console.log(IdCreator);
                 console.log(id);
                 $.ajax({
                    method: 'POST',
                     url: '/task/delete/' + id,
                     data:
                     {
                        IdCreator:IdCreator 
         
                     }
                }).done(function(response) {
                    if (response.error !== '') {
                        $('#TaskDeleteAlert').text(response.error).removeClass('hidden');
                     } else {
                         window.location.reload();
                    }
             });
            });

        });



        // $('#mySelect2').select2({
        //     ajax: {
        //       url: '/example/api',
        //       processResults: function (data) {
        //         // Transforms the top-level key of the response object from 'items' to 'results'
        //         return {
        //           results: data.items
        //         };
        //       }
        //     }
        //   });
