$(document).ready(function(){
   $("form").bootstrapValidator({
        message: 'This value is not valid',
		feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
      	fields: {
            category: {
                validators: {
                    notEmpty: {
                        message: 'Η κατηγορία είναι υποχρεωτική'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'Ο τίτλος είναι υποχρεωτικός'
                    }
                }
            },
            lat: {
                validators: {
                    notEmpty: {
                        message: 'Το γεωγρ. πλάτος λείπει'
                    },
                    numeric: {
                        separator: '.',
                        message: 'Αυτό δεν είναι γεωγρ. πλάτος'
                    }
                }
            },
            lng: {
                validators: {
                    notEmpty: {
                        message: 'Το γεωγρ. μήκος λείπει'
                    },
                    numeric: {
                        separator: '.',
                        message: 'Αυτό δεν είναι γεωγρ. μήκος'
                    }
                }
            }
        }
	});
});
                            