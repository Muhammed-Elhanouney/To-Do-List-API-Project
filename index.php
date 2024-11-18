<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    .card {
        /* width: 100px; */
        /* height: 100px; */
        /* width: 500px; */
        background-color: #00334e;
        border-radius: 50px;
    }

    .toDoInput {
        /* background-color: #dbebfa; */
        border-radius: 50px;
        padding: 20px 30px;
    }

    button {
        background-color: #007fbd;
        border: none;
        border-radius: 50px;
        padding: 0 30px;
    }


    .toDoInputHidden {
        background-color: #dbebfa !important;
        border-radius: 50px;
        padding: 20px 30px;
    }

    #id {
        width: 70px;
        height: 70px;
        background-color: #007fbd;
        border-radius: 50%;
        padding: 20px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 5px;
        font-weight: bolder;

    }

    .modal-content {
        background-color: #00334e;
    }
</style>

<body style="background-color: #004d73;">
    <section class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container card ">
            <!-- <h1>ali</h1> -->
            <div class="p-5 d-flex">
                <input class="form-control toDoInput " name="todo" type="text" autofocus placeholder="Inter Your ToDo Here...">
                <button class="addToDo ms-3">Add</button>
            </div>
            <?php
            include('./functions/connect.php');
            $sel = "SELECT * FROM `todo`";
            $query = $con->query($sel);
            foreach ($query as $value) {
                # code...
            ?>
                <div class="ps-5 pe-5 pb-5 d-flex all">
                    <span id="id"><?= $value['id'] ?></span>
                    <input id="toDoName" type="text" class="form-control w-75 toDoInputHidden" disabled value="<?= $value['toDoName'] ?>">
                    <!-- <button class="edit-todo ms-3 bg-secondary">Edit</button> -->

                    <!-- Button trigger modal -->
                    <button type="button" class="edit-todo ms-3 bg-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value['id'] ?>">
                        edit
                    </button>

                    <!-- Modal -->
                    <div class="modal fade exampleModal" id="exampleModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-white fs-5" id="exampleModalLabel">ToDo Edit</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="id" hidden value="<?= $value['id'] ?>">
                                    <input id="toDoName" type="text" name="modTod" class="form-control toDoInputHidden" value="<?= $value['toDoName'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary edit-save" data-id="<?= $value['id'] ?>">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button class="delete-todo ms-3 bg-danger">Delete</button> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="delete-todo ms-3 bg-danger" data-bs-toggle="modal" data-bs-target="#<?= $value['id'] ?>">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade"  id="<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Modal Delete</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-white">
                                        Aru You Shure You Want Delete
                                       <span class="text-danger fw-bolder"><?= $value['toDoName'] ?>..!</span> 
                                        
                                   
                                    </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                    <button type="button" data-id="<?= $value['id'] ?>" data-bs-dismiss="modal" class="btn btn-danger deletButton">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php

            }
            ?>
        </div>
    </section>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>

    <script>
        $('.addToDo').click(function(e) {
            e.preventDefault();
            let tod = $('input[name="todo"]').val();
            $.post('functions/todInsert.php', {
                todo: tod
            }, function(d) {
                let newItem = `
                        <div class="ps-5 pe-5 pb-5 d-flex">
                            <span id="id" class="todo-id">${d.id}</span>
                            <input type="text" class="form-control w-75 toDoInputHidden" disabled value="${d.toDoName}">
                             <button type="button" class="edit-todo ms-3 bg-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal${d.id}">
                        edit
                    </button>
                 <div class="modal fade exampleModal" id="exampleModal${d.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-white fs-5" id="exampleModalLabel">ToDo Edit</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <input type="text" hidden name="id" value="${d.id}">
                                <input id="toDoName" name="modTod" type="text" class="form-control toDoInputHidden" value="${d.toDoName}">
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-primary edit-save" data-id="${d.id}">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                            <button class="delete-todo ms-3 bg-danger">Delete</button>
                        </div>`;
                $('.card').append(newItem);
                $('input[name="todo"]').val("")
            })
        })

        $(document).on('click', '.edit-todo', function(ev) {
            let tar = ev.target;
            let newId = $(tar).parent().find('#id').html();
            let newText = $(tar).parent().find('.toDoInputHidden');

            $(document).on('click', '.edit-save', function(e) {

                let tarModel = e.currentTarget;

                let itemId = $(tarModel).data('id');
                let itemVal = $(this).parent().parent().find('.toDoInputHidden').val();


                $.post('functions/todEdit.php', {
                    jsId: itemId,
                    jsName: itemVal
                }, function(d) {
                    console.log(d);
                    newText.val(d.toDoName)
                    $('.exampleModal').modal('hide');
                })


            })
        })

        $(document).on("click" , ".deletButton" , function(e){
                let currenTarget = e.target;
          
                let idDelete = $(this).attr('data-id');
                $.post("functions/todDelete.php",{
                    id : idDelete
                },function(d){
                    console.log(d);
                    $(currenTarget).closest('.all').remove();
                    $('.fade').modal('hide');
                    
                })
        })
    </script>
</body>

</html>