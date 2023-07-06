function changeButtons( btn ){

    var save = document.getElementById( 'save' );
    var update = document.getElementById( 'update' );

    if( btn == 1 ){

        save.classList.remove( 'hidden' );
        update.classList.add( 'hidden' );

    }else if( btn == 2 ){

        save.classList.add( 'hidden' );
        update.classList.remove( 'hidden' );

    }

}


function table(){
 
    var container = document.getElementById( 'container-table' );
    var code = document.getElementById( 'code' );
    var codeQuestion = document.getElementById( 'codeQuestion' );

    var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_question.php';
    var formData = new FormData();

    formData.append( 'request', 'table' );
    formData.append( 'id', codeQuestion.value );
    formData.append( 'answer', '' );
    formData.append( 'test', code.value );

    formData.append( 'situation', 1 );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )
    .then( response => response.json() )
    .then(
        response => {
        
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                container.innerHTML = response.data
              
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}

function save(){

    var name = document.getElementById( 'question' );
    var codeTest = document.getElementById( 'code' );


    if( name.value !== '' ){

        var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_question.php';
        var formData = new FormData();
        formData.append( 'request', 'save' );
        formData.append( 'answer', name.value );
        formData.append( 'test', codeTest.value );


        fetch( url, {
            method: 'POST', 
            body: formData,
        } )
        .then( 
            response => response.json()
        )
        .then( 
            response => {
                if( response.status !== true ){
                    swal("Error!", response.message, "info")   
                }else{
                    swal("Excelente!", response.message, "success").then((value) => {
                        name.value = '';
                        table();
                    })
                }
            }
        )
        .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    }else{

        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }
    
}


function select( test ){
    var data = '';
    var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_question.php';
    var codeQuestion = document.getElementById( 'codeQuestion' );
    var codeTest = document.getElementById( 'code' );
    var answer = document.getElementById( 'question' );
    var formData = new FormData();

    formData.append( 'request', 'select' );
    formData.append( 'id', test );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )
    .then( response => response.json() )
    .then( 
        response => {
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                data = response.data,
                answer.value = data.que_anwer,
                codeQuestion.value = data.que_code,
                codeTest.value = data.que_test,
                table(),
                changeButtons( 2 )
                //console.log( data )
            }
        }    
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

}



function update(){
    var codeTest = document.getElementById( 'code' );

    var code = document.getElementById( 'codeQuestion' );
    var name = document.getElementById( 'question' );

    if( code!== '' && name.value !== '' ){
        
        var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_question.php';

        var formData = new FormData();
        formData.append( 'request', 'update' );
        formData.append( 'id', code.value );
        formData.append( 'answer', name.value );
        formData.append( 'test', codeTest.value );

        fetch( url, {
            method: 'POST', 
            body: formData,
        } )
        .then( response => response.json() )
        .then( 

            response => {
                if( response.status !== true ){
                    swal("Error!", response.message, "info")   
                }else{
                    swal("Excelente!", response.message, "success").then((value) => {
                        code.value = '';
                        name.value = '';
                        table();
                        changeButtons( 1 )
                    })
                }
            }
            
        )
        .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    }else{

        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }

}



function delete_( test ){


    swal({
        title: "Esta Seguro?",
        text: "Desea eliminar esta test?",
        icon: "warning",
        buttons: {
            cancel: "Cancelar",
            ok: {
                text: "Aceptar",
                value: true,
            },
        },
    }).then((value) => {
        switch (value) {
            case true:
                var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_question.php';
                var formData = new FormData();

                formData.append( 'request', 'delete' );
                formData.append( 'id', test );

                fetch( url, {
                    method: 'POST', 
                    body: formData,
                } )
                .then( response => response.json() )
                .then( 

                    response => {
                        if( response.status !== true ){
                            swal("Error!", response.message, "info")   
                        }else{
                            swal("Excelente!", response.message, "success").then((value) => {
                                table();
                                changeButtons( 1 )
                            })
                        }
                    }
                    
                )
                .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )
                break;

            default:
                swal("", "Accion Cancelada...", "info");
        }
    });
    
}
