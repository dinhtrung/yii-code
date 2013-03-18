function updateDialog( url, act )
{
  var action = '';
  var form = $( '#update-dialog div.update-dialog-content form' );
  if( url == false )
  {
    action = '&action=' + act;
    url = form.attr( 'action' );
  }
  $.ajax({
    'url': url,
    'data': form.serialize() + action,
    'type': 'post',
    'dataType': 'json',
    'success': function( data ){
      if( data.status == 'failure' )
      {
        $( '#update-dialog div.update-dialog-content' ).html( data.content );
        $( '#update-dialog div.update-dialog-content form input[type=submit]' )
          .die() // Stop from re-binding event handlers
          .live( 'click', function( e ){ // Send clicked button value
            e.preventDefault();
            updateDialog( false, $( this ).attr( 'name' ) );
        });
      }
      else
      {
        $( '#update-dialog div.update-dialog-content' ).html( data.content );
        if( data.status == 'success' ) // Update all grid views on success
        {
          $( 'div.grid-view' ).each( function(){
            $.fn.yiiGridView.update( $( this ).attr( 'id' ) );
          });
        }
        setTimeout( "$( '#update-dialog' ).dialog( 'close' ).children( ':eq(0)' ).empty();", 1000 );
      }
    },
    'cache': false
  });
}

function updateDialogDelete( e ){
  e.preventDefault();
  updateDialogActionBase( $( this ).attr( 'href' ), 'Delete confirmation' );
}

function updateDialogUpdate( e ){
  e.preventDefault();
  updateDialogActionBase( $( this ).attr( 'href' ), 'Update' );
}
  
function updateDialogCreate( e ){
  e.preventDefault();
  updateDialogActionBase( $( this ).attr( 'href' ), 'Create' );
}

function updateDialogActionBase( url, dialogTitle )
{
  $( '#update-dialog' ).children( ':eq(0)' ).empty();
  updateDialog( url );
  $( '#update-dialog' )
    .dialog( { title: dialogTitle } )
    .dialog( 'open' );
}

jQuery( function($){
  $( 'a.update-dialog-create' ).bind( 'click', updateDialogCreate );
});
