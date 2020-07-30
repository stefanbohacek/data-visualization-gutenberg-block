'use strict';
const ftfHelpers = {
    ready: function( fn ) {
    /*
        ftfHelpers.ready( function(){

        } );
    */
        if ( document.readyState != 'loading' ){
            fn();
        } else {
            document.addEventListener( 'DOMContentLoaded', fn );
        }
    }
}

