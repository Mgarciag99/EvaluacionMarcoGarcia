


function table(){
 
    var container = document.getElementById( 'container-table' );
    var codeTest = document.getElementById( 'codeTest' );
    var codeAnswer = document.getElementById( 'codeAnswer' );

    var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_response.php';
    var formData = new FormData();

    formData.append( 'request', 'table' );
    formData.append( 'id', '' );
    formData.append( 'codeTest', codeTest.value );
    formData.append( 'codeQuestion', codeAnswer.value );
    formData.append( 'response', '' );

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

    var codeTest = document.getElementById( 'codeTest' );
    var codeAnswer = document.getElementById( 'codeAnswer' );
    var response = document.getElementById( 'reponse' );
    var type = document.getElementById( 'type' );

    if( codeTest.value !== '' ){

        var url = 'http://localhost/Evaluacion Marco Garcia/SYSTEM/API/API_response.php';
        var formData = new FormData();
        formData.append( 'request', 'save' );
        formData.append( 'codeTest', codeTest.value );
        formData.append( 'codeQuestion', codeAnswer.value );
        formData.append( 'response', response.value );
        formData.append( 'type', type.value );

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
                        response.value = '';
                        type.value = '';

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


