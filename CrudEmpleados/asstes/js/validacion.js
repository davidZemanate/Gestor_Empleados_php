
    // Configuración de la validación del formulario

        $(document).ready(function () {
            $("#addEmployeeForm").validate({
                rules: {
                    nombre: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    sexo: {
                        required: true
                    },
                    area: {
                        required: true
                    },
                    descripcion: {
                        maxlength: 200
                    },
                    rol: {
                        required: true
                    }
                },
                messages: {
                    nombre: {
                        required: "El nombre es obligatorio",
                        minlength: "El nombre debe tener al menos 3 caracteres"
                    },
                    email: {
                        required: "El correo electrónico es obligatorio",
                        email: "Introduce un correo electrónico válido"
                    },
                    sexo: {
                        required: "Selecciona un sexo"
                    },
                    area: {
                        required: "Selecciona al menos un área"
                    },
                    descripcion: {
                        maxlength: "La descripción no puede exceder los 200 caracteres"
                    },
                    rol: {
                        required: "Selecciona al menos un rol"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
            
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Tiempo en milisegundos para ocultar el mensaje (5 segundos en este ejemplo)
            const hideMessageTime = 2000;
        
            // Seleccionar todos los mensajes de error y éxito
            const messages = document.querySelectorAll('.alert');
        
            messages.forEach(function(message) {
                // Ocultar el mensaje después del tiempo especificado
                setTimeout(function() {
                    message.classList.remove('show');
                    message.classList.add('fade');
                }, hideMessageTime);
            });
        });