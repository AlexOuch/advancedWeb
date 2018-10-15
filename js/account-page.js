//this script is loaded by the account.php page and requires 'ajax/account.ajax.php' script

//create validation object
let validationState = {};

$(document).ready( () => {
  //get the current account_id from account_id input
  let account_id = $('input[name="account_id"]').val();
  //listen for changes in profile image
  $('#profile-image').on('change', (event) => {
    let newfile = event.target.files[0];
    let filesize = (newfile.size/1000) + 'K';
    let name = newfile.name.substr(0,5) + '..';
    let reader = new FileReader();
    //wait for image to load from filesystem
    reader.addEventListener('load', (evt) => {
      let dataURI = reader.result;
      $('#account-profile').attr('src',dataURI);
      $('#profile-image-info').text( name + ' ' + filesize );
    });
    //read the file
    reader.readAsDataURL(newfile);
  });
  //---FORM UPDATES ------------------------------
  
  
  $('#account-update').on('change', (event) => {
    //disable the submit button
    //check validation
    checkValidation(validationState);
    //the element that emits the event
    let target = event.target;
    //value of the name attribute of the event target
    let targetName = $(target).attr('name');
    
    
    //when username is changed
    if( targetName ){
      //check if username already exists
      let userNameData = {
        'username' : $(target).val(), 
        'account_id': account_id, 
        'intent' : 'checkuser'
      };
      makeRequest('ajax/account.ajax.php', userNameData )
      .then( (response) => { 
        if(response.success){
          //username does not already exist
          $(target).removeClass('is-invalid');
          $(target).addClass('is-valid');
          validationState.username = true;
        }
        else{
          //username exists or invalid
          let errorValues = processErrorMessage( response );
          $(target).removeClass('is-valid');
          $(target).siblings('.invalid-feedback').text(errorValues);
          $(target).addClass('is-invalid');
          validationState.username = false;
        }
      })
      .catch( (error) => { console.log(error); });
    }
    //listener for the email field when changed
    if( targetName == 'email'){
      let emailData = {
        'email' : $(target).val(), 
        'account_id': account_id, 
        'intent' : 'checkemail'
      };
      makeRequest('ajax/account.ajax.php', emailData )
      .then( (response) => { 
        if(response.success){
          $(target).removeClass('is-invalid');
          $(target).addClass('is-valid');
          validationState.email = true;
        }
        else{
          let errorValues = processErrorMessage( response );
          $(target).removeClass('is-valid');
          $(target).siblings('.invalid-feedback').text( errorValues );
          $(target).addClass('is-invalid');
          validationState.email = false;
        }
      })
      .catch( (error) => { console.log(error); });
    }
    //with passwords we don't need to check if it's already used, 
    //instead we just need to see if they're the same and valid
    if( targetName == 'password2'){
      //get the passwords from the fields
      let password1 = $('input[name="password1"]').val();
      let password2 = $('input[name="password2"]').val();
      let passwordData = {
        'passwords' : [ password1, password2 ], 
        'intent' : 'validatepasswords'
      }
      makeRequest('ajax/account.ajax.php', passwordData )
      .then( (response) => {
        console.log( response );
        const passwordFields = $('input[type="password"]');
        if(response.success){
          $( passwordFields ).removeClass('is-invalid');
          $( passwordFields ).addClass('is-valid');
          validationState.passwords = true;
        }
        else{
          let errorValues = processErrorMessage( response );
          $( passwordFields ).removeClass('is-valid');
          $(target).siblings('.invalid-feedback').text( errorValues );
          $( passwordFields ).addClass('is-invalid');
          validationState.passwords = false;
        }
      })
      .catch( (error) => {});
    }
  });
});

function makeRequest( destinationUrl, payload ){
  //promise
  return new Promise( (resolve,reject) => {
    $.ajax({
      url: destinationUrl,
      data: payload,
      method: 'post',
      dataType: 'json'
    })
    .done( (response) => {
      resolve( response );
    })
    .fail( (error) => {
      reject( error );
    });
  });
}

function processErrorMessage( obj ){
  //get the errors
  let usernameErrors = obj.errors;
  let errorValues = Object.values( usernameErrors );
  let errorMessage = errorValues.join(' ');
  return errorMessage;
}

function checkValidation( validationObject ){
  //get values from validation object
  const submitButton = $('button[type="submit"]');
  let vals = Object.values( validationObject );
  console.log(vals);
  if( vals.includes( false, 0 ) == false ){
    $(submitButton).removeAttr('disabled');
  }
  else{
    $('button[type="submit"]').attr('disabled', true);
  }
}