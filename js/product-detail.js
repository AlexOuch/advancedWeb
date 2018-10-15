$(document).ready(() => {
  //plus and minus buttons
  //plus
  $('#add').on('click',() => {
    //get the current quantity
    let q = $('input[name="quantity"]').val();
    //add one
    q++;
    //set the value to the input
    $('input[name="quantity"]').val( q );
  });
  $('#minus').on('click',() => {
    //get the current quantity
    let q = $('input[name="quantity"]').val();
    //minus one
    q--;
    //set the value to the input
    if( q > 0 ){
      $('input[name="quantity"]').val( q );
    }
  });
});