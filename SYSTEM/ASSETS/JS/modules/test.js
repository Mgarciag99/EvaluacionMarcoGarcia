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
    var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_test.php';
    var formData = new FormData();

    formData.append( 'request', 'table' );
    formData.append( 'id', code.value );
    formData.append( 'name', '' );
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

    var name = document.getElementById( 'name' );

    if( name.value !== '' ){

        var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_test.php';
        var formData = new FormData();
        formData.append( 'request', 'save' );
        formData.append( 'name', name.value );

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
    var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_test.php';
    var code = document.getElementById( 'code' );
    var name = document.getElementById( 'name' );
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
                name.value = data.test_name,
                code.value = data.test_code,
                table(),
                changeButtons( 2 )
                //console.log( data )
            }
        }    
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

}



function update(){

    var code = document.getElementById( 'code' );
    var name = document.getElementById( 'name' );

    if( code!== '' && name.value !== '' ){
        
        var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_test.php';

        var formData = new FormData();
        formData.append( 'request', 'update' );
        formData.append( 'id', code.value );
        formData.append( 'name', name.value );

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
                var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_test.php';
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
