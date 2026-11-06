document.addEventListener('DOMContentLoaded', function() {
    if (typeof $ !== 'undefined') {
        $('.toggle-password').click(function() {
            const input = $(this).closest('.input-group').find('.password-input');
            const icon = $(this).find('i');
            
            if (input.length && icon.length) {
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            }
        });
    }
});
