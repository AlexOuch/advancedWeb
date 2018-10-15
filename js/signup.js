// this file is for the signup.php page
//it communicates with file 'ajax/signup.ajax.php'
//an object to represent the validation state of the form
let validation = {
  username: false, 
  email: false, 
  password: false
};

$(document).ready(
 () => {
   let targetURL = 'ajax/signup.ajax.php';
   //form reference
   let signUpForm = $('#signup-form');
   //put the first input in focus
   $('input[name="username"]').focus();
   //run validation loop
   checkValidationState();
   //when the sign up form is submitted
   $(signUpForm).on('submit', (submitEvt) =>{
     submitEvt.preventDefault();
     const spinner = `<img class="spinner" src="images/spinner.png">`;
      $('button[type="submit"]').append(spinner);
      //get values of all form fields
      let usernameData = {
        intent: 'signup',
        username: $('input[name="username"]').val(),
        email: $('input[name="email"]').val(),
        password: $('input[name="password"]').val()
      };
      //make request
      makeRequest( targetURL , usernameData )
      .then( ( res ) => {
        if( res.success ){
          //successful
          window.location.href='login.php';
        }
        else{
          //failed
          //find which error
          //show error message
          //reset validation
        }
      })
      .catch( (error) => {});
   });
   //when the form resets
   $(signUpForm).on('reset', (resetEvt) => {
     //reset all validation
     $(resetEvt.target).find('input').removeClass('is-invalid');
     $(resetEvt.target).find('input').removeClass('is-valid');
     resetValidation(validation);
   });
   //when the form changes
   $(signUpForm).on('change', (changeEvt) =>{
     let targetName = $( changeEvt.target ).attr('name');
     let target = $( changeEvt.target );
     if( targetName == 'username' ){
       let usernameData = {intent: 'checkusername', username: $(target).val() };
       makeRequest( targetURL , usernameData )
       .then( ( res ) => {
         console.log( res );
         if( res.success == true ){
           //notify user
           $(target).removeClass('is-invalid');
           $(target).addClass('is-valid');
           notifyUser( target, res.success, res.errors );
           validation.username = true;
         }
         else{
           //notify user and show errors
           notifyUser( target, res.success, res.errors );
           validation.username = false;
         }
       })
       .catch( (error) => {
         console.log( error );
       });
     }
     //if email has been changed
     if( targetName == 'email' ){
       let emailData = {intent: 'checkemail', email: $(target).val() };
       makeRequest( targetURL , emailData )
       .then( ( res ) => {
         console.log( res );
         if( res.success == true ){
           //notify user
           notifyUser( target, res.success, res.errors );
           validation.email = true;
         }
         else{
           //notify user and show errors
           notifyUser( target, res.success, res.errors );
           validation.email = false;
         }
       })
       .catch( (error) => {
         console.log( error );
       });
     }
     //if password is filled
     if( targetName == 'password' ){
       let passwordData = { intent: 'checkpassword', password: $(target).val() };
       makeRequest( targetURL , passwordData )
       .then( ( res ) => {
         console.log( res );
         if( res.success == true ){
           //notify user
           notifyUser( target, res.success, res.errors );
           validation.password = true;
         }
         else{
           //notify user and show errors
           notifyUser( target, res.success, res.errors );
           validation.password = false;
         }
       })
       .catch( (error) => {
         console.log( error );
       });
     }
   });
   //trigger password check on input
   
 }
);

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

function checkValidationState(){
  //check validation state
  if( validation.username && validation.email && validation.password ){
    //if all inputs are valid, then enable signup button
    $('button[type="submit"]').removeAttr('disabled');
  }
  else{
    $('button[type="submit"]').attr('disabled',true);
  }
  requestAnimationFrame(checkValidationState);
}

function resetValidation(validationObject){
  validationObject.username = false;
  validationObject.email = false;
  validationObject.password = false;
}

function notifyUser( target, status, errors ){
  //remove any previous status
  $(target).removeClass('is-invalid');
  $(target).removeClass('is-valid');
  if( status == false && errors ){
    let errormsg = Object.values( errors );
    $(target).addClass('is-invalid');
    $(target).siblings('.invalid-feedback').text( errormsg.join() );
  }
  else{
    $(target).addClass('is-valid');
  }
}