type = ['','info','success','warning','danger'];

custom = {
	showNotification: function(ntype, message, from, align){
    	//color = Math.floor((Math.random() * 4) + 1);

    	$.notify({
        	icon: "ti-gift",
        	message: message

        },{
            type: ntype,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
	},

  showSwal: function(type){
      if(type == 'basic'){
          swal("Here's a message!");

      }else if(type == 'title-and-text'){
          swal("Here's a message!", "It's pretty, isn't it?")

      }else if(type == 'success-message'){
          swal("Good job!", "You clicked the button!", "success")

      }else if(type == 'warning-message-and-confirmation'){
          swal({  title: "Are you sure?",
                  text: "You will not be able to recover this imaginary file!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn btn-info btn-fill",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonClass: "btn btn-danger btn-fill",
                  closeOnConfirm: false,
              },function(){
                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
              });

      }else if(type == 'warning-message-and-cancel'){
          swal({  title: "Are you sure?",
                  text: "You will not be able to recover this imaginary file!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel plx!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              },function(isConfirm){
                  if (isConfirm){
                      swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  }else{
                      swal("Cancelled", "Your imaginary file is safe :)", "error");
                  }
              });

      }else if(type == 'custom-html'){
          swal({  title: 'HTML example',
                  html:
                      'You can use <b>bold text</b>, ' +
                      '<a href="http://github.com">links</a> ' +
                      'and other HTML tags'
              });

      }else if(type == 'auto-close'){
          swal({ title: "Auto close alert!",
                 text: "I will close in 2 seconds.",
                 timer: 2000,
                 showConfirmButton: false
              });
      } else if(type == 'input-field'){
          swal({
                title: 'Enter points ',
                html: '<p><form action="" method="post"><input id="addPoints" class="form-control"></form>',
                showCancelButton: true,
                closeOnConfirm: true,
                allowOutsideClick: false,
                confirmButtonText: 'Add points',
                onClose: function() {
                  alert('maruf');
                }
              },
              function() {
                swal({
                  html:
                    'You entered: <strong>' +
                    $('#addPoints').val() +
                    '</strong>'
                });
              })
      } else if (type == 'ajax-request') {
          swal({
            title: 'Submit email to run ajax request',
            input: 'email',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (email) {
              return new Promise(function (resolve, reject) {
                setTimeout(function() {
                  if (email === 'taken@example.com') {
                    reject('This email is already taken.')
                  } else {
                    resolve()
                  }
                }, 2000)
              })
            },
            allowOutsideClick: false
          }).then(function (email) {
            swal({
              type: 'success',
              title: 'Ajax request finished!',
              html: 'Submitted email: ' + email
            })
          })
      }
  },

  initFormExtendedDatetimepickers: function(){
    //alert('maruf');
      $('.datetimepicker').datetimepicker({
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
       });

       $('.datepicker').datetimepicker({
          format: 'MM/DD/YYYY',    //use this format if you want the 12hours timpiecker with AM/PM toggle
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
       });

       $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
          format: 'h:mm A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }

       });
  }
}

