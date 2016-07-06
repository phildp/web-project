$(document).ready(function(){
   $("#form").bootstrapValidator({
        message: 'This value is not valid',
		feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
      	fields: {
            fname: {
                validators: {
                    notEmpty: {
                        message: 'Το όνομα είναι υποχρεωτικό'
                    }
                }
            },
            lname: {
                validators: {
                    notEmpty: {
                        message: 'Το επώνυμο είναι υποχρεωτικό'
                    }
                }
            },
            uname: {
                validators: {
                	remote: {
                		url: 'lib/checkifValid.php',
                		message: 'Το όνομα χρήστη χρησιμοποιείται ήδη'
                	},
                    notEmpty: {
                        message: 'Το όνομα χρήστη είναι υποχρεωτικό'
                    },
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Από 3 μέχρι 20'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Μόνο λατινικοί χαρακτήρες, νούμερα, τελείες και κάτω παύλα'
                    }
                }
            },
            email: {
                validators: {
                	remote: {
                		url: 'lib/checkifValid.php',
                		message: 'Το email χρησιμοποιείται ήδη'
                	},
                    notEmpty: {
                        message: 'Το email είναι υποχρεωτικό'
                    },
                    emailAddress: {
                        message: 'Αυτό δεν είναι email'
                    }
                }
            },
            pass: {
                validators: {
                    notEmpty: {
                        message: 'Ο κωδικός είναι υποχρεωτικός'
                    },
                    stringLength: {
                        min: 3,
                        max: 15,
                        message: 'Από 3 μέχρι 15 χαρακτήρες'
                    },
                    identical: {
                        field: 'pass',
                        message: 'Δεν ταιριάζει με το από κάτω'
                    }
                }
            },
            confirmpass: {
                validators: {
                    notEmpty: {
                        message: 'Δεν ταιριάζει με το από πάνω'
                    },
                    identical: {
                        field: 'pass',
                        message: 'Δεν ταιριάζει με το από πάνω'
                    }
                }
            },
            phone: {
                validators: {
                    stringLength: {
                        min: 1,
                        max: 10,
                        message: 'Μέχρι 10 νούμερα'
                    },
                    digits: {
                        message: 'Μόνο νούμερα'
                    }
                }
            }
        }
	});
});
                            
                            
                            